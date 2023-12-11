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
                  <h4 class="page-title">Patient Details</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                            @if(in_array(auth()->user()->type,['super_user','admin']))
                            <li class="breadcrumb-item"><a href="{{route('backoffice.patients.index')}}"><i class="mdi mdi-account-outline"></i></a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">Patient Details</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>  

      <!-- Main content -->
      <section class="content">

          <div class="row">
              <div class="col-xl-7 col-12">
                  <div class="box">
                      <div class="box-body text-end min-h-150" style="background-image:url({{asset('vet-clinic/images/gallery/pet-bg.jpg')}}); background-repeat: no-repeat; background-position: center;background-size: cover;">	
                      </div>						
                      <div class="box-body wed-up position-relative">
                          <div class="d-md-flex align-items-center">
                              <div class=" me-20 text-center text-md-start">
                                  @if($patient->getAvatar())
                                  <img src="{{asset($patient->getAvatar())}}" class="bg-lightest border-light rounded10 patient-avatar" alt="avatar" />	
                                  @endif
                              </div>
                              <div class="mt-40">
                                  <h4 class="fw-600 mb-5">&nbsp;</h4>
                                  <h2 class="fw-300 mb-5 mt-10">{{$patient->user->name}}</h2>
                              </div>
                          </div>
                      </div>				
                  </div>
                  <div class="row">
                      <div class="col-xl-6 col-12">
                          <div class="box">
                              <div class="box-body box-profile">            
                                <div class="row">
                                  <div class="col-12">
                                      <div>
                                          <p><strong>Email</strong> :<span class="text-gray ps-10">{{ $patient->user->email }}</span> </p>
                                          <p><strong>Phone</strong> :<span class="text-gray ps-10">{{ $patient->user->contact_number }}</span></p>
                                          <p><strong>Address</strong> :<span class="text-gray ps-10">{{ $patient->address }}</span></p>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="pb-15">						
                                          <p class="mb-10"><strong>Social Profile</strong></p>
                                          <div class="user-social-acount">
                                              <button class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></button>
                                              <button class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></button>
                                              <button class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></button>
                                          </div>
                                      </div>
                                  </div>
									<div class="col-12">
										<div>
											<div class="map-box">
												<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61361.61603803311!2d120.21937038299399!3d16.008256839477177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915e5fe25ac4ad%3A0xdf7c5074eef5f9a8!2sLingayen%2C%20Pangasinan%2C%20Philippines!5e0!3m2!1sen!2sus!4v1681871317263!5m2!1sen!2sus" width="100%" height="175" frameborder="0" style="border:0" allowfullscreen></iframe>
											</div>
										</div>
									</div>
                                </div>
                                		
                                @if(in_array(auth()->user()->type,['super_user','admin']))	
                                <hr>	
                                <a href="{{route('backoffice.patients.edit', $patient->id)}}" class="btn btn-info me-5 mb-md-0 mb-5 btn-outline"><i class="ti-pencil-alt"></i> Edit Patient</a>
                                @else
                                &nbsp;
                                @endif
                              </div>
                              <!-- /.box-body -->
                            </div>
                      </div>
                      <div class="col-xl-6 col-12">
                          <div class="box">
                              <div class="box-header border-0 pb-0">
                                  <h4 class="box-title">Health Records</h4>
                              </div>
                              <div class="box-body">
                                  <div class="widget-timeline-icon">
                                      <ul>
                                        @forelse($records as $index => $record)
                                        <li>
                                            <div class="icon bg-primary fa fa-heart-o"></div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <h4 class="mb-2 mt-1"><a href="{{ route('backoffice.records.view', $record->id) }}"> {{ $record->procedure }}</a></h4>
                                                <p class="fs-15 mb-0 ">Pet : <a class="text-success" target="_blank" href="{{ route('backoffice.pets.view', $record->pet_id) }}">{{ $record->pet->name }} <i class="ti-new-window"></i></a></p>
                                                <p class="fs-15 mb-0 ">Vet : <a class="text-success" target="_blank" href="{{ route('backoffice.vets.view', $record->vet_id) }}">{{ $record->vet->salutation }} {{ $record->vet->user->name }} <i class="ti-new-window"></i></a></p>
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
              </div>
              <div class="col-xl-5 col-12">
                    @include('backoffice._components.session_notif')
                  <div class="box">
                    <div class="box-body">
                        <div class="table-responsive rounded card-table overflow-visible">
                            <h3 class="fw-300">Pet List</h3>
                            <hr>
                            <table class="table border-no" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Species</th>
                                        <th>Race</th>
                                        <th>Color</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($pets as $index => $pet)
                                    <tr class="hover-primary">
                                        <td>{{$index+1}}</td>
                                        <td>{{$pet->name}}</td>
                                        <td>{{$pet->species}}</td>
                                        <td>{{$pet->race}}</td>
                                        <td>{{$pet->color}}</td>
                                        <td>												
                                            <div class="btn-group">
                                              <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('backoffice.pets.view', $pet->id) }}">View Details</a>
                                                <a class="dropdown-item" href="{{ route('backoffice.pets.edit',$pet->id) }}">Edit</a>
                                                {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                                              </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="hover-primary">
                                      <td colspan="6" class="text-center">No Pets record yet...</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>																	
                  </div>	
                  <div class="d-md-flex align-items-center justify-content-between mb-20">		
                    <div class="d-flex">
                        {{-- <a href="javascript:void(0);" class="btn btn-outline btn-danger me-5"><i class="fa fa-times-circle-o"></i> Reject Patient</a> --}}
                        <a href="{{ route('backoffice.pets.create', $patient->id) }}" class="btn btn-primary"><i class="ti-heart"></i> Add Pet</a>
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