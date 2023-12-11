<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Service as Model;
use App\Models\User;
use DB, Str, Input;

class ServicesRepository extends Model implements IServicesRepository
{

    public function fetch(){
        if(Input::has('search') AND Input::get('search') != null){
            $exploded = explode(" ",str_replace(' & ',' ',Input::get('search')));
            $query = self::query();
            foreach ($exploded as $key => $value) {
                $query->where('name', 'like', "%{$value}%")
                ->orWhere('type', 'like', "%{$value}%")
                ->orWhere('description', 'like', "%{$value}%");
            }
            return $query->get();
        }
        return self::all();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $service = self::find($request->id)? : new self;

            $service->name = $request->name;
            $service->type = $request->type;
            $service->price = $request->price;
            $service->description = $request->description;

            $service->save();

            DB::commit();

            return $service;
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
