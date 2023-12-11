@extends('backoffice._layout.main')

@push('title',$title.' Details')

@push('css')
@endpush

@push('content')
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->	  
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">Health Record Details</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                                @if(in_array(auth()->user()->type,['super_user','admin']))
                                <li class="breadcrumb-item"><a href="{{route('backoffice.records.index')}}"><i class="mdi mdi-account-outline"></i></a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">Health Record Details</li>
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
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="box">
                                <div class="box-body box-profile">            
                                    <div class="row">
                                        <div class="col-12">
                                            <h3  class="fw-300">{{ $record->pet->name }} Health Record</h3>
                                            <hr>
                                            <h5 class="fw-300"><strong>Owner</strong> :<span class="ps-10">
                                                <a class="text-success" target="_blank" href="{{route('backoffice.patients.view', $record->patient_id)}}" title="View Patient Details">{{ $record->patient->user->name }} <small><i class="ti-new-window"></i></small></a></span></h5>
                                                <h5 class="fw-300"><strong>Pet</strong> :<span class="ps-10">
                                                    <a class="text-success" target="_blank" href="{{route('backoffice.pets.view', $record->pet_id)}}" title="View Pet Details">{{ $record->pet->name }} <small><i class="ti-new-window"></i></small></a></span></h5>
                                                    <h5 class="fw-300"><strong>Veterinarian</strong> :<span class="ps-10">
                                                        <a class="text-success" target="_blank" href="{{route('backoffice.vets.view', $record->vet_id)}}" title="View Veterinarian Details">{{ $record->vet->salutation }} {{ $record->vet->user->name }} <small><i class="ti-new-window"></i></small></a></span></h5>
                                                        <h5 class="fw-300"><strong>Procedure</strong> :<span class="text-gray ps-10">{{ $record->procedure }}</span></h5>
                                                        <h5 class="fw-300"><strong>Weight</strong> :<span class="text-gray ps-10">{{ $record->weight }}</span></h5>
                                                        <h5 class="fw-300"><strong>Notes</strong> :<span class="text-gray ps-10">{{ $record->notes }}</span></h5>
                                                        @if(in_array(auth()->user()->type,['super_user','admin','vet']))		
                                                        <hr>
                                                        <a href="{{route('backoffice.records.edit', $record->id)}}" class="btn btn-info me-5 mb-md-0 mb-5 mt-5  btn-outline"><i class="ti-pencil-alt"></i> Edit Health Record</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        @if(in_array(auth()->user()->type,['super_user','admin','vet']) OR (auth()->user()->type == 'patient' AND auth()->user()->patient->id == $record->patient_id))		
                                        <a href="{{route('backoffice.records.transaction_history', $record->id)}}" class="btn btn-dark me-5 mb-md-0 mb-5 mt-5 btn-outline"><i class="ti-flag"></i> Transaction History</a>
                                        <a href="{{route('backoffice.records.invoice', $record->id)}}" class="btn btn-primary me-5 mb-md-0 mb-5 mt-5"><i class="ti-printer"></i> Billing Statement</a>
                                        @endif
                                    </div>
                                </div>		
                            </div>
                            <div class="col-xl-6 col-12">
                                @include('backoffice._components.session_notif')
                                <div class="box">
                                    <div class="box-body">
                                        <div class="table-responsive rounded card-table overflow-visible">
                                            <h3 class="fw-300">Service and Vaccination List</h3>
                                            <hr>
                                            <table class="table border-no" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Next Due Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($availedServices as $index => $aService)
                                                    <tr class="hover-primary">
                                                        <td>{{$index+1}}</td>
                                                        <td>{{$aService->service->name}}</td>
                                                        <td>{{date('M d, Y',strtotime($aService->date))}}</td>
                                                        <td>{{$aService->next_due_date?date('M d, Y',strtotime($aService->next_due_date)):'---'}}</td>
                                                        <td>												
                                                            <div class="btn-group">
                                                                <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{ route('backoffice.records.view_service', $aService->id) }}">View Details</a>
                                                                    {{-- <a class="dropdown-item" href="{{ route('backoffice.pets.edit',$pet->id) }}">Edit</a> --}}
                                                                    {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr class="hover-primary">
                                                        <td colspan="6" class="text-center">No Service and Vaccination record yet...</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>																		
                                </div>	
                                @if(in_array(auth()->user()->type,['super_user','admin','vet']))
                                <a href="{{ route('backoffice.records.add_service', $record->id) }}" class="btn btn-primary"><i class="ti-heart"></i> Add Service</a>			
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