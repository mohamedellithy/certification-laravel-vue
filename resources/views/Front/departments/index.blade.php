@extends('Front.master') 

@push('header_styles')
<style>
.pagination {
    display: -webkit-inline-box;
}
.department-link{
    text-decoration: none;
    color: #4c527d;
}
.department-link:hover , 
.department-link:active{
    color: #4c527d;
}
</style>
@endpush
@section('title')
    {{ __('master.Departments') }}
@endsection
@section('content')
<section id="benefits-section" class="benefits-section theme-bg-light-gradient py-5">
    @include('Front.ads.top')
    <div class="container py-5">
        <h2 class="section-heading text-center mb-3">{{ __('master.Browse_Certifications_by_Departments') }}</h2>
        @include('Front.ads.after_title')
        <div class="section-intro single-col-max mx-auto text-center mb-5">{{ __('master.Departments_section') }}</div>
        <div class="row text-center">
            @forelse($departments as $department)
                <div class="item col-12 col-md-6 col-lg-4">
                    <a class="department-link" href="{{ url('/',['department' => $department->slug]) }}">
                        <div class="item-inner p-3 p-lg-4">
                            <div class="item-header mb-3">
                                <div class="item-icon">
                                    <img src="{{ asset('front/images/feature-icon-01.svg') }}" />
                                </div>
                                <h3 class="item-heading">{{ $department->name ?? '-' }}</h3>
                            </div>
                            <!--//item-heading-->
                            <div class="item-desc">
                                {{ $department->description ?? '-' }}
                            </div>
                            <!--//item-desc-->
                        </div>
                    </a>
                    <!--//item-inner-->
                </div>
            @empty @endforelse
            <!--//item-->
            <div class="text-center">
                {!! $departments->links() !!}
            </div>
            <!--//item-->
        </div>
        <!--//row-->
    </div>
    <!--//container-->
</section>
@endsection