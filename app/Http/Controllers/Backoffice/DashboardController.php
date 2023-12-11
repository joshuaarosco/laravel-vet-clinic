<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Domain\Interfaces\Repositories\Backoffice\IVetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPetsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IRecordsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

class DashboardController extends Controller
{
    public function __construct(IVetsRepository $vetRepo, 
                                IPetsRepository $petRepo, 
                                IRecordsRepository $recordRepo, 
                                IPatientsRepository $patientRepo, 
                                IServicesRepository $serviceRepo, 
                                IAppointmentsRepository $appointmentRepo){
        $this->data = [];
        $this->vetRepo = $vetRepo;
        $this->petRepo = $petRepo;
        $this->recordRepo = $recordRepo;
        $this->patientRepo = $patientRepo;
        $this->serviceRepo = $serviceRepo;
        $this->appointmentRepo = $appointmentRepo;
    }
    //Do some magic
    public function index(){
        $this->data['vetCount'] = $this->vetRepo->fetch()->count();
        $this->data['petCount'] = $this->petRepo->fetchAll()->count();
        $this->data['patientCount'] = $this->patientRepo->fetch()->count();
        $this->data['serviceCount'] = $this->recordRepo->fetchAllAvailedServices()->count();
        $this->data['appointments'] = $this->appointmentRepo->fetch();
    	return view('backoffice.pages.dashboard.index', $this->data);
    }
}
