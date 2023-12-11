<form class="form" action="" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="record_id" value="{{ $record->id }}" class="form-control">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('service_id')?'error':null}}">
                    <label class="form-label">Service <span class="text-danger">*</span></label>
                    <select name="service_id" class="form-control bg-white input-patient" id="">
                        <option value="">---</option>
                        @foreach($services as $index => $service)
                        @if($availedService AND $availedService->service_id == $index OR old('service_id') == $index)
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
            <div class="col-md-6">
                <div class="form-group {{$errors->has('date')?'error':null}}">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" value="{{old('date',$availedService?$availedService->date:'')}}" class="form-control" placeholder="Date">
                    @if($errors->has('date'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('date')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('next_due_date')?'error':null}}">
                    <label class="form-label">Next Due Date </label>
                    <input type="date" name="next_due_date" value="{{old('next_due_date',$availedService?$availedService->next_due_date:'')}}" class="form-control" placeholder="next_due_date">
                    @if($errors->has('next_due_date'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('next_due_date')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.records.view', $record->id)}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>