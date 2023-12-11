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
                  <h4 class="page-title">Pet Details</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{route('backoffice.patients.view', $patient->id)}}"><i class="mdi mdi-account-outline"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Pet Details</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>  

      <!-- Main content -->
      <section class="content">

          <div class="row">
              <div class="col-xl-5 col-12">
                  <div class="box">
                      <div class="box-body text-end min-h-150" style="background-image:url({{asset('vet-clinic/images/gallery/pet-bg.jpg')}}); background-repeat: no-repeat; background-position: center;background-size: cover;">	
                      </div>						
                      <div class="box-body wed-up position-relative">
                          <div class="d-md-flex align-items-center">
                              <div class=" me-20 text-center text-md-start">
                                  @if($pet->getAvatar())
                                  <img src="{{asset($pet->getAvatar())}}" class="bg-lightest border-light rounded10 patient-avatar" alt="avatar" />	
                                  @endif								
                                  <div class="text-center my-10">
                                      {{-- <p class="mb-0">{{ $pet->patient->user->name }}</p> --}}
                                      <h4>{{$pet->name}}</h4>
                                  </div>
                              </div>
                              <div class="mt-40">
                                  <h3 class="fw-300 mb-5">&nbsp;</h3>
                                  <h5 class="fw-300 mb-5 mt-10"></h5>
                                  <p><strong>Birthday</strong> : {{ date('M d, Y', strtotime($pet->birthday)) }} </br>
                                     <strong>Sex</strong> : {{ $pet->sex }} </br>
                                     <strong>Weight</strong> : {{ $pet->weight }} </br>
                                     <strong>Race</strong> : {{ $pet->race }} </br>
                                     <strong>Species</strong> : {{ $pet->species }} </br>
                                     <strong>Color</strong> : {{ $pet->color }} 
                                  </p>
                              </div>
                          </div>
                          <hr>
                          <a href="{{route('backoffice.pets.edit', $pet->id)}}" class="btn btn-info me-5 mb-md-0 mb-5  btn-outline"><i class="ti-pencil-alt"></i> Edit Pet Details</a>
                      </div>
                  </div>
                    <div class="d-md-flex align-items-center justify-content-between mb-20">						
                        <div class="d-flex">
                            <a href="{{ route('backoffice.patients.view', $patient->id) }}" class="waves-effect waves-light btn btn-outline btn-dark mr-10"><i class="ti-user"></i> View Owner</a>
                        </div>
                    </div>
                  <div class="row">
                      <div class="col-12">
                      </div>
                  </div>					
              </div>
              <div class="col-xl-7 col-12">
                <div class="box">
                    <div class="box-header border-0 pb-0">
                        <h4 class="box-title">Pet Health Records</h4>
                    </div>
                    <div class="box-body">
                        <div class="widget-timeline-icon">
                            <ul>
                                @forelse($records as $index => $record)
                                <li>
                                  <div class="icon bg-primary fa fa-heart-o"></div>
                                  <a class="timeline-panel text-muted" href="#">
                                      <h4 class="mb-2 mt-1"><a href="{{ route('backoffice.records.view', $record->id) }}"> {{ $record->procedure }}</a></h4>
                                      <p class="fs-15 mb-0 ">Vet : <a class="text-success" target="_blank" href="{{ route('backoffice.vets.view', $record->vet_id) }}">{{ $record->vet->salutation }} {{ $record->vet->user->name }} <i class="ti-new-window"></i></a></p>
                                      <p class="fs-15 mb-0 ">Weight : {{ $record->weight }}</p>
                                      <p class="fs-15 mb-0 ">Notes : {{ $record->notes }}</p>
                                      <small class="fs-15 mb-0 "><i class="ti-calendar"></i>&nbsp;&nbsp;{{ date('M d, Y',strtotime($record->created_at)) }}</small>
                                  </a>
                                </li>
                                @empty
                                <li>
                                  <div class="icon bg-primary ti-face-sad"></div>
                                  <a class="timeline-panel text-muted" href="#">
                                      <h4 class="mb-2 mt-1">No Health Records yet</h4>
                                      <p class="fs-15 mb-0 ">---</p>
                                  </a>
                                </li>
                                @endforelse
                            </ul>	
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

<script src="{{asset('vet-clinic/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>	

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/patient-details.js')}}"></script>
@endpush