@extends('backoffice._layout.main')

@push('title','Edit '.$title)

@push('css')
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
                                <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    @include('backoffice._components.session_notif')
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Edit Service</h4>
                        </div>
                        <!-- /.box-header -->
                        <form class="form" action="" method="POST">
                            {{csrf_field()}}
                            @if($availedService)
                            <input type="hidden" name="id" value="{{ $availedService->id }}" class="form-control">
                            @endif
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{$errors->has('service_id')?'error':null}}">
                                            <label class="form-label">Service <span class="text-danger">*</span></label>
                                            <select name="service_id" class="form-control bg-white input-patient" id="">
                                                <option value="">---</option>
                                                @foreach($services as $index => $service)
                                                @if($availedService AND $availedService->service_id == $index OR old('service_id') == $index)
                                                <option value="{{ $index }}" selected>{{ $service }}</option>
                                                @else
                                                <option value="{{ $index }}">{{ $service }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @if($errors->has('service_id'))
                                            <div class="help-block"><ul role="alert"><li>{{$errors->first('service_id')}}</li></ul></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('date')?'error':null}}">
                                            <label class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" value="{{old('date',$availedService?$availedService->date:'')}}" class="form-control" placeholder="Date">
                                            @if($errors->has('date'))
                                            <div class="help-block"><ul role="alert"><li>{{$errors->first('date')}}</li></ul></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('next_due_date')?'error':null}}">
                                            <label class="form-label">Next Due Date </label>
                                            <input type="date" name="next_due_date" value="{{old('next_due_date',$availedService?$availedService->next_due_date:'')}}" class="form-control" placeholder="next_due_date">
                                            @if($errors->has('next_due_date'))
                                            <div class="help-block"><ul role="alert"><li>{{$errors->first('next_due_date')}}</li></ul></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-end">
                                <a href="{{route('backoffice.records.view', $availedService->record->id)}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
                                    <i class="ti-trash"></i> Cancel
                                </a>
                                <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endpush

@push('js')
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>	
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/iCheck/icheck.min.js')}}"></script>

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>

<script src="{{asset('vet-clinic/main/js/pages/advanced-form-element.js')}}"></script>

<script>

    function checkInputPatient(){
        let patient_id = $('.input-patient').val()
        
        if( patient_id != ''){
            $('.input-pet').prop('disabled',false);
            $.ajax({
                type: "POST",
                url: "{{route('backoffice.records.pets')}}",
                data: { _patient_id : patient_id , _token : "{{csrf_token()}}" },
                dataType: "json",
                async: true,
                success: function(data){
                    $('.input-pet option').each(function() {
                        $(this).remove();
                    });

                    $('.input-pet').append($('<option>', { 
                        value: '',
                        text : '---'
                    }));
                    
                    $.each(data.datas, function (i, item) {
                        $('.input-pet').append($('<option>', { 
                            value: item.id,
                            text : item.name 
                        }));
                    });
                },
                error: function(error){
                    console.log(error);
                }
            });
        }else{
            $('.input-pet').prop('disabled',true);
            $('.input-pet').val('');
        }
    }

    $('.input-patient').on('change', function(){
        checkInputPatient();
    });

    checkInputPatient();
</script>
@endpush