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
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

//Request Validator
use App\Http\Requests\Backoffice\AppointmentRequest;

//Global Classes
use Input, DB;

class AppointmentsController extends Controller
{
    //Do some magic
    public function __construct(IAppointmentsRepository $repo, IPetsRepository $petRepo, IVetsRepository $vetRepo, IServicesRepository $serviceRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->vetRepo = $vetRepo;
        $this->petRepo = $petRepo;
        $this->serviceRepo = $serviceRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Appointments';
        $this->data['appointment'] = null;
        $this->data['statuses'] = [
            'Pending',
            'Scheduled',
            'Completed',
            'No Show',
        ];
    }

    public function index(){
        $this->data['appointments'] = $this->repo->fetch();
        $this->data['events'] = [];
        $events = $this->data['appointments']->where('start','!=',null)->where('end','!=',null);
        foreach($events as $index => $event){
            if((auth()->user()->type == 'patient' AND $event->patient->user->id == auth()->user()->id) OR auth()->user()->type != 'patient'){
                array_push($this->data['events'],[ 
                    'title' => $event->pet->name.' '.ucfirst($event->service->type).'. Owner : '.$event->patient->user->name.' | Pet : '.$event->pet->name.' | Vet : '.$event->vet->salutation.' '.$event->vet->user->name, 
                    'description' => 'Owner : '.$event->patient->user->name.' | Pet : '.$event->pet->name.' | Vet : '.$event->vet->salutation.' '.$event->vet->user->name, 
                    'start' => date('Y-m-d',strtotime($event->start)).'T'.date('H:i:s',strtotime($event->start)), 
                    'end' =>  date('Y-m-d',strtotime($event->end)).'T'.date('H:i:s',strtotime($event->end))]);
            }else{
                array_push($this->data['events'],[ 
                    'title' => 'Date & time taken', 
                    'description' => '', 
                    'start' => date('Y-m-d',strtotime($event->start)).'T'.date('H:i:s',strtotime($event->start)), 
                    'end' =>  date('Y-m-d',strtotime($event->end)).'T'.date('H:i:s',strtotime($event->end))]);
            }
        }
        $this->data['events'] = json_encode($this->data['events']);
        return view('backoffice.pages.appointments.index',$this->data);
    }

    public function create(){
        if(auth()->user()->type != 'patient'){
            return abort(404);
        }
        $this->data['pets'] = $this->petRepo->fetch(auth()->user()->patient->id)->pluck('name', 'id')->toArray();
        $this->data['vets'] = $this->vetRepo->select(DB::raw("CONCAT(fname,' ',lname) AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['services'] = $this->serviceRepo->select(DB::raw("CONCAT(name,' (₱ ',price,')') AS name"),'id')->pluck('name', 'id')->toArray();
        return view('backoffice.pages.appointments.create',$this->data);
    }

    public function store(AppointmentRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.appointments.index');
    }
    
    public function edit($id){
        $this->data['appointment'] = $this->repo->findOrFail($id);
        if(!$this->data['appointment']){
            return abort(404);
        }
        $this->data['pets'] = $this->petRepo->fetch($this->data['appointment']->patient->id)->pluck('name', 'id')->toArray();
        $this->data['vets'] = $this->vetRepo->select(DB::raw("CONCAT(fname,' ',lname) AS name"),'id')->pluck('name', 'id')->toArray();
        $this->data['services'] = $this->serviceRepo->select(DB::raw("CONCAT(name,' (₱ ',price,')') AS name"),'id')->pluck('name', 'id')->toArray();
        return view('backoffice.pages.appointments.create',$this->data);
    }

    public function update(AppointmentRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        if($crudData){
            event(new SendEmailEvent($crudData,'appointment_details'));
        }
        return redirect()->route('backoffice.appointments.index');
    }

    public function delete($id){
        $delete = $this->CRUDservice->delete($id, $this->repo);
        return redirect()->route('backoffice.appointments.index');
    }
}
