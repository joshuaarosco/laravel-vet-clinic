<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IVetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IRecordsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IInventoryRepository;

//Request Validator
use App\Http\Requests\Backoffice\ItemRequest;
use App\Http\Requests\Backoffice\RecordsRequest;
use App\Http\Requests\Backoffice\AvailedServicesRequest;

//Global Classes
use Input, DB;

class RecordsController extends Controller
{
    //Do some magic
    public function __construct(IRecordsRepository $repo, 
                                IVetsRepository $vetRepo, 
                                IPetsRepository $petRepo, 
                                IPatientsRepository $patientRepo, 
                                IServicesRepository $serviceRepo,  
                                IInventoryRepository $inventoryRepo,  
                                ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->vetRepo = $vetRepo;
        $this->petRepo = $petRepo;
        $this->patientRepo = $patientRepo;
        $this->serviceRepo = $serviceRepo;
        $this->inventoryRepo = $inventoryRepo;

        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Health Record';
        $this->data['record'] = null;
        $this->data['availedService'] = null;
    }
    
    public function index(){
        $this->data['records'] = $this->repo->fetch();
        return view('backoffice.pages.records.index',$this->data);
    }
    
    public function create(){
        $this->data['patients'] = $this->patientRepo->select(DB::raw("CONCAT(fname,' ',lname) AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['vets'] = $this->vetRepo->select(DB::raw("CONCAT(fname,' ',lname) AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['pets'] = null;
        return view('backoffice.pages.records.create',$this->data);
    }
    
    public function pets(){
        $data['datas'] = $this->petRepo->fetch(Input::get('_patient_id'));
        return response()->json($data,200);
    }
    
    public function store(RecordsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.records.index',$this->data);
    }
    
    public function view($id){
        $this->data['record'] = $this->repo->findOrFail($id);        
        if(!$this->data['record'] OR !in_array(auth()->user()->type, ['admin', 'super_user', 'vet', 'patient']) ){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.records.index');
        }
        $this->data['availedServices'] = $this->repo->availedServices($id);
        return view('backoffice.pages.records.view', $this->data);
    }
    
    public function edit($id){
        $this->data['patients'] = $this->patientRepo->select(DB::raw("CONCAT(fname,' ',lname) AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['vets'] = $this->vetRepo->select(DB::raw("CONCAT(fname,' ',lname) AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['record'] = $this->repo->findOrFail($id);
        if(!$this->data['record']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.records.index');
        }
        $this->data['pets'] = $this->petRepo->fetch($this->data['record']->patient_id)->pluck('name', 'id')->toArray();
        return view('backoffice.pages.records.edit', $this->data);
    }
    
    public function update($id, RecordsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.records.view',$crudData->id);
    }
    
    public function addService($record_id){
        $this->data['services'] = $this->serviceRepo->fetch()->pluck('name', 'id')->toArray();
        $this->data['record'] = $this->repo->findOrFail($record_id);
        if(!$this->data['record']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.records.index');
        }
        return view('backoffice.pages.records.add_service', $this->data);
    }
    
    public function saveService(AvailedServicesRequest $request){
        $this->data['availed_service'] = $this->repo->saveService($request);
        if(!$this->data['availed_service']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.error'));
            return redirect()->route('backoffice.records.view', $request->record_id);
        }

        session()->flash('notification-status', "primary");
        session()->flash('notification-msg', __('msg.save_success'));
        return redirect()->route('backoffice.records.view', $request->record_id);
    }

    public function viewService($id){
        $this->data['availedService'] = $this->repo->availedService($id);
        if(!$this->data['availedService'] ){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.error'));
            return redirect()->route('backoffice.records.index');
        }
        $this->data['items'] = $this->repo->getItems($this->data['availedService']->id);
        return view('backoffice.pages.records.view_service', $this->data);
    }

    public function editService($id){
        $this->data['availedService'] = $this->repo->availedService($id);
        $this->data['services'] = $this->serviceRepo->fetch()->pluck('name', 'id')->toArray();
        if(!$this->data['availedService'] ){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.error'));
            return redirect()->route('backoffice.records.index');
        }
        return view('backoffice.pages.records.edit_service', $this->data);
    }

    public function updateService(AvailedServicesRequest $request){
        $this->data['availed_service'] = $this->repo->saveService($request);
        
        if(!$this->data['availed_service']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.error'));
            return abort(404);
        }

        session()->flash('notification-status', "primary");
        session()->flash('notification-msg', __('msg.save_success'));
        return redirect()->route('backoffice.records.view', $this->data['availed_service']->record->id);
    }

    public function addItem($availed_service_id){
        $this->data['items'] = $this->inventoryRepo->where('stock','>','0')->select(DB::raw("CONCAT(item_code,' | ',name,' (₱ ',sale_price,')') AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['availedService'] = $this->repo->availedService($availed_service_id);
        return view('backoffice.pages.records.add_item', $this->data);
    }

    public function saveItem(ItemRequest $request){
        $this->data['item'] = $this->repo->saveItem($request);
        if(!$this->data['item'] ){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.error'));
            return abort(404);
        }
        return redirect()->route('backoffice.records.view_service', $request->availed_service_id);
    }

    public function deleteItem($id){
        $availed_service_id = $this->repo->deleteItem($id);
        if(!$availed_service_id){
            return abort(404);
        }
        return redirect()->route('backoffice.records.view_service', $availed_service_id);
    }

    public function invoice($id){
        $this->data['record'] = $this->repo->findOrFail($id);
        if(!$this->data['record']){
            return abort(404);
        }
        $this->data['items'] = $this->repo->getRecordItems($id);
        $this->data['services'] = $this->repo->availedServices($id);
        //Create Invoice
        $this->repo->generateInvoice($this->data);
        return view('backoffice.pages.records.invoice', $this->data);
    }

    public function transactionHistory($id){
        $this->data['record'] = $this->repo->findOrFail($id);
        if(!$this->data['record']){
            return abort(404);
        }
        $this->data['invoices'] = $this->repo->fetchInvoices($id);
        return view('backoffice.pages.records.invoices', $this->data);
    }

    public function viewInvoice($invoiceId){
        $this->data['invoice'] = $this->repo->getInvoice($invoiceId);
        $this->data['record'] = $this->repo->findOrFail($this->data['invoice']->record_id);
        if(!$this->data['record']){
            return abort(404);
        }
        $this->data['items'] = $this->repo->getInvoiceRecordItems($invoiceId);
        $this->data['services'] = $this->repo->getInvoiceAvailedServices($invoiceId);
        return view('backoffice.pages.records.paid_invoice', $this->data);
    }

    public function cashPayment($id){
        $record = $this->repo->findOrFail($id);
        if(!$record){
            return abort(404);
        }
        $availed_services = $this->repo->availedServices($record->id);
        
        $invoice = $record->invoice;
        $invoice->status = 'Paid';
        $invoice->save();

        //update availed_services invoice id
        foreach($availed_services as $index => $service){
            $service->invoice_id = $invoice->id;
            $service->save();
        }

        session()->flash('notification-status', "primary");
        session()->flash('notification-msg', 'Payment Successful!');
        return redirect()->route('backoffice.records.view', $id);
    }
}