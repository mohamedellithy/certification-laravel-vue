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
تعديل اعلان {{ $adesense->id }}
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
            <h4 class="card-title">{{ __('dashboard.Edit_Adsenses') }}</h4>
            <form method="POST" action="{{ route('adsenses.update',$adsense->id) }}" class="form-sample" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Page_Name')}}</label>
                            <div class="col-sm-9">
                                <select name="page_name" class="form-control" required>
                                    @forelse(Config('settings.pages') as $page)
                                        <option value="{{ $page ?? null }}" {{ $page == $adsense->page_name ? 'selected' : '' }}>{{ $page ?? null }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Position_ads')}}</label>
                            <div class="col-sm-9">
                                <select name="position" class="form-control" required>
                                    @forelse(Config('settings.positions') as $key => $page)
                                        <option value="{{ $key ?? null }}" {{ $key == $adsense->position ? 'selected' : '' }}>{{ $page ?? null }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.Adsense_Code') }}</label>
                            <div class="col-sm-9">
                                <textarea rows="5" cols="45" type="text" name="code_adsense" class="form-control" placeholder="put code here"> {{ $adsense->code_adsense ?? null }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{__('dashboard.active_adsense')}}</label>
                            <select name="active" class="js-example-basic-single col-sm-9" style="padding:auto !important;" required>
                                <option value="1" {{ $adsense->active == 1 ? 'selected' : null }}> {{__('dashboard.true_active')}}</option>
                                <option value="0" {{ $adsense->active == 0 ? 'selected' : null }}> {{__('dashboard.false_active')}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-danger btn-icon-text">
                            <!-- <i class="ti-file btn-icon-prepend"></i> -->
                            {{__('dashboard.edit_Submit_adsense')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
