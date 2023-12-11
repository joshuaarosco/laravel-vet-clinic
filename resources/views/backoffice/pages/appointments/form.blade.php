<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($appointment)
    <input type="hidden" name="id" value="{{ $appointment->id }}" class="form-control">
    <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}" class="form-control">
    <input type="hidden" name="pet_id" value="{{ $appointment->pet_id }}" class="form-control">
    <input type="hidden" name="service_id" value="{{ $appointment->service_id }}" class="form-control">
    <input type="hidden" name="details" value="{{ $appointment->details }}" class="form-control">
    @else
    <input type="hidden" name="patient_id" value="{{ auth()->user()->patient->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('pet_id')?'error':null}}">
                    <label class="form-label">Pet <span class="text-danger">*</span></label>
                    <select name="pet_id" class="form-control bg-white {{ auth()->user()->type != 'patient'?'bg-secondary':'' }}" {{ auth()->user()->type != 'patient'?'disabled':'' }}>
                        <option value="">---</option>
                        @foreach($pets as $index => $pet)
                        @if($appointment AND $appointment->pet_id == $index OR old('pet_id') == $index)
                        <option value="{{ $index }}" selected>{{ $pet }}</option>
                        @else
                        <option value="{{ $index }}">{{ $pet }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('pet_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('pet_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('service_id')?'error':null}}">
                    <label class="form-label">Service <span class="text-danger">*</span></label>
                    <select name="service_id" class="form-control bg-white {{ auth()->user()->type != 'patient'?'bg-secondary':'' }}" {{ auth()->user()->type != 'patient'?'disabled':'' }}>
                        <option value="">---</option>
                        @foreach($services as $index => $service)
                        @if($appointment AND $appointment->service_id == $index OR old('service_id') == $index)
                        <option value="{{ $index }}" selected>{{ $service }}</option>
                        @else
                        <option value="{{ $index }}">{{ $service }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('service_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('service_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('details')?'error':null}}">
                <label class="form-label">Details </label>
                <textarea rows="3" name="details" class="form-control {{ auth()->user()->type != 'patient'?'bg-secondary':'' }}" {{ auth()->user()->type != 'patient'?'disabled':'' }} placeholder="Details">{{old('details',$appointment?$appointment->details:'')}}</textarea>
                @if($errors->has('details'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('details')}}</li></ul></div>
                @endif
            </div>
        </div>
        @if(auth()->user()->type != 'patient')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('vet_id')?'error':null}}">
                    <label class="form-label">Veterinarian <span class="text-danger">*</span></label>
                    <select name="vet_id" class="form-control bg-white input-pet">
                        <option value="">---</option>
                        @foreach($vets as $index => $vet)
                        @if($appointment AND $appointment->vet_id == $index OR old('vet_id') == $index)
                        <option value="{{ $index }}" selected>{{ $vet }}</option>
                        @else
                        <option value="{{ $index }}">{{ $vet }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('vet_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('vet_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('status')?'error':null}}">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control bg-white input-pet">
                        <option value="">---</option>
                        @foreach($statuses as $index => $status)
                        @if($appointment AND $appointment->status == $status OR old('status') == $index)
                        <option value="{{ $status }}" selected>{{ $status }}</option>
                        @else
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('status')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('start')?'error':null}}">
                    <label class="form-label">Start Time & Date <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="start" value="{{old('start',$appointment?$appointment->start:'')}}" class="form-control" placeholder="Start Time & Date">
                    @if($errors->has('start'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('start')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('end')?'error':null}}">
                    <label class="form-label">End Time & Date <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="end" value="{{old('end',$appointment?$appointment->end:'')}}" class="form-control" placeholder="End Time & Date">
                    @if($errors->has('end'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('end')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.appointments.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>