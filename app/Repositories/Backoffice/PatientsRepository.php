<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;

use App\Logic\ImageUploader as UploadLogic;
use App\Models\Backoffice\Patient as Model;
use App\Models\User;
use DB, Str, Input;

class PatientsRepository extends Model implements IPatientsRepository
{

    public function fetch(){
        if(Input::has('search') AND Input::get('search') != null){
            $exploded = explode(" ",str_replace(' & ',' ',Input::get('search')));
            $query = self::query();
            foreach ($exploded as $key => $value) {
                $query->where('fname', 'like', "%{$value}%")
                ->orWhere('lname', 'like', "%{$value}%")
                ->orWhere('address', 'like', "%{$value}%");
            }
            return $query->get();
        }
        return self::all();
    }

    public function saveData($request){
        DB::beginTransaction();
        try {
            $user = User::find($request->user_id);
            $patient = $user? $this->where('user_id', $user->id)->first() : null;
            
            $password = Str::random(8);

            if($request->has('password')){
                $password = $request->password;
            }
            
            //set and save password if theres no user fetch
            if(!$user){
                $user = new User;
                $user->password = bcrypt($password);
            }

            $user->name = $request->fname.' '.$request->lname;
            $user->username = $request->email;
            $user->type = 'patient';
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;

            $user->save();

            if(!$patient){
                $patient = new self;
                $patient->user_id = $user->id;
            }

            $patient->fname = $request->fname;
            $patient->lname = $request->lname;
            $patient->address = $request->address;
            
            if($request->hasFile('file')){
                $upload = UploadLogic::upload($request->file,'storage/patient');
                $patient->path = $upload["path"];
                $patient->directory = $upload["directory"];
                $patient->filename = $upload["filename"];
            }
            
            $patient->save();

            DB::commit();
            $user->password = $password;

            return $user;
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

    public function fetchPatient($user_id){
        $data = self::where('user_id', $user_id)->first();
        if(!$data){
            return false;
        }
        return $data;
    }
}
