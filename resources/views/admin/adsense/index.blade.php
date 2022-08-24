@extends('admin.master')
@section('title')
عرض الاعلانات
@endsection
<!-- here put content page -->
@section('content_page')
<style>
    .sect-parent-1 {
        display: inline-block;
        padding: 10px;
        cursor: pointer;
        box-shadow: 3px 8px 8px 8px lightgrey;
        margin: 9px 10px 5px 5px;
        cursor: pointer;
        background-color: white;
    }

    .sect-parent-1 h3 {
        font-size: 16px;
        padding: 7px 0px;
        line-height: 1.4em;
    }

    img {
        width: 100%;
        height: 160px;
    }

    .customize-image {
        width: 100%;
        margin: 10px 10px 0px 0px;
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
                        <a href="{{ url('adsenses/create') }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-sitemap"></i> 
                        {{ __('dashboard.Create_New_Adsense') }}
                    </a>
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.Show_adsense') }}</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        {{__('dashboard.Page')}}
                                    </th>
                                    <th>
                                        {{__('dashboard.Adsense_Position') }}
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($adsenses as $adsense)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset('asset/images/google-adsense-svgrepo-com.svg') }}" alt="image">
                                        </td>
                                        <td>
                                            {{ $adsense->page_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $adsense->position_text ? __('dashboard.'.$adsense->position_text) : '' }}
                                        </td>
                                        <td>
                                        
                                            <a href="{{ route('adsenses.edit',$adsense->id) }}" class="btn btn-info btn-sm">
                                               <i class="mdi mdi-table-edit"></i>
                                               {{ __('dashboard.Edit_Adsenses') }}
                                            </a>
                                       
                                            <form class="method-delete" method="POST" action="{{ route('adsenses.destroy',[$adsense->id]) }}" >
                                               @csrf
                                               @method('delete')
                                               <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.3rem 1rem;"> <i class="mdi mdi-delete"></i> {{__('dashboard.Delete_Adsenses')}}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"> No Found adesense </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <br/>
                    {!! $adsenses->links() !!}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
