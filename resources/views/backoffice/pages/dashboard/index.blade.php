@extends('backoffice._layout.main')

@push('title','Dashboard')

@push('included-styles')
@endpush

@push('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
          <div class="row">
            @if(auth()->user()->type != 'patient')
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-info"><i class="mdi mdi-briefcase"></i></h1>			
                            <h2>{{ $vetCount }}</h2>
                            <span class="badge badge-pill badge-info px-10 mb-10">Veterinarians</span>					
                        </div>					
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-primary"><i class="mdi mdi-account"></i></h1>	
                            <h2>{{ $patientCount }}</h2>	
                            <span class="badge badge-pill badge-primary px-10 mb-10">Satisfied Patients</span>						
                        </div>					
                    </div>
                </div>
            </div>
            @endif
            <div class="{{ auth()->user()->type == 'patient'?'col-xl-4':'col-xl-2' }} col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-success"><i class="mdi mdi-paw"></i></h1>			
                            <h2>{{ $petCount }}</h2>
                            <span class="badge badge-pill badge-success px-10 mb-10">Pets</span>				
                        </div>					
                    </div>
                </div>
            </div>
            <div class="{{ auth()->user()->type == 'patient'?'col-xl-4':'col-xl-2' }} col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-danger"><i class="mdi mdi-heart"></i></h1>						
                            <h2>{{ $serviceCount }}</h2>
                            <span class="badge badge-pill badge-danger px-10 mb-10">Availed Services</span>	
                        </div>					
                    </div>
                </div>
            </div>
          </div>	
          <div class="row">
            <div class="col-md-8">
                <div class="box no-border no-shadow">
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <h3 class="fw-300">Appointments</h3>
                            <hr>
                            <table class="table border-no" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Information</th>
                                        <th>Status</th>
                                        <th>Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($appointments as $index => $appointment)
                                    <tr class="hover-primary">
                                        <td>{{$index+1}}</td>
                                        <td><strong>Owner</strong> : {{$appointment->patient->user->name}} <br>
                                            <strong>Pet</strong> : {{ $appointment->pet->name }} <br>
                                            <strong>Vet</strong> : {{ $appointment->vet?$appointment->vet->salutation.' '.$appointment->vet->user->name:'---'}} <br>
                                            <strong>Service</strong> : {{ $appointment->service->name }} (₱ {{ number_format($appointment->service->price,2) }}) <br></td>
                                        <td>{{$appointment->status}}</td>
                                        <td><strong>Start</strong> : {{$appointment->start?date('M d, Y @ h:i a', strtotime($appointment->start)):'---'}} <br>
                                            <strong>End</strong> : {{$appointment->end?date('M d, Y @ h:i a', strtotime($appointment->end)):'---'}}</td>
                                    </tr>
                                    @empty
                                    <tr class="hover-primary">
                                        <td colspan="6" class="text-center">No Appointments yet...</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('backoffice.appointments.index') }}" class="btn btn-primary">
                    Go to Appointments <i class="ti-arrow-right"></i>
                </a>
            </div>
          </div>		
      </section>
      <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
@endpush

@push('js')
<!-- Vendor JS -->
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>

<script src="{{asset('vet-clinic/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/date-paginator/moment.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/date-paginator/bootstrap-datepaginator.min.js')}}"></script>

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/dashboard.js')}}"></script>
@endpush
