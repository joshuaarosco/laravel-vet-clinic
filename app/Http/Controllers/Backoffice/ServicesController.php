<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;

//Request Validator
use App\Http\Requests\Backoffice\ServicesRequest;

//Global Classes
use Input;

class ServicesController extends Controller
{
    //Do some magic
    public function __construct(IServicesRepository $repo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Services';
        $this->data['service'] = null;
        $this->data['types'] = [
            'vaccination' => 'Vaccination',
            'grooming' => 'Grooming',
            'deworming' => 'Deworming',
            'surgery' => 'Surgery',
        ];
    }

    public function index(){
        $this->data['services'] = $this->repo->fetch();
        return view('backoffice.pages.services.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.services.create',$this->data);
    }

    public function store(ServicesRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.services.index',$this->data);
    }

    public function edit($id){
        $this->data['service'] = $this->repo->findOrFail($id);
        if(!$this->data['service']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.services.index');
        }
        return view('backoffice.pages.services.edit', $this->data);
    }

    public function update($id, ServicesRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.services.index');
    }
}
