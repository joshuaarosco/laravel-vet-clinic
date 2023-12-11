<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Appointment as Model;
use App\Models\User;
use DB, Str;

class AppointmentsRepository extends Model implements IAppointmentsRepository
{

    public function fetch(){
        //if(auth()->user()->type != 'patient'){
            return self::all();
        //}else{
        //    return self::where('patient_id', auth()->user()->patient->id)->get();
        //}
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $appointment = self::find($request->id)? : new self;

            $appointment->patient_id = $request->patient_id;
            $appointment->pet_id = $request->pet_id;
            $appointment->vet_id = $request->vet_id;
            $appointment->service_id = $request->service_id;
            $appointment->details = $request->details;
            $appointment->status = $request->status?$request->status:'Pending';
            $appointment->start = $request->start?date('Y-m-d H:i:s',strtotime($request->start)):null;
            $appointment->end = $request->end?date('Y-m-d H:i:s',strtotime($request->end)):null;
            
            $appointment->save();

            DB::commit();
            
            return $appointment;
            
        } catch (\Exception $e) {
             DB::rollback();
             return false;
        }
    }

    public function findOrFail($id){
        $data = self::find($id);
        if(!$data){
            return false;
        }
        return $data;
    }

    public function deleteData($id){
        DB::beginTransaction();
        try {
            self::destroy($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
