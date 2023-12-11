@extends('backoffice._layout.main')

@push('title','Billing Statement Details')

@push('css')
<style>
  .invoice-logo{
    border: 1px solid #cccccc;
    height: 110px;
    border-radius: 50%;
    text-align: center;
  }
  .logo{
    padding: 5px;
    padding-left: 10px;
    margin-top: 5px;
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
                  <h4 class="page-title">Billing Statement</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('backoffice.index') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>  

      <!-- Main content -->
      <section class="invoice printableArea">
        <div class="row">
          {{-- <div class="col-12">
            <div class="bb-1 clearFix">
              <div class="text-end pb-15">
                  <button class="btn btn-success" type="button"> <span><i class="fa fa-print"></i> Save</span> </button>
                  <button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
              </div>	
            </div>
          </div> --}}
          <div class="col-12">
            @include('backoffice._components.session_notif')
            <div class="page-header bb-1 clearFix">
              <h2 class="d-inline"><span class="fs-30">Billing Statement</span></h2>
              <div class="pull-right text-end">
                  <h3>{{ date('d M Y') }}</h3>
              </div>	
            </div>
          </div>
          <!-- /.col -->
        </div>
        <div class="row invoice-info">
          <div class="col-md-1 invoice-col">
            <div class="light-logo invoice-logo"><img class="logo" src="{{asset('vet-clinic/images/logo-letter.png')}}" alt="logo"></div>
          </div>
          <div class="col-md-5 invoice-col">
            <strong>From</strong>	
            <address>
              <strong class="text-blue fs-24">{{ config('app.name')}}</strong><br>
              <strong class="d-inline">27 Burgos St, Downtown District, Dagupan, Pangasinan</strong><br>
              <strong>Phone: (075) 522 0219 &nbsp;&nbsp;&nbsp;&nbsp; Email: vetClinic@example.com</strong>  
            </address>
          </div>
          <!-- /.col -->
          <div class="col-md-6 invoice-col text-end">
            <strong>To</strong>
            <address>
              <strong class="text-blue fs-24">{{ $record->patient->user->name }}</strong><br>
              {{ $record->patient->address }}<br>
              <strong>Phone: {{ $record->patient->user->contact_number }} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{ $record->patient->user->email }} </strong>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-12 invoice-col mb-15 mt-15">
              <div class="invoice-details row no-margin">
                <div class="col-md-6 col-lg-6">Invoice: <strong>#{{ $record->invoice->invoice_number }}</strong></div>
                {{-- <div class="col-md-6 col-lg-3"><b>Order ID:</b> FC12548</div> --}}
                {{-- <div class="col-md-6 col-lg-6"><b>Payment Due:</b> 14/08/2023</div> --}}
                <div class="col-md-6 col-lg-6">Status: <strong class="{{ $record->invoice->status=='Paid'?'text-primary':'text-warning' }}">{{ $record->invoice->status }}</strong></div>
              </div>
          </div>
        <!-- /.col -->
        </div>
        @php
        $total = 0;
        @endphp
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-bordered">
              <tbody>
              <tr>
                <th>#</th>
                <th>Services</th>
                <th>Description</th>
                <th class="text-end">Service Cost</th>
              </tr>
              @foreach($services as $index => $service)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $service->service->name }}</td>
                <td>{{ $service->service->description }}</td>
                @php
                $total += $service->service->price;
                @endphp
                <td class="text-end">₱ {{ number_format($service->service->price, '2') }}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-bordered">
              <tbody>
              <tr>
                <th>#</th>
                <th>Item Code</th>
                <th>Additional Items</th>
                <th>Type</th>
                <th class="text-end">Quantity</th>
                <th class="text-end">Unit Cost</th>
                <th class="text-end">Sub Total</th>
              </tr>
              @foreach($items as $index => $item)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->item->item_code }}</td>
                <td>{{ $item->item->name }}</td>
                <td>{{ ucfirst($item->item->type) }}</td>
                <td class="text-end">{{ $item->quantity }}</td>
                <td class="text-end">₱ {{ number_format($item->price, 2) }}</td>
                @php
                $subtotal = $item->quantity * $item->price;
                $total += $subtotal;
                @endphp
                <td class="text-end">₱ {{ number_format($subtotal, 2) }}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12 text-end">
              {{-- <p class="lead"><b>Payment Due</b><span class="text-danger"> 14/08/2023 </span></p> --}}

              <div>
                  <p>Sub - Total amount  :  ₱ {{ number_format($total,2) }}</p>
                  @php
                  $tax = $total * config('services.tax');
                  @endphp
                  <p>Tax (12%)  :  ₱ {{ number_format($tax,2) }}</p>
              </div>
              <div class="total-payment">
                  @php
                    $total_payment = $total+$tax;
                  @endphp
                  <h3><b>Total :</b> ₱ {{ number_format($total_payment,2) }}</h3>
              </div>

          </div>
          <!-- /.col -->
        </div>
        
        <div class="row no-print">
          <div class="col-12">
            <a href="{{ route('backoffice.records.view', $record->id) }}" class="btn btn-dark btn-outline"><i class="ti-arrow-left"></i> Back to Health Record</a>
            @if(auth()->user()->type == 'patient' AND $record->patient->id == auth()->user()->patient->id AND $record->invoice->status == 'Pending' AND $total_payment > 0)
            <a href="{{ route('backoffice.records.xendit_payment', $record->id) }}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </a>
            @endif
            @if(auth()->user()->type != 'patient')
            <a href="{{ route('backoffice.records.cash_payment', $record->id) }}" class="btn btn-success pull-right">Pay in Cash</a>
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
<script src="{{asset('vet-clinic/assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js')}}"></script>
<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>

<script src="{{asset('vet-clinic/main/js/pages/invoice.js')}}"></script>
@endpush