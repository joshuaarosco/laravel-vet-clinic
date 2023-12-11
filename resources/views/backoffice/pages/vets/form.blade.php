<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($vet)
    <input type="hidden" name="user_id" value="{{ $vet->user->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{$errors->has('salutation')?'error':null}}">
                    <label class="form-label">Salutation</label>
                    <select name="salutation" class="form-control bg-white" id="">
                        <option value="">---</option>
                        @foreach($salutations as $index => $salutation)
                        @if($vet AND $vet->salutation == $salutation)
                        <option value="{{ $salutation }}" selected>{{ $salutation }}</option>
                        @else
                        <option value="{{ $salutation }}">{{ $salutation }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('salutation'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('salutation')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('fname')?'error':null}}">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="fname" value="{{old('fname',$vet?$vet->fname:'')}}" class="form-control" placeholder="First Name">
                    @if($errors->has('fname'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('fname')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('lname')?'error':null}}">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="lname" value="{{old('lname',$vet?$vet->lname:'')}}" class="form-control" placeholder="Last Name">
                    @if($errors->has('lname'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('lname')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('email')?'error':null}}">
                    <label class="form-label">E-mail <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{old('email',$vet?$vet->user->email:'')}}" class="form-control" placeholder="E-mail">
                    @if($errors->has('email'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('email')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('contact_number')?'error':null}}">
                    <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                    <input type="text" name="contact_number" value="{{old('contact_number',$vet?$vet->user->contact_number:'')}}" class="form-control" placeholder="Contact Number" data-inputmask="'mask':[ '(9999)999-9999']" data-mask>
                    @if($errors->has('contact_number'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('contact_number')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('specialty')?'error':null}}">
                    <label class="form-label">Specialty</label>
                    <input type="text" name="specialty" value="{{old('specialty',$vet?$vet->specialty:'')}}" class="form-control" placeholder="Specialty">
                    @if($errors->has('specialty'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('specialty')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('address')?'error':null}}">
                <label class="form-label">Address</label>
                <textarea rows="3" name="address" class="form-control" placeholder="Address">{{old('address',$vet?$vet->address:'')}}</textarea>
                @if($errors->has('address'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('address')}}</li></ul></div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('bio')?'error':null}}">
                <label class="form-label">Short Bio</label>
                <textarea rows="3" name="bio" class="form-control" placeholder="Short Bio">{{old('bio',$vet?$vet->bio:'')}}</textarea>
                @if($errors->has('bio'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('bio')}}</li></ul></div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.vets.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>