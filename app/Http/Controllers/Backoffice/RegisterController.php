<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Requests\Backoffice\RegisterRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\GeneralLogic as Logic;
use App\Models\User;
use Auth;

//Services & Repositories
use App\Domain\Interfaces\Services\Backoffice\ICRUDService;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;

class RegisterController extends Controller
{
    //do some magic
    public function __construct(Logic $logic, IPatientsRepository $repo, ICRUDService $CRUDservice) {
        $this->repo = $repo;
        $this->logic = $logic;
        $this->CRUDservice = $CRUDservice;
		$this->middleware('backoffice.guest', ['except' => "logout"]);
	}

	public function register() {
		return view('backoffice.auth.register');
	}

	public function authenticate(RegisterRequest $request) {
        $crudData = $this->CRUDservice->save($request, $this->repo);
        Auth::loginUsingId($crudData->id);
        return redirect()->route('backoffice.index');
	}
}
