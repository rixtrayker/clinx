@extends('admin.layouts.master')

@section('title')
  <h1 class="page-title">{{trans('admin.Roles')}}</h1>
@stop

@section('content')
  <style media="screen">
  * { box-sizing: border-box; }
body {
font: 16px Arial;
}
.autocomplete {
/*the container must be positioned relative:*/
position: relative;
display: inline-block;
}

input[type=submit] {
background-color: DodgerBlue;
color: #fff;
}
.autocomplete-items {
position: absolute;
border: 1px solid #d4d4d4;
border-bottom: none;
border-top: none;
z-index: 99;
/*position the autocomplete items to be the same width as the container:*/
top: 100%;
left: 0;
right: 0;
}
.autocomplete-items div {
padding: 10px;
cursor: pointer;
background-color: #fff;
border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
/*when hovering an item:*/
background-color: #e9e9e9;
}
.autocomplete-active {
/*when navigating through the items using the arrow keys:*/
background-color: DodgerBlue !important;
color: #ffffff;
}
  </style>
  <div class="row">
    <div class="col-lg-12 animatedParent animateOnce z-index-50">
      <div class="panel panel-default animated fadeInUp">
        <div class="panel-heading clearfix">
        @role('super-admin')
          <a href="admin/{{$module}}/create" class="btn btn-success">@lang('admin.Create')<i class="fa fa-plus"></i></a>
        @endrole
          <ul class="panel-tool-options">
            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
          </ul>
        </div>
        <div class="panel-body">
@if (!$rows->isEmpty())
{!! Form::open(['url' => 'admin/'.$module.'/delete', 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
<div class="table-responsive">
    <table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table data_table table-striped table-bordered display resize ">
        <thead>
            <tr>
                <th>{{trans('admin.ID')}} </th>
                <th width="25%">{{trans('admin.Job')}}</th>
                <th width="20%">{{trans('admin.Description')}}</th>
                <th width="20%">{{trans('admin.Procedures')}}</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
            <tr>
                <td class="center">{{$row->id}}</td>
                <td class="center">{{$row->name}}</td>
                <td class="center">{{$row->description}}</td>
                <td class="center">
                    @if(ACL::can('edit-'.$module))
                    <a class="btn btn-success btn-xs" href="admin/{{$module}}/edit/{{@$row->id}}" title="{{trans('admin.Edit')}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endif
                    @if(ACL::can('delete-'.$module))
                    <a class="btn btn-danger btn-xs" href="admin/{{$module}}/delete/{{@$row->id}}" title="{{trans('admin.نسح')}}" data-title="{{trans('admin.Confirmation message')}}" data-confirm="{{trans('admin.Are you sure you want to delete this user')}}?">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    @endif
                    @if(ACL::can('permissions-'.$module))
                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/permissions/{{@$row->id}}" title="{{trans('admin.Edit Permissions')}}" >
                        <i class="fa fa-user-secret"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! Form::close() !!}
@else
{{trans("admin.There is no results")}}
@endif
</div>
</div>
</div>
</div>
@stop
