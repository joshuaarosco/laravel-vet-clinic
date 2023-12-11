<?php

namespace App\Repositories\Backoffice;
use App\Domain\Interfaces\Repositories\Backoffice\IVetsRepository;

use App\Logic\ImageUploader as UploadLogic;
use App\Models\Backoffice\Vet as Model;
use App\Models\User;
use DB, Str, Input;

class VetsRepository extends Model implements IVetsRepository
{

    public function fetch(){
        if(Input::has('search') AND Input::get('search') != null){
            $exploded = explode(" ",str_replace(' & ',' ',Input::get('search')));
            $query = self::query();
            foreach ($exploded as $key => $value) {
                $query->where('fname', 'like', "%{$value}%")
                ->orWhere('lname', 'like', "%{$value}%")
                ->orWhere('specialty', 'like', "%{$value}%")
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
            $vet = $user? $this->where('user_id', $user->id)->first() : null;
            
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
            $user->type = 'vet';
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;

            $user->save();

            if(!$vet){
                $vet = new self;
                $vet->user_id = $user->id;
            }

            $vet->fname = $request->fname;
            $vet->lname = $request->lname;
            $vet->address = $request->address;
            if($request->has('salutation'))
                $vet->salutation = $request->salutation;
            if($request->has('specialty'))
                $vet->specialty = $request->specialty;
            if($request->has('bio'))
                $vet->bio = $request->bio;

            if($request->hasFile('file')){
                $upload = UploadLogic::upload($request->file,'storage/vet');
                $vet->path = $upload["path"];
                $vet->directory = $upload["directory"];
                $vet->filename = $upload["filename"];
            }
            
            $vet->save();

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

    public function fetchVet($user_id){
        $data = self::where('user_id', $user_id)->first();
        if(!$data){
            return false;
        }
        return $data;
    }
}
