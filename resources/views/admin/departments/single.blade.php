@extends('admin.master')
@section('title')
{{ $department->name }}
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
            border: 3px solid #ad1457;
        }
        .sect-parent-1 h3
        {
            font-size: 16px;
            padding: 7px 0px;
            line-height: 1.4em;
        }
        .pagination
        {
            margin: 20px 0px;
            direction: ltr;
            text-align: right !important;
        }
        .method-delete{
            display: inline-block;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper">
                            <a href="{{ url('departments/create',['parent_id' => $department->id]) }}" class="btn btn-primary text-white me-0"><i class="mdi mdi-sitemap"></i> {{__('dashboard.Create_New_Section')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @forelse($childs as $child)
                <div class="col-md-2 col-sm-6 sect-parent-1">
                    <p class="statistics-title">{{ __('dashboard.department')}}</p>
                    <h3 class="rate-percentage">{{ $child->name }}</h3>
                    <a href="{{ route('departments.show'   ,[$child->id]) }}" type="button" class="btn btn-success btn-sm" style="padding: 0.3rem 1rem;"><i class="mdi mdi-eye"></i></a>
                    <form class="method-delete" method="POST" action="{{ route('departments.destroy',[$child->id]) }}" >
                       @csrf
                       @method('delete')
                       <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.3rem 1rem;"> <i class="mdi mdi-delete"></i></button>
                    </form>
                    <a href="{{ route('departments.edit',[$child->id]) }}" type="button" class="btn btn-warning btn-sm" style="padding: 0.3rem 1rem;"><i class="mdi mdi-tooltip-edit"></i></a>
                </div>
            @empty
                <p class="alert alert-primary"> {{__('dashboard.No_departments_available')}} </p>
            @endforelse
            {!! $childs->links() !!}
        </div>
    </div>
@endsection
