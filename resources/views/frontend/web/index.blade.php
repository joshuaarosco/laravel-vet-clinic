@extends('frontend.web._layouts.main',['header' => false])

@push('content')
{{-- Banner --}}
@include('frontend.web._sections.banner')
{{-- End of Banner --}}

{{-- Short Intro --}}
{{-- End of Short Intro --}}

@push('js')
@endpush

@push('css')
<style>
    .bg-success-dark{
        /* background-color: #a8870d; */
    }
</style>
@endpush
