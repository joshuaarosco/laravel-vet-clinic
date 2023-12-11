<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IPetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IRecordsRepository;

//Request Validator
use App\Http\Requests\Backoffice\PatientsRequest;

//Global Classes
use Input;

class PatientsController extends Controller
{
    //Do some magic
    public function __construct(IPatientsRepository $repo, IPetsRepository $petRepo, IRecordsRepository $recordRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->petRepo = $petRepo;
        $this->recordRepo = $recordRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Patients';
        $this->data['patient'] = null;
    }

    public function index(){
        $this->data['patients'] = $this->repo->fetch();
        return view('backoffice.pages.patients.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.patients.create',$this->data);
    }

    public function store(PatientsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        if($crudData){
            event(new SendEmailEvent($crudData,'patient_creation'));
        }
        return redirect()->route('backoffice.patients.view',$crudData->patient->id);
    }

    public function view($id){
        $this->data['patient'] = $this->repo->findOrFail($id);
        $this->data['pets'] = $this->petRepo->fetch($id);
        if(!$this->data['patient'] OR (!in_array(auth()->user()->type, ['admin', 'super_user','vet']) AND $this->data['patient']->id != auth()->user()->patient->id)){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return abort(404);
        }
        $this->data['records'] = $this->recordRepo->patientRecords($id);
        return view('backoffice.pages.patients.view', $this->data);
    }

    public function edit($id){
        $this->data['patient'] = $this->repo->findOrFail($id);
        if(!$this->data['patient'] OR (!in_array(auth()->user()->type, ['admin', 'super_user']) AND $this->data['patient']->id != auth()->user()->patient->id)){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.patients.index');
        }
        return view('backoffice.pages.patients.edit', $this->data);
    }

    public function update($id, PatientsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.patients.view',$crudData->patient->id);
    }
}
