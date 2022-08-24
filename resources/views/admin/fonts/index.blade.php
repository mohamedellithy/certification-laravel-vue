@extends('admin.master')
@section('title')
عرض الخطوط
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
        display:inline-block;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <div>
                    <div class="btn-wrapper">
                        <a href="{{ url('fonts/create') }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-sitemap"></i>
                        {{__('dashboard.Create_New_Font') }}
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
                    <h4 class="card-title">{{__('dashboard.Show_Fonts')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        {{__('dashboard.Font_name')}}
                                    </th>
                                    <th>
                                        {{__('dashboard.Font_Family')}}
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fonts as $font)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset('asset/images/file-font-icon.png') }}" alt="image">
                                        </td>
                                        <td>
                                            {{ $font->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $font->font_family ?? '' }}
                                        </td>
                                        <td>
                                           
                                            <a href="{{ route('fonts.edit',$font->id) }}" class="btn btn-info btn-sm">
                                               <i class="mdi mdi-table-edit"></i>
                                               {{__('dashboard.Edit_Font')}}
                                            </a>
                                            <form class="method-delete" method="POST" action="{{ route('fonts.destroy',[$font->id]) }}" >
                                               @csrf
                                               @method('delete')
                                               <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.3rem 1rem;"> <i class="mdi mdi-delete"></i> {{__('dashboard.Delete_Font')}}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"> No Found Fonts </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <br/>
                    {!! $fonts->links() !!}
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
