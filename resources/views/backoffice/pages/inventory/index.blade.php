@extends('backoffice._layout.main')

@push('title',$title.' List')

@push('css')
    <style type="text/css">
        .overflow-visible { 
            overflow: visible;
        }
    </style>
@endpush

@push('content')
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->	  
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="me-auto">
                  <h4 class="page-title">{{$title}}</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>
        
      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-12">
                    @include('backoffice._components.session_notif')
                  <div class="box">
                      <div class="box-body">
                          <div class="row">
                            <div class="col-md-4">
                                <form action="" method="get">
                                <input type="text" name="search" value="{{Input::has('search')?Input::get('search'):''}}" class="form-control pull-right" placeholder="Search for an Item...">
                                </form>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <a href="{{route('backoffice.inventory.create')}}" class="waves-effect waves-light btn btn-outline btn-primary mb-5 pull-right">Create New Item</a>
                            </div>
                          </div>
                          <div class="table-responsive rounded card-table overflow-visible">
                              <table class="table border-no" id="example1">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Item Code</th>
                                          <th>Name</th>
                                          <th>Type</th>
                                          <th>Stock</th>
                                          <th>Purchase Price</th>
                                          <th>Sale Price</th>
                                          <th>Profit</th>
                                          <th>Total Profit</th>
                                          <th>Expiration Date</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($inventory as $index => $item)
                                      <tr class="hover-primary">
                                          <td>{{$index+1}}</td>
                                          <td>{{$item->item_code}}</td>
                                          <td>{{$item->name}}</td>
                                          <td>{{$item->type}}</td>
                                          <td>{{$item->stock}}</td>
                                          <td>₱ {{number_format($item->purchase_price?:'0.00', 2,'.',',')}}</td>
                                          <td>₱ {{number_format($item->sale_price?:'0.00', 2,'.',',')}}</td>
                                          <td>₱ {{number_format($item->profit?:'0.00', 2,'.',',')}}</td>
                                          <td>₱ {{number_format($item->total_profit?:'0.00', 2,'.',',')}}</td>
                                          <td>{{$item->expiration_date?date('M d, y',strtotime($item->expiration_date)):'---'}}</td>
                                          <td>												
                                              <div class="btn-group">
                                                <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="{{route('backoffice.inventory.edit', $item->id)}}">Edit</a>
                                                  {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                                                </div>
                                              </div>
                                          </td>
                                      </tr>
                                      @empty
                                      <tr class="hover-primary">
                                        <td colspan="11" class="text-center">No {{$title}} record yet...</td>
                                      </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>			
      </section>
      <!-- /.content -->
    </div>
</div>

@endpush

@push('js')
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/patients.js')}}"></script>
@endpush
