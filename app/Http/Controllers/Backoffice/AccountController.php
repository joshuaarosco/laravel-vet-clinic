<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Events
use App\Events\SendEmailEvent;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IVetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;

//Request Validator
use App\Http\Requests\Backoffice\AccountRequest;
use App\Http\Requests\Backoffice\PasswordRequest;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

//Global Classes
use Input, Auth;

class AccountController extends Controller
{
    //Do some magic
    public function __construct(IPatientsRepository $patientRepo, IVetsRepository $vetRepo, ICRUDService $CRUDservice){
        $this->data = [];
        $this->vetRepo = $vetRepo;
        $this->patientRepo = $patientRepo;
        $this->CRUDservice = $CRUDservice;
        $this->data['title'] = 'Account';
        $this->data['account'] = null;
    }

    public function index(){
        if(!auth()->check())
            return abort(404);
        $account = null;
        if(auth()->user()->type == 'patient'){
            $account = $this->patientRepo->fetchPatient(auth()->user()->id);
        }elseif(auth()->user()->type == 'vet'){
            $account = $this->vetRepo->fetchVet(auth()->user()->id);
        }

        $this->data['account'] = $account;
        return view('backoffice.pages.account.index',$this->data);
    }

    public function save(AccountRequest $request){
        if(auth()->user()->type == 'patient'){
            $this->CRUDservice->save($request, $this->patientRepo);
        }elseif(auth()->user()->type == 'vet'){
            $this->CRUDservice->save($request, $this->vetRepo);
        }
        return redirect()->back();
    }

    public function updatePassword(PasswordRequest $request){
        $user = auth()->user();
        if (Hash::check($request->old_password, $user->password)) { 
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            session()->flash('notification-status', "primary");
            session()->flash('notification-msg', "Password successfuly changed!");
         
            return redirect()->back();
         
        } else {
             
            session()->flash('notification-status', "danger");
            session()->flash('notification-msg', "Old password does not match!");

            return redirect()->back();
        }
    }

}
