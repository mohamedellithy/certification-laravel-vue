@extends('admin.master')
@section('title')
{{ $department->name ?? 'عرض الشهادات' }}
@endsection
<!-- here put content page -->
@section('content_page')
    <style>
        .sect-parent-1{
            display: inline-block;
            padding: 10px;
            cursor: pointer;
            box-shadow: 3px 8px 8px 8px lightgrey;
            margin: 9px 10px 5px 5px;
            cursor: pointer;
            background-color: white;
        }
        .sect-parent-1 h3
        {
            font-size: 16px;
            padding: 7px 0px;
            line-height: 1.4em;
        }
        img
        {
            width: 100%;
            height: 160px;
        }
        img.img-md{
            width:auto !important;
            height:auto !important;
        }
        .customize-image{
            width:100%;
            margin:10px 10px 0px 0px;
        }
        .form-group label {
            line-height: 1rem;
        }
        form.method-delete{
            display: inline-block;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper">
                            <a href="{{ url('certifications/create',$department->id ?? null) }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-sitemap"></i> {{ __('dashboard.Create_New_Certification') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($errors->any())
                    <div class="col-md-6">
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif(session('message'))
                    <div class="col-md-6">
                        <div class="alert alert-success">{{ session('message') }}</div>
                    </div>
                @endif
            </div>
            @forelse($childs_certifications as $certification)
                <div class="col-md-2 col-sm-6 sect-parent-1">
                    <img src="{{ $certification->image ? $certification->image->path_url : asset('storage/certifications/empty.jpg')  }}"/>
                    <p class="statistics-title">certifications</p>
                    <h3 class="rate-percentage">{{ $certification->name ?? '' }}</h3>
                    <a href="{{ url('certifications/'.$certification->id) }}" type="button" class="btn btn-success btn-sm" style="padding: 0.3rem 1rem;"><i class="mdi mdi-eye"></i></a>
                    <form class="method-delete" method="POST" action="{{ route('certifications.destroy',[$certification->id]) }}" >
                       @csrf
                       @method('delete')
                       <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.3rem 1rem;"> <i class="mdi mdi-delete"></i></button>
                    </form>
                    <a href="{{ url('certifications/'.$certification->id.'/edit') }}" type="button" class="btn btn-info btn-sm" style="padding: 0.3rem 1rem;"> <i class="mdi mdi-tooltip-edit"></i></a>
                    <a href="{{ url('certifications/customize/create/'.$certification->id) }}" type="button" class="btn btn-warning btn-sm customize-image" style="margin-right: 0px;">{{ __('dashboard.Customize_certification') }}</a>
                </div>
            @empty
                <p class="alert alert-info"> {{__('dashboard.No_certification_available_in_Certification') }}</p>
            @endforelse
            {!! $childs_certifications->links() !!}
        </div>
    </div>
@endsection
