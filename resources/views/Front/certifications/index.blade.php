@extends('Front.master') 

@push('header_styles')
<style>
    .ads-top-side{
        width: 80%;
        /* background-color: red; */
        height: auto;
        margin: 0% 10%;
        text-align: center;
    }
</style>
@endpush
@push('header_scripts')
   <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('title')
    {{ $certification->name }}
@endsection
@section('content')
    <section id="app" class="benefits-section theme-bg-light-gradient py-5">
        @include('Front.ads.top')
        <generate-certification :certification="{{ $certification ?? json_decode([]) }}"></generate-certification>
    </section>
@endsection