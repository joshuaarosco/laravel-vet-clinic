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
                    <h4 class="page-title">Appointments</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backoffice.index') }}"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ config('app.name') }} Calendar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">	
                <div class="col-xl-6 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div id="calendar"></div>
                        </div>
                    </div> 
                </div>
                <div class="col-xl-6 col-lg-6 col-12"> 
                    @include('backoffice._components.session_notif')
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $index => $appointment)
                                        @if((auth()->user()->type == 'patient' AND $appointment->patient->user->id == auth()->user()->id) OR auth()->user()->type != 'patient')
                                        <tr class="hover-primary">
                                            <td>{{$index+1}}</td>
                                            <td><strong>Owner</strong> : {{$appointment->patient->user->name}} <br>
                                                <strong>Pet</strong> : {{ $appointment->pet->name }} <br>
                                                <strong>Vet</strong> : {{ $appointment->vet?$appointment->vet->salutation.' '.$appointment->vet->user->name:'---'}} <br>
                                                <strong>Service</strong> : {{ $appointment->service->name }} (₱ {{ number_format($appointment->service->price,2) }}) <br></td>
                                            <td>{{$appointment->status}}</td>
                                            <td><strong>Start</strong> : {{$appointment->start?date('M d, Y @ h:i a', strtotime($appointment->start)):'---'}} <br>
                                                <strong>End</strong> : {{$appointment->end?date('M d, Y @ h:i a', strtotime($appointment->end)):'---'}}</td>
                                            <td>												
                                                <div class="btn-group">
                                                    <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu">
                                                        @if(auth()->user()->type != 'patient')
                                                        <a class="dropdown-item" href="{{ route('backoffice.appointments.edit', $appointment->id) }}">Edit</a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('backoffice.appointments.delete', $appointment->id) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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
                    @if(auth()->check() AND auth()->user()->type == 'patient')
                    <a href="{{ route('backoffice.appointments.create') }}" class="btn btn-primary">
                        <i class="ti-calendar"></i> Request for Appointment
                    </a>
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
<script src="{{asset('vet-clinic/assets/vendor_components/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/fullcalendar/lib/moment.min.js')}}"></script>

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/fullcalendar.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'Asia/Singapore',
            themeSystem: 'bootstrap5',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            dayMaxEvents: true, // allow "more" link when too many events
            events: {!! $events !!}
        });
        
        calendar.render();
    });
    
</script>
@endpush