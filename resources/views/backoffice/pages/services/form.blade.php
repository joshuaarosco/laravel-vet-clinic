<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($service)
    <input type="hidden" name="id" value="{{ $service->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('name')?'error':null}}">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{old('name',$service?$service->name:'')}}" class="form-control" placeholder="Name">
                    @if($errors->has('name'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('name')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('type')?'error':null}}">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-control bg-white" id="">
                        <option value="">---</option>
                        @foreach($types as $index => $type)
                        @if($service AND $service->type == $index)
                        <option value="{{ $index }}" selected>{{ $type }}</option>
                        @else
                        <option value="{{ $index }}">{{ $type }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('type')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('price')?'error':null}}">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" value="{{old('price',$service?$service->price:'')}}" class="form-control" placeholder="Price">
                    @if($errors->has('price'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('price')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('description')?'error':null}}">
                <label class="form-label">Description</label>
                <textarea rows="3" name="description" class="form-control" placeholder="Description">{{old('description',$service?$service->description:'')}}</textarea>
                @if($errors->has('description'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('description')}}</li></ul></div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.services.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>