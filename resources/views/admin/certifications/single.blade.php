@extends('admin.master')

@push('header_styles')
<!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('asset/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('footer_scripts')
<!-- Plugin css for this page -->
  <script src="{{ asset('asset/vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('asset/js/select2.js') }}"></script>
@endpush

@section('title')
 شهادة {{ $certification->name }}
@endsection

<!-- here put content page -->
@section('content_page')
<style type="text/css">
    .form-group label{
        line-height: .1rem;
    }
    .asColorPicker-input, .dataTables_wrapper select, .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single .select2-search__field, .typeahead, .tt-query, .tt-hint{
        height: 30px;
        padding: 1px 0px;
        border: 1px solid lightgray;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        right: 19px;
    }
    .form-control, .asColorPicker-input, .dataTables_wrapper select, .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single .select2-search__field, .typeahead, .tt-query, .tt-hint
    {
        height: 2.8rem;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        margin-top: 6px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        top: 9px;
    }
    .form-group label {
       font-size: 0.912rem;
    }
    .description-certification{
        padding: 17px 0px;
        font-size: 14px;
    }
    strong{
        font-size: 15px;
        line-height:1.5em;
    }

    a.department{
        font-size: 16px;
        line-height: 2em;
        list-style: none;
        text-decoration: none;
        color: #36c4ba;
        font-weight: bold;
    }

</style>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{__('dashboard.Show_Certificates')}}</h4>
            <form class="form-sample">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{ $certification->image ? $certification->image->url : '' }}" />
                    </div>
                    <div class="col-md-6">
                        <p>{{__('dashboard.Certification_Info')}}</p>
                        <h3>{{ $certification->name ?? '' }}</h3>
                        <p class="description-certification">
                             <strong>{{__('dashboard.Description')}}</strong><br/>
                             {{ $certification->description ?? '' }}
                        </p>
                        <p>
                            <strong>{{__('dashboard.Status')}}</strong><br/>
                            <label>{{ $certification->active == 1 ? 'فعالة' : 'غير فعالة' }} </label>
                        </p>
                        <p>
                            <strong>{{__('dashboard.Department_certification')}}</strong><br/>
                            <a class="department" href="{{ route('departments.show',$certification->department->id) }}">{{ $certification->department ? $certification->department->name : '' }} </a>
                        </p>
                        <p>
                            <a class="btn btn-warning btn-sm customize-image" href="{{ url('certifications/customize/create/'.$certification->id) }}">{{__('dashboard.Customize_certification')}} </a>
                            <a class="btn btn-info btn-sm customize-image" href="{{ url('certifications/'.$certification->id.'/edit') }}">{{__('dashboard.Edit_Certification')}} </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
