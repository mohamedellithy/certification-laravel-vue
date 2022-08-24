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
تعديل {{ $single->name }} 
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
</style>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{__('dashboard.edit_department')}}</h4>
            <form method="POST" action="{{ route('departments.update',[$single->id]) }}" class="form-sample">
                @csrf
                @method('PUT')
                
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
                            <label class="col-sm-3 col-form-label">{{ __('dashboard.section_name') }}</label>
                            <div class="col-sm-9">
                                <input name="name" value="{{ $single->name ?? null }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.slug')}}</label>
                            <div class="col-sm-9">
                                <input name="slug" value="{{ $single->slug ?? null }}" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Parent_Section') }}</label>
                            <select name="parent_id" value="{{ old('parent_id') }}" class="js-example-basic-single col-sm-9" style="padding:auto !important;">
                                <option value="">{{__('dashboard.without_parent')}}</option>
                                @forelse($departments as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == $single->parent_id ? "selected" : null }}>{{ $department->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Description')}}</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control">{{ $single->description ?? null }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Child_of_section')}}</label>
                            <select name="have_child_departments" class="js-example-basic-single col-sm-9" style="padding:auto !important;" required>
                                <option value="1" {{ $single->have_child_departments == 1 ? "selected" :"" }}> {{__('dashboard.other_departments')}}</option>
                                <option value="0" {{ $single->have_child_departments == 0 ? "selected" :"" }}> {{__('dashboard.Certificates')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.active_department')}}</label>
                            <select name="active" class="js-example-basic-single col-sm-9" style="padding:auto !important;" required>
                                <option value="1" {{ $single->active == 1 ? "selected" :"" }}>  {{__('dashboard.true_active') }}</option>
                                <option value="0" {{ $single->active == 0 ? "selected" :"" }}>  {{__('dashboard.false_active') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-danger btn-icon-text">
                            <!-- <i class="ti-file btn-icon-prepend"></i> -->
                            {{__('dashboard.submit_edit_department') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
