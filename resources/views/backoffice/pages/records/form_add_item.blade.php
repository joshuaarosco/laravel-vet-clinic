<form class="form" action="" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="availed_service_id" value="{{ $availedService->id }}" class="form-control">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('item_id')?'error':null}}">
                    <label class="form-label">Item <span class="text-danger">*</span></label>
                    <select name="item_id" class="form-control bg-white input-patient" id="">
                        <option value="">---</option>
                        @foreach($items as $index => $item)
                        @if(old('item_id') == $index)
                        <option value="{{ $index }}" selected>{{ $item }}</option>
                        @else
                        <option value="{{ $index }}">{{ $item }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('item_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('item_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('quantity')?'error':null}}">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" min="0" name="quantity" value="{{old('quantity')}}" class="form-control" placeholder="Quantity">
                    @if($errors->has('quantity'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('quantity')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.records.view_service', $availedService->id)}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>