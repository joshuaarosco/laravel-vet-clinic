<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($inventory)
    <input type="hidden" name="id" value="{{ $inventory->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('item_code')?'error':null}}">
                    <label class="form-label">Item Code <span class="text-danger">*</span></label>
                    <input type="text" name="item_code" value="{{old('item_code',$inventory?$inventory->item_code:'')}}" class="form-control" placeholder="Item Code">
                    @if($errors->has('item_code'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('item_code')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name')?'error':null}}">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{old('name',$inventory?$inventory->name:'')}}" class="form-control" placeholder="Name">
                    @if($errors->has('name'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('name')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('stock')?'error':null}}">
                    <label class="form-label">Stock <span class="text-danger">*</span></label>
                    <input type="number" min="0" name="stock" value="{{old('stock',$inventory?$inventory->stock:'')}}" class="form-control input-stock" placeholder="Stock">
                    @if($errors->has('stock'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('stock')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('purchase_price')?'error':null}}">
                    <label class="form-label">Purchase Price</label>
                    <input type="number" min="0" name="purchase_price" value="{{old('purchase_price',$inventory?$inventory->purchase_price:'')}}" class="form-control input-pprice" placeholder="Purchase Price">
                    @if($errors->has('purchase_price'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('purchase_price')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('sale_price')?'error':null}}">
                    <label class="form-label">Sale Price</label>
                    <input type="number" min="0" name="sale_price" value="{{old('sale_price',$inventory?$inventory->sale_price:'')}}" class="form-control input-sprice" placeholder="Sale Price">
                    @if($errors->has('sale_price'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('sale_price')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('profit')?'error':null}}">
                    <label class="form-label">Profit <small class="text-warning">(Sale Price - Purhcase Price)</small></label>
                    <input type="number" min="0" name="profit" value="{{old('profit',$inventory?$inventory->profit:'')}}" class="form-control input-profit" readonly placeholder="Profit">
                    @if($errors->has('profit'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('profit')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('total_profit')?'error':null}}">
                    <label class="form-label">Total Profit <small class="text-warning">(Stock * Profit)</small></label>
                    <input type="number" min="0" name="total_profit" value="{{old('total_profit',$inventory?$inventory->total_profit:'')}}" class="form-control input-tprofit" readonly placeholder="Total Profit">
                    @if($errors->has('total_profit'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('total_profit')}}</li></ul></div>
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
                        @if($inventory AND $inventory->type == $index)
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
                <div class="form-group {{$errors->has('expiration_date')?'error':null}}">
                    <label class="form-label">Expiration Date</label>
                    <input type="date" name="expiration_date" value="{{old('expiration_date',$inventory?$inventory->expiration_date:'')}}" class="form-control" placeholder="Expiration Date">
                    @if($errors->has('expiration_date'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('expiration_date')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.inventory.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>