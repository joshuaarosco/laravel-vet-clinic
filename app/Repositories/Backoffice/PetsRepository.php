<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IPetsRepository;

use App\Logic\ImageUploader as UploadLogic;
use App\Models\Backoffice\Pets as Model;
use App\Models\User;
use DB, Str;

class PetsRepository extends Model implements IPetsRepository
{

    public function fetch($patient_id){
        return self::where('patient_id', $patient_id)->get();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $pet = self::find($request->pet_id)? : new self;

            $pet->patient_id = $request->patient_id;
            $pet->name = $request->name;
            $pet->birthday = $request->birthday;
            $pet->sex = $request->sex;
            $pet->weight = $request->weight;
            $pet->color = $request->color;
            $pet->race = $request->race;
            $pet->species = $request->species;

            if($request->hasFile('file')){
                $upload = UploadLogic::upload($request->file,'storage/pet');
                $pet->path = $upload["path"];
                $pet->directory = $upload["directory"];
                $pet->filename = $upload["filename"];
            }
            
            $pet->save();

            DB::commit();
            
            return $pet;
            
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

    public function fetchAll(){
        return self::all();
    }
}
