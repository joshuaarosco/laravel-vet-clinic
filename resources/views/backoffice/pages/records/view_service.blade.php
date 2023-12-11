@extends('backoffice._layout.main')

@push('title','Service Details')

@push('css')
@endpush

@push('content')
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->	  
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">Service Details</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Service Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>  
        
        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="box">
                        <div class="box-body box-profile">            
                            <div class="row">
                                <div class="col-12">
                                    <h3  class="fw-300">{{ $availedService->service->name }} for {{ $availedService->record->pet->name }}</h3>
                                    <hr>
                                    <h5 class="fw-300"><strong>Type</strong> :<span class="text-gray ps-10">{{ $availedService->service->type }}</span></h5>
                                    <h5 class="fw-300"><strong>Price</strong> :<span class="text-gray ps-10">₱ {{ number_format($availedService->service->price,'2') }}</span></h5>
                                    <h5 class="fw-300"><strong>Description</strong> :<span class="text-gray ps-10">{{ $availedService->service->description }}</span></h5>
                                    <h5 class="fw-300"><strong>Date</strong> :<span class="text-gray ps-10">{{ date('M d, Y',strtotime($availedService->date)) }}</span></h5>
                                    <h5 class="fw-300"><strong>Next Due Date</strong> :<span class="text-gray ps-10">{{ date('M d, Y',strtotime($availedService->next_due_date)) }}</span></h5>
                                    <hr>
                                    @if(in_array(auth()->user()->type,['super_user','admin','vet']))
                                    <a href="{{route('backoffice.records.edit_service', $availedService->id)}}" class="btn btn-info me-5 mb-md-0 mb-5 btn-outline"><i class="ti-pencil-alt"></i> Edit Service</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>		
                    <a href="{{ route('backoffice.records.view', $availedService->record->id) }}" class="btn btn-dark me-5 mb-md-0 mb-5 btn-outline"><i class="ti-arrow-left"></i> Back to Health Record</a>
                </div>
                <div class="col-xl-6 col-12">
                    @include('backoffice._components.session_notif')
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive rounded card-table overflow-visible">
                                <h3 class="fw-300">Item List <small class="text-warning">(List of additional items used on this service.)</small></h3>
                                <hr>
                                <table class="table border-no" id="example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($items as $index => $item)
                                        <tr class="hover-primary">
                                            <td>{{$index+1}}</td>
                                            <td>{{$item->item->item_code}} | {{$item->item->name}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>₱ {{number_format($item->price, 2)}}</td>
                                            <td>												
                                                <div class="btn-group">
                                                    <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu">
                                                        {{-- <a class="dropdown-item" href="{{ route('backoffice.records.view_service', $item->id) }}">View Details</a> --}}
                                                        {{-- <a class="dropdown-item" href="{{ route('backoffice.pets.edit',$pet->id) }}">Edit</a> --}}
                                                        <a class="dropdown-item" href="{{ route('backoffice.records.delete_item', $item->id) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="hover-primary">
                                        <td colspan="6" class="text-center">No items yet...</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>																		
                    </div>
                    @if(in_array(auth()->user()->type,['super_user','admin','vet']))
                    <a href="{{ route('backoffice.records.add_item', $availedService->id) }}" class="btn btn-primary"><i class="ti-package"></i> Add Item</a>
                    @endif
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

<script src="{{asset('vet-clinic/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>	

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/patient-details.js')}}"></script>
@endpush