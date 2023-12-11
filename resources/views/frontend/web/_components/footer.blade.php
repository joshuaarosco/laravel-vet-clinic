<section class="p-b-30 p-t-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                {{-- <img src="{{asset('web/assets/images/logo_black.png')}}" class="logo inline m-r-50" alt=""> --}}
                <p>{{env('APP_NAME')}}</p>
                {{-- <div class="m-t-10 ">
                    <ul class="no-style fs-11 no-padding font-arial">
                        <li class="inline no-padding">
                            <a href="#" class=" text-master p-r-10 b-r b-grey">Home</a>
                        </li>
                        <li class="inline no-padding">
                            <a href="#" class="hint-text text-master p-l-10 p-r-10 b-r b-grey">Themeforest</a>
                        </li>
                        <li class="inline no-padding">
                            <a href="#" class="hint-text text-master p-l-10 p-r-10 b-r b-grey">Support</a>
                        </li>
                        <li class="inline no-padding">
                            <a href="#" class="hint-text text-master p-l-10 p-r-10 xs-no-padding xs-m-t-10">Made with Pages</a>
                        </li>
                    </ul>
                </div> --}}
            </div>
            <div class="col-sm-6 text-right font-arial sm-text-left">
                <p class="fs-11 muted">Copyright &copy; {{date('Y')}} {{env('APP_NAME')}}. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</section>
