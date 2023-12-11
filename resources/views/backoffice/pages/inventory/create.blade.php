@extends('backoffice._layout.main')

@push('title','Create New Item')

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
                                <li class="breadcrumb-item active" aria-current="page">Create New Item</li>
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
                            <h4 class="box-title">Create New Item</h4>
                        </div>
                        <!-- /.box-header -->
                        @include('backoffice.pages.inventory.form')
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
    function calculateProfit(){
        let sprice = $(".input-sprice").val();
        let pprice = $(".input-pprice").val();
        let profit = sprice - pprice;
        $(".input-profit").val(profit);
    }
    function calculateTotalProfit(){
        let profit = $(".input-profit").val();
        let stock = $(".input-stock").val();
        let total_profit = stock * profit;
        $(".input-tprofit").val(total_profit);
    }

    $(".input-pprice").on("change keyup keydown", function(){
        calculateProfit();
        calculateTotalProfit();
    });

    $(".input-sprice").on("change keyup keydown", function(){
        calculateProfit();
        calculateTotalProfit();
    });

    $(".input-stock").on("change keyup keydown", function(){
        calculateTotalProfit();
    });
</script>
@endpush