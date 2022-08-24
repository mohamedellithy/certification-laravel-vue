@extends('Front.master')

@push('header_styles')
<style>
.pagination {
    display: -webkit-inline-box;
}
.benefits-section .item-icon{
    padding: 0px 0px 24px 0px;
}
.certificate-section .item-inner {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}
.certificate-section .item-inner:hover{
    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}
.btn-choice{
    font-weight: 600;
    padding: 0.475rem 2rem;
    border-radius:0px !important;
    margin: 16px 0px;
    box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
}

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
    {{ $department->name }}
@endsection

@section('content')
<section id="benefits-section" class="benefits-section theme-bg-light-gradient py-5">
    @include('Front.ads.top')
    <div class="container py-5">
        <h2 class="section-heading text-center mb-3">{{ __('master.Browse',['department' => $department->name ?? __('master.certifications') ]) }}</h2>
        <div class="section-intro single-col-max mx-auto text-center mb-5">{{ __('master.browse_inner_department') }}</div>
        @include('Front.ads.after_title')
        <div class="row text-center">
            @forelse($certifications as $certification)
            <div class="item certificate-section col-12 col-md-6 col-lg-4">
                <div class="item-inner p-3 p-lg-4">
                    <div class="item-header mb-3">
                        <div class="item-icon">
                            <img class="img-fluid" src="{{ $certification->image ? $certification->image->path_url : asset('front/images/feature-icon-01.svg') }}" />
                        </div>
                        <h3 class="item-heading">{{ $certification->name ?? '-' }}</h3>
                    </div>
                    <!--//item-heading-->
                    <div class="item-desc">
                        {{ $certification->description ?? '-' }}
                    </div>
                    <!--//item-desc-->
                    <a class="btn btn-success btn-sm btn-choice" href="{{ url('/',['department' => $department->slug,'certification' => $certification->slug]) }}"> {{ __('master.Choice') }}  </a>
                </div>
                <!--//item-inner-->
            </div>
            @empty @endforelse
            <!--//item-->
            <div class="text-center">
                <br/><br/><br/>
                {!! $certifications->links() !!}
            </div>

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
                <br/><br/><br/>
                {!! $departments->links() !!}
            </div>
            <!--//item-->
        </div>
        <!--//row-->
    </div>
    <!--//container-->
</section>
@endsection
