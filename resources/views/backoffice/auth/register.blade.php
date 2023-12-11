@extends('backoffice.auth._layout.main')

@push('content')
<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">
        
        <div class="col-12">
            <div class="row justify-content-center g-0">
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="bg-white rounded10 shadow-lg">
                        <div class="content-top-agile p-20 pb-0">
                            <h2 class="text-primary">{{ config('app.name') }}</h2>
                            <p class="mb-0">Register a new membership</p>							
                        </div>
                        <div class="p-40">
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('fname')?'error':null}}">
                                            <div class="input-group mb-3">
                                                <input type="text" name="fname" value="{{ old('fname') }}" class="form-control ps-15 bg-transparent" placeholder="First Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('lname')?'error':null}}">
                                            <div class="input-group mb-3">
                                                <input type="text" name="lname" value="{{ old('lname') }}" class="form-control ps-15 bg-transparent" data-toggle="tooltip" title="Last Name" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 {{$errors->has('email')?'error':null}}">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control ps-15 bg-transparent" placeholder="Email" required>
                                            </div>
                                            @if($errors->has('email'))
                                            <span class="help-block"><ul role="alert"><li>{{$errors->first('email')}}</li></ul></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('contact_number')?'error':null}}">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-transparent"><i class="ti-mobile"></i></span>
                                                <input type="text" name="contact_number" value="{{ old('contact_number') }}" class="form-control ps-15 bg-transparent" placeholder="Contact Number" required data-inputmask="'mask':[ '(9999)999-9999']" data-mask>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('address')?'error':null}}">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class="ti-location-pin"></i></span>
                                        <textarea type="text" name="address" class="form-control ps-15 bg-transparent" placeholder="Address" required>{{ old('address') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group mb-3 {{$errors->has('password')?'error':null}}">
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                        <input type="password" name="password" class="form-control ps-15 bg-transparent" placeholder="Password" required>
                                    </div>
                                    @if($errors->has('password'))
                                    <span class="help-block"><ul role="alert"><li>{{$errors->first('password')}}</li></ul></span>
                                    @endif
                                </div>
                                <div class="form-group mb-3 {{$errors->has('password_confirmation')?'error':null}}">
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control ps-15 bg-transparent" placeholder="Retype Password" required>
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                    <span class="help-block"><ul role="alert"><li>{{$errors->first('password_confirmation')}}</li></ul></span>
                                    @endif
                                </div>
                                <div class="row">
                                    {{-- <div class="col-12">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_1" >
                                            <label for="basic_checkbox_1">I agree to the <a href="#" class="text-warning"><b>Terms</b></a></label>
                                        </div>
                                    </div> --}}
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info margin-top-10">SIGN UP</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>				
                            <div class="text-center">
                                <p class="mt-15 mb-0">Already have an account?<a href="{{ route('backoffice.auth.login') }}" class="text-danger ms-5"> Sign In</a></p>
                            </div>
                        </div>
                    </div>								
                </div>
            </div>
        </div>			
    </div>
</div>
@endpush