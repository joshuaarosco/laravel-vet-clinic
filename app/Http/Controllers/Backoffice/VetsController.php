<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IVetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IRecordsRepository;

//Request Validator
use App\Http\Requests\Backoffice\VetsRequest;

//Global Classes
use Input;

class VetsController extends Controller
{
    //Do some magic
    public function __construct(IVetsRepository $repo, IRecordsRepository $recordRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->recordRepo = $recordRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Veterinarian';
        $this->data['vet'] = null;
        $this->data['salutations'] = [
            'Dr.',
            'Mr.',
            'Mrs.',
            'Ms.',
        ];
    }

    public function index(){
        $this->data['vets'] = $this->repo->fetch();
        return view('backoffice.pages.vets.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.vets.create',$this->data);
    }

    public function store(VetsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        if($crudData){
            event(new SendEmailEvent($crudData,'vet_creation'));
        }
        return redirect()->route('backoffice.vets.index',$this->data);
    }
    
    public function view($id){
        $this->data['vet'] = $this->repo->findOrFail($id);
        if(!$this->data['vet']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.vets.index');
        }
        $this->data['records'] = $this->recordRepo->vetRecords($id);
        return view('backoffice.pages.vets.view', $this->data);
    }

    public function edit($id){
        $this->data['vet'] = $this->repo->findOrFail($id);
        if(!$this->data['vet']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.vets.index');
        }
        return view('backoffice.pages.vets.edit', $this->data);
    }

    public function update($id, VetsRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.vets.view',$crudData->vet->id);
    }
}
