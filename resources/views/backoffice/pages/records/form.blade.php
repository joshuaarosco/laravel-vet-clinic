<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($record)
    <input type="hidden" name="id" value="{{ $record->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('patient_id')?'error':null}}">
                    <label class="form-label">Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-control bg-white input-patient" id="">
                        <option value="">---</option>
                        @foreach($patients as $index => $patient)
                        @if($record AND $record->patient_id == $index OR old('patient_id') == $index)
                        <option value="{{ $index }}" selected>{{ $patient }}</option>
                        @else
                        <option value="{{ $index }}">{{ $patient }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('patient_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('patient_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('pet_id')?'error':null}}">
                    <label class="form-label">Pet <span class="text-danger">*</span></label>
                    <select name="pet_id" class="form-control bg-white input-pet" id="" {{ $record?'':'disabled="true"' }}" required="true">
                        <option value="">---</option>
                        @if($pets != null)
                        @foreach($pets as $index => $pet)
                        @if($record AND $record->pet_id == $index OR old('pet_id') == $index)
                        <option value="{{ $index }}" selected>{{ $pet }}</option>
                        @else
                        <option value="{{ $index }}">{{ $pet }}</option>
                        @endif
                        @endforeach
                        @endif
                    </select>
                    @if($errors->has('pet_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('pet_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('procedure')?'error':null}}">
                    <label class="form-label">Procedure</label>
                    <input type="text" name="procedure" value="{{old('procedure',$record?$record->procedure:'')}}" class="form-control" placeholder="Procedure">
                    @if($errors->has('procedure'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('procedure')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('vet_id')?'error':null}}">
                    <label class="form-label">Veterinarian <span class="text-danger">*</span></label>
                    <select name="vet_id" class="form-control bg-white" id="">
                        <option value="">---</option>
                        @foreach($vets as $index => $vet)
                        @if($record AND $record->vet_id == $index OR old('vet_id') == $index)
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
                <div class="form-group {{$errors->has('weight')?'error':null}}">
                    <label class="form-label">Weight</label>
                    <input type="text" name="weight" value="{{old('weight',$record?$record->weight:'')}}" class="form-control" placeholder="Weight">
                    @if($errors->has('weight'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('weight')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('notes')?'error':null}}">
                <label class="form-label">Notes</label>
                <textarea rows="3" name="notes" class="form-control" placeholder="Notes">{{old('notes',$record?$record->notes:'')}}</textarea>
                @if($errors->has('notes'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('notes')}}</li></ul></div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.records.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>