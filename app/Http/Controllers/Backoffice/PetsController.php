<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IPetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IRecordsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;

//Request Validator
use App\Http\Requests\Backoffice\PetsRequest;

//Global Classes
use Input;

class PetsController extends Controller
{
    //Do some magic
    public function __construct(IPatientsRepository $patientRepo, IPetsRepository $repo, IRecordsRepository $recordRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->recordRepo = $recordRepo;
        $this->patientRepo = $patientRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Pets';
        $this->data['patient'] = null;
        $this->data['pet'] = null;
        $this->data['sex'] = ['' => '---', 'Male'=>'Male', 'Female' => 'Female'];
    }

    public function create($patient_id){
        $this->data['patient'] = $this->patientRepo->findOrFail($patient_id);
        if(!$this->data['patient'] OR !in_array(auth()->user()->type, ['admin', 'super_user', 'vet']) AND $this->data['patient']->id != auth()->user()->patient->id){
            return abort(404);
        }
        return view('backoffice.pages.pets.create', $this->data);
    }

    public function store(PetsRequest $request){
        if(!in_array(auth()->user()->type, ['admin', 'super_user', 'vet']) AND $request->patient_id != auth()->user()->patient->id){
            return abort(404);
        }
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.patients.view',$crudData->patient->id);
    }

    public function view($pet_id){
        $this->data['pet'] = $this->repo->findOrFail($pet_id);
        if(!$this->data['pet']){
            return abort(404);
        }
        $this->data['patient'] = $this->data['pet']->patient;
        $this->data['records'] = $this->recordRepo->petRecords($pet_id);
        return view('backoffice.pages.pets.view', $this->data);
    }

    public function edit($pet_id){
        $this->data['pet'] = $this->repo->findOrFail($pet_id);
        if(!$this->data['pet']){
            return abort(404);
        }
        $this->data['patient'] = $this->data['pet']->patient;
        return view('backoffice.pages.pets.edit', $this->data);
    }

    public function update(PetsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.patients.view',$crudData->patient->id);
    }
}