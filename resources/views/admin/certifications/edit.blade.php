@extends('admin.master')

@push('header_styles')
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('asset/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@push('header_scripts')
   <script src="{{ asset('js/app.js') }}" defer></script>
@endpush
@push('footer_scripts')
    <!-- Plugin css for this page -->
    <script src="{{ asset('asset/vendors/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('asset/js/select2.js') }}" defer></script>
@endpush

@section('title')
تعديل شهادة {{ $certification->name }}
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
            <h4 class="card-title">{{__('dashboard.Edit_Certification')}}</h4>
            <form method="POST" action="{{ route('certifications.update',$certification->id) }}" class="form-sample" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Certification_name')}}</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ $certification->name ?? '' }}" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.slug')}}</label>
                            <div class="col-sm-9">
                                <input name="slug" value="{{ $certification->slug ?? null }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Parent_Department')}}</label>
                            @if(isset($departments))
                                <select name="department_id" class="js-example-basic-single col-sm-9" style="padding:auto !important;" required>
                                <option> {{__('dashboard.without_departments')}}</option>
                                @forelse($departments as $depart)
                                    <option value="{{ $depart->id ?? '' }}" {{ $department && ($depart->id == $department->id) ? 'selected' : '' }}> {{ $depart->name ?? '' }}</option>
                                @empty
                                    <option> {{__('dashboard.without_departments')}}</option>
                                @endforelse
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Description')}}</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control">{{ $certification->description ?? null }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.active_certificate')}}</label>
                            <select name="active" class="js-example-basic-single col-sm-9" style="padding:auto !important;" required>
                                <option value="1" {{ $certification->active == 1 ? 'selected' : null }}> {{__('dashboard.true_active')}}</option>
                                <option value="0" {{ $certification->active == 0 ? 'selected' : null }}> {{__('dashboard.false_active')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.generate_multi_name')}}</label>
                            <select name="multi_generate" class="js-example-basic-single col-sm-9" style="padding:auto !important;" required>
                                <option value="1" {{ $certification->multi_generate == 1 ? 'selected' : null }}> {{__('dashboard.true_generate')}}</option>
                                <option value="0" {{ $certification->multi_generate == 0 ? 'selected' : null }}> {{__('dashboard.false_generate')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <image-upload
                        :saved-image="{{ $certification->image ? $certification->image : 'null' }}"
                    ></image-upload>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-danger btn-icon-text" {{ isset($department) && ($department->have_child_departments == 1) ? 'disabled':''}}>
                            <!-- <i class="ti-file btn-icon-prepend"></i> -->
                            {{__('dashboard.edit_Submit_certification')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
