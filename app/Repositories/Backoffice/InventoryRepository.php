<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IInventoryRepository;

use App\Services\ImageUploader as UploadLogic;
use App\Models\Backoffice\Inventory as Model;
use App\Models\User;
use DB, Str, Input;

class InventoryRepository extends Model implements IInventoryRepository
{

    public function fetch(){
        if(Input::has('search') AND Input::get('search') != null){
            $exploded = explode(" ",str_replace(' & ',' ',Input::get('search')));
            $query = self::query();
            foreach ($exploded as $key => $value) {
                $query->where('item_code', 'like', "%{$value}%")
                ->orWhere('name', 'like', "%{$value}%")
                ->orWhere('type', 'like', "%{$value}%");
            }
            return $query->get();
        }
        return self::all();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $service = self::find($request->id)? : new self;

            $service->item_code = $request->item_code;
            $service->name = $request->name;
            $service->type = $request->type;
            $service->stock = $request->stock;
            $service->purchase_price = $request->purchase_price;
            $service->sale_price = $request->sale_price;
            $service->profit = $request->profit;
            $service->total_profit = $request->total_profit;
            $service->expiration_date = $request->expiration_date;

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
