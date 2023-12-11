<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IInventoryRepository;

//Request Validator
use App\Http\Requests\Backoffice\InventoryRequest;

//Global Classes
use Input;

class InventoryController extends Controller
{
    //Do some magic
    public function __construct(IInventoryRepository $repo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->repo = $repo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Inventory';
        $this->data['inventory'] = null;
        $this->data['types'] = [
            'vaccination' => 'Vaccination',
            'grooming' => 'Grooming',
            'deworming' => 'Deworming',
            'surgery' => 'Surgery',
        ];
    }

    public function index(){
        $this->data['inventory'] = $this->repo->fetch();
        return view('backoffice.pages.inventory.index',$this->data);
    }

    public function create(){
        return view('backoffice.pages.inventory.create',$this->data);
    }

    public function store(InventoryRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.inventory.index',$this->data);
    }

    public function edit($id){
        $this->data['inventory'] = $this->repo->findOrFail($id);
        if(!$this->data['inventory']){
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', __('msg.not_found'));
            return redirect()->route('backoffice.inventory.index');
        }
        return view('backoffice.pages.inventory.edit', $this->data);
    }

    public function update($id, InventoryRequest $request){
        $crudData = $this->CRUDservice->save($request, $this->repo);
        return redirect()->route('backoffice.inventory.index',$this->data);
    }
}
