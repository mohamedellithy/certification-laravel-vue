@extends('Front.master')

@push('header_styles')
<style>
.content-section .key-points-list li{
    text-align: justify !important;
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
@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 pt-5 mb-5 align-self-center">
                <div class="promo pe-md-3 pe-lg-5">
                    <h1 class="headline mb-3">
                        {{ __('master.Generate_your_Certifications_within_seconds_without_search_much') }}
                    </h1>
                    <!--//headline-->
                    <div class="subheadline mb-4">
                        {{ __('master.description_home') }}
                    </div>
                    <!--//subheading-->
                    <div class="cta-holder row gx-md-3 gy-3 gy-md-0">
                        <div class="col-12 col-md-auto">
                            <a class="btn btn-primary w-100"
                               href="{{ url('show-departments') }}">
                               {{ __('master.Start_Now') }}</a>
                        </div>
                        <!-- <div class="col-12 col-md-auto">
						        <a class="btn btn-secondary scrollto w-100" href="#benefits-section">Learn More</a>
						    </div> -->
                    </div>
                    <!--//cta-holder-->
                    <div class="hero-quotes mt-5">
                        <div id="quotes-carousel" class="quotes-carousel carousel slide carousel-fade mb-5" data-bs-ride="carousel" data-bs-interval="8000">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#quotes-carousel" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#quotes-carousel" data-bs-slide-to="1"></li>
                                <li data-bs-target="#quotes-carousel" data-bs-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <blockquote class="quote p-4 theme-bg-light">
                                        "مجهود عظيم و يقدر على هذة الخدمة لم اكن اعلم بوجودها و لكن عندما بحثت عنها ووجديتها قمت بتجريبها على الفور و اندهشت من النتائج انها خدمة رائعة"
                                    </blockquote>
                                    <!--//item-->
                                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                                        <div class="col-12 col-md-auto text-center text-md-start">
                                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-1.png') }}" alt="image">
                                        </div>
                                        <!--//col-->
                                        <div class="col source-info text-center text-md-start">
                                            <div class="source-name">Mohamed Khali</div>
                                            <div class="soure-title">Co-Founder, Startup Week</div>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//source-->
                                </div>
                                <!--//carousel-item-->
                                <div class="carousel-item">
                                    <blockquote class="quote p-4 theme-bg-light">
                                        "مجهود عظيم و يقدر على هذة الخدمة لم اكن اعلم بوجودها و لكن عندما بحثت عنها ووجديتها قمت بتجريبها على الفور و اندهشت من النتائج انها خدمة رائعة"
                                    </blockquote>
                                    <!--//item-->
                                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                                        <div class="col-12 col-md-auto text-center text-md-start">
                                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-2.png') }}" alt="image">
                                        </div>
                                        <!--//col-->
                                        <div class="col source-info text-center text-md-start">
                                            <div class="source-name">Mona Said</div>
                                            <div class="soure-title">Co-Founder, Startup Week</div>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//source-->
                                </div>
                                <!--//carousel-item-->
                                <div class="carousel-item">
                                    <blockquote class="quote p-4 theme-bg-light">
                                        "عمل ممتاز ورائع لقد قمت بتوليد الشهادة التى كنت احتاجها لموظفينى فى اقل من دقائق حقا انها خدمة رائعة و مجدية انصحك باستخدامها"
                                    </blockquote>
                                    <!--//item-->
                                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                                        <div class="col-12 col-md-auto text-center text-md-start">
                                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-3.png') }}" alt="image">
                                        </div>
                                        <!--//col-->
                                        <div class="col source-info text-center text-md-start">
                                            <div class="source-name">Khalid Ali</div>
                                            <div class="soure-title">Frontend Developer, Company Lorem</div>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//source-->
                                </div>
                                <!--//carousel-item-->
                            </div>
                            <!--//carousel-inner-->
                        </div>
                        <!--//quotes-carousel-->
                    </div>
                    <!--//hero-quotes-->
                </div>
                <!--//promo-->
            </div>
            <!--col-->
            <div class="col-12 col-md-5 mb-5 align-self-center">
                <div class="book-cover-holder">
                    <img class="img-fluid book-cover" src="{{ asset('front/images/The Top Marketing Automation Certification Courses for Marketers.png') }}" alt="book cover">
                </div>
                <!--//book-cover-holder-->
            </div>
            <!--col-->
        </div>
        <!--//row-->
    </div>
    <!--//container-->
</section>
<!--//hero-section-->

<section id="benefits-section" class="benefits-section theme-bg-light-gradient py-5">
    <div class="container py-5">
        <h2 class="section-heading text-center mb-3">{{ __('master.Browse_Certifications_by_Departments') }}</h2>
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
                <a class="btn btn-primary" href="{{ url('show-departments') }}">{{ __('master.Show_More') }}</a>
            </div>
            <!--//item-->
        </div>
        <!--//row-->
    </div>
    <!--//container-->
</section>
<!--//benefits-section-->

<section id="content-section" class="content-section">
    <div class="container">
        <div class="single-col-max mx-auto">
            <h2 class="section-heading text-center mb-5">{{__('master.What_is_Included') }}</h2>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="figure-holder mb-5">
                        <img class="img-fluid" src="{{ asset('front/images/devbook-devices.png') }}" alt="image">
                    </div>
                    <!--//figure-holder-->
                </div>
                <!--//col-->
                <div class="col-12 col-md-8 mb-5">
                    <div class="key-points mb-4 text-center">
                        <ul class="key-points-list list-unstyled mb-4 mx-auto d-inline-block text-start">
                            <li><i class="fas fa-check-circle me-2"></i> {{  __('master.different_certifications')  }} </li>
                            <li><i class="fas fa-check-circle me-2"></i> {{  __('master.generate_certifications_bulk') }} </li>
                            <li><i class="fas fa-check-circle me-2"></i> {{  __('master.different_certifications_fonts') }} </li>
                        </ul>
                        <div class="text-center"><a class="btn btn-primary" href="{{ url('show-departments') }}">
                                {{ __('master.Start_Now') }}</a></div>
                    </div>
                    <!--//key-points-->

                </div>
                <!--//col-12-->
            </div>
            <!--//row-->
        </div>
        <!--//single-col-max-->
    </div>
    <!--//container-->
</section>
<!--//content-section-->

<!--//form-section-->

<section id="reviews-section" class="reviews-section py-5">
    <div class="container">
        <h2 class="section-heading text-center">{{ __('master.Clients_Reviews') }}</h2>
        <div class="section-intro text-center single-col-max mx-auto mb-5">{{ __('master.description_client_review') }}</div>
        <div class="row justify-content-center">
            <div class="item col-12 col-lg-4 p-3 mb-4">
                <div class="item-inner theme-bg-light rounded p-4">
                    <blockquote class="quote">
                        عمل ممتاز ورائع لقد قمت بتوليد الشهادة التى كنت احتاجها لموظفينى فى اقل من دقائق حقا انها خدمة رائعة و مجدية انصحك باستخدامها
                    </blockquote>
                    <!--//item-->
                    <div class="source row gx-md-3 gy-3 gy-md-0">
                        <div class="col-12 col-md-auto text-center text-md-start">
                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-1.png') }}" alt="image">
                        </div>
                        <!--//col-->
                        <div class="col source-info text-center text-md-start">
                            <div class="source-name">Mohamed Khali</div>
                            <div class="soure-title">Co-Founder, Startup Week</div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//source-->
                    <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                </div>
                <!--//inner-->
            </div>
            <!--//item-->
            <div class="item col-12 col-lg-4 p-3 mb-4">
                <div class="item-inner theme-bg-light rounded p-4">
                    <blockquote class="quote">
                        مجهود عظيم و يقدر على هذة الخدمة لم اكن اعلم بوجودها و لكن عندما بحثت عنها ووجديتها قمت بتجريبها على الفور و اندهشت من النتائج انها خدمة رائعة
                    </blockquote>
                    <!--//item-->
                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                        <div class="col-12 col-md-auto text-center text-md-start">
                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-2.png') }}" alt="image">
                        </div>
                        <!--//col-->
                        <div class="col source-info text-center text-md-start">
                            <div class="source-name">Mona Said</div>
                            <div class="soure-title">Co-Founder, Company Tristique</div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//source-->
                    <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                </div>
                <!--//inner-->
            </div>
            <!--//item-->
            <div class="item col-12 col-lg-4 p-3 mb-4">
                <div class="item-inner theme-bg-light rounded p-4">
                    <blockquote class="quote">
                        عمل ممتاز ورائع لقد قمت بتوليد الشهادة التى كنت احتاجها لموظفينى فى اقل من دقائق حقا انها خدمة رائعة و مجدية انصحك باستخدامها
                    </blockquote>
                    <!--//item-->
                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                        <div class="col-12 col-md-auto text-center text-md-start">
                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-3.png') }}" alt="image">
                        </div>
                        <!--//col-->
                        <div class="col source-info text-center text-md-start">
                            <div class="source-name">Khalid Ali</div>
                            <div class="soure-title">Product Designer, Company Lorem</div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//source-->
                    <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                </div>
                <!--//inner-->
            </div>
            <!--//item-->
            <div class="item col-12 col-lg-4 p-3 mb-4">
                <div class="item-inner theme-bg-light rounded p-4">
                    <blockquote class="quote">
                        مجهود عظيم و يقدر على هذة الخدمة لم اكن اعلم بوجودها و لكن عندما بحثت عنها ووجديتها قمت بتجريبها على الفور و اندهشت من النتائج انها خدمة رائعة
                    </blockquote>
                    <!--//item-->
                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                        <div class="col-12 col-md-auto text-center text-md-start">
                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-4.png') }}" alt="image">
                        </div>
                        <!--//col-->
                        <div class="col source-info text-center text-md-start">
                            <div class="source-name">sara Nabil</div>
                            <div class="soure-title">App Developer, Company Ipsum</div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//source-->
                    <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                </div>
                <!--//inner-->
            </div>
            <!--//item-->
            <div class="item col-12 col-lg-4 p-3 mb-4">
                <div class="item-inner theme-bg-light rounded p-4">
                    <blockquote class="quote">
                        عمل ممتاز ورائع لقد قمت بتوليد الشهادة التى كنت احتاجها لموظفينى فى اقل من دقائق حقا انها خدمة رائعة و مجدية انصحك باستخدامها
                    </blockquote>
                    <!--//item-->
                    <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
                        <div class="col-12 col-md-auto text-center text-md-start">
                            <img class="source-profile" src="{{ asset('front/images/profiles/profile-5.png') }}" alt="image">
                        </div>
                        <!--//col-->
                        <div class="col source-info text-center text-md-start">
                            <div class="source-name">Ahmed alqahtani</div>
                            <div class="soure-title">Co-Founder, Company Integer</div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//source-->
                    <div class="icon-holder"><i class="fas fa-quote-right"></i></div>
                </div>
                <!--//inner-->
            </div>
            <!--//item-->
        </div>
        <!--//row-->
        <div class="text-center">
            <a class="btn btn-primary" href="{{ url('show-departments') }}">
                {{ __('master.benfite_from_reviews') }}</a>
        </div>
    </div>
    <!--//container-->
</section>
@endsection
