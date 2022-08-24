@extends('admin.master')

@push('header_styles')
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('asset/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- import fonts  -->
    @forelse($fonts as $font)
    <style>
    @font-face{
        font-family:"{{ $font->font_family }}";
        src: url("{{ $font->full_url_file ?? $font->cdn_font_url }}") format("truetype");
    }
    </style>
    @empty
    @endforelse
@endpush

@push('header_scripts')
   <script src="{{ asset('js/app.js') }}" defer></script>
@endpush
@push('footer_scripts')
  <!-- Plugin css for this page -->
  <script src="{{ asset('asset/vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('asset/js/select2.js') }}"></script>
@endpush
@section('title')
تعديل الحقول 
@endsection
<!-- here put content page -->
@section('content_page')
<style type="text/css">
    i{
        font-family: auto !important;
    }
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
       line-height: 1rem;
    }
    .alert-info-deprtment{
        color: #000000;
        background-color: #f4f5f7;
        border-color: #f4f5f7;
    }
</style>
<div class="col-12 grid-margin" id="app">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{__('dashboard.Customize_certification') }}</h4>
            <!-- alert for department -->
            @if(isset($department) && ($department->have_child_departments == 1))
                <p class="alert alert-danger">
                    Department must don't have certifications , only departments to change from here <a href="{{ route('departments.edit',$department->id) }}">reset</a>
                </p>
            @endif

            <!-- show errors  -->
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
            <customize-certification :width="{{ $width }}" :height="{{ $height }}" :fonts="{{ $fonts ?: [] }}" :certification="{{ $certification ?: [] }}" image="{{ $certification->image ? $certification->image->path_url : null }}"></customize-certification>
        </div>
    </div>
</div>
@endsection
