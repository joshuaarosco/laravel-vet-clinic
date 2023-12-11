<form class="form" action="" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    @if($patient)
    <input type="hidden" name="patient_id" value="{{ $patient->id }}" class="form-control">
    @endif
    @if($pet)
    <input type="hidden" name="pet_id" value="{{ $pet->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('file')?'error':null}}">
                    @if($pet)
                    <img src="{{asset($pet->getAvatar())}}" class="bg-lightest border-light rounded10 patient-avatar" alt="avatar" />	
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group {{$errors->has('file')?'error':null}}">
                    <label class="form-label">Pet Picture</label>
                    <input type="file" name="file" class="form-control bg-white" accept="image/*">
                    @if($errors->has('file'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('file')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name')?'error':null}}">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{old('name',$pet?$pet->name:'')}}" class="form-control" placeholder="Name">
                    @if($errors->has('name'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('name')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('birthday')?'error':null}}">
                    <label class="form-label">Birthday <span class="text-danger">*</span></label>
                    <input type="date" name="birthday" value="{{old('birthday',$pet?$pet->birthday:'')}}" class="form-control" placeholder="Birthday">
                    @if($errors->has('birthday'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('birthday')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{$errors->has('sex')?'error':null}}">
                    <label class="form-label">Sex <span class="text-danger">*</span></label>
                    <input type="text" name="sex" value="{{old('sex',$pet?$pet->sex:'')}}" class="form-control" placeholder="Sex">
                    @if($errors->has('sex'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('sex')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('weight')?'error':null}}">
                    <label class="form-label">Weight <span class="text-danger">*</span></label>
                    <input type="text" name="weight" value="{{old('weight',$pet?$pet->weight:'')}}" class="form-control" placeholder="Weight in kg">
                    @if($errors->has('weight'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('weight')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('species')?'error':null}}">
                    <label class="form-label">Color <span class="text-danger">*</span></label>
                    <input type="text" name="color" value="{{old('color',$pet?$pet->color:'')}}" class="form-control" placeholder="Color">
                    @if($errors->has('color'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('color')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('race')?'error':null}}">
                    <label class="form-label">Race <span class="text-danger">*</span></label>
                    <input type="text" name="race" value="{{old('race',$pet?$pet->race:'')}}" class="form-control" placeholder="Race">
                    @if($errors->has('race'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('race')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('species')?'error':null}}">
                    <label class="form-label">Species <span class="text-danger">*</span></label>
                    <input type="text" name="species" value="{{old('species',$pet?$pet->species:'')}}" class="form-control" placeholder="Species">
                    @if($errors->has('species'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('species')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.patients.view', $patient->id)}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>