@extends('admin.layouts.master')

@section('title')
  <h1 class="page-title">{{trans('admin.Edit Job Permissions')}}</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-lg-12 animatedParent animateOnce z-index-50">
      <div class="panel panel-default animated fadeInUp">
        <div class="panel-heading clearfix">
          <a href="admin/{{$module}}" class="btn btn-theme04"><i class="fa fa-backward"></i> {{trans('admin.Go back')}}</a>

          <ul class="panel-tool-options">
            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
          </ul>
        </div>
        <div class="panel-body">
          {!! Form::model($row, ['url' => 'admin/'.$module.'/permissions/'.$row->id, 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}

<style media="screen">
label {
  font-weight: 200;
}
</style>
@php
if (@$permissions) {
    $final_roles = array();
    $category = "";
    foreach ($permissions as $role) {
        if ($category != $role->category) {
            $category = $role->category;
            unset($value);
        }
        $key = $role->category;
        $value[$role->id] = $role->title;
        $final_roles[$key] = $value;
    }
}
@endphp
<div class="clearfix"></div>
@if($final_roles)
<div class="control-group">
    <label class="control-label" for="permissions">
        <h3>{{trans('admin.Permissions')}}
        </h3>
    </label>
</div>

@if($final_roles)
<div class="control-group">
    <div class="table-responsive">
      <label >
          <input id="selectAll" for="Paragraphs" name="selectAll" type="checkbox" value="1">
          {{trans('admin.Select All')}}
      </label>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize ">
            <thead>
                <tr>
                    <th width="20%">{{trans('admin.Module')}}</th>
                    <th width="80%">{{trans('admin.Actions')}}</th>
                </tr>
            </thead>
            @foreach ($final_roles as $key => $value)
            <tr>
                <td>
                    <label class="col-md-8 control-label role_head">
                        {!! Form::checkbox('heades[]',1,null,['class'=>'heads main_head_'.str_replace(' ','',$key),'id'=>$key,'for'=>str_replace(' ','',$key)]) !!} &nbsp;&nbsp;&nbsp;&nbsp;{{ucfirst($key)}}
                    </label>
                </td>
                <td>
                    @foreach ($value as $k => $v)
                    <div class="col-md-3">

                        <label class="col-md-12 control-label" for="role_{{$k}}">{!! Form::checkbox('role_list[]',$k,null,['class'=>'childs head_'.str_replace(' ','',$key),'id'=>'role_'.$k,'for'=>str_replace(' ','',$key)]) !!} {{ucfirst($v)}}</label>
                    </div>
                    @endforeach
                </td>
            </tr>
            @endforeach;
        </table>
    </div>
</div>
@endif
@endif
<div class="clearfix"></div>
@section('javascripts')
<script>
    $(function () {
        $("#selectAll").change(function () {
            if ($(this).is(':checked')) {
                $('.heads, .childs').prop('checked', true);
            } else {
                $('.heads, .childs').prop('checked', false);
            }
            console.log("yes");
        });
        $(".heads").change(function () {
            var key = $(this).attr("for");
            console.log(".head_" + key);
            $(".head_" + key).prop('checked', $(this).prop("checked"));
        });
        $(".childs").change(function () {
            var head = $(this).attr("for");
            if ($(this).is(':checked')) {
                $('.main_head_' + head).prop('checked', true);
            } else {
                if ($(".head_" + head + ":checked").size() == 0) {
                    $('.main_head_' + head).prop('checked', false);
                }
            }
        });
        $(".childs").each(function (index) {
            var head = $(this).attr("for");
            if ($(this).is(':checked')) {
                $('.main_head_' + head).prop('checked', true);
            } else {
                if ($(".head_" + head + ":checked").size() == 0) {
                    $('.main_head_' + head).prop('checked', false);
                }
            }
        });
    });


    var arr= {!! json_encode($row->permissions->toArray(),true) !!};
    for(i=0;i<arr.length;i++){
      console.log('#role_'+arr[i].pivot.role_id);
      $('#role_'+arr[i].pivot.permission_id).trigger('click');
    }
</script>
@stop
{!! Form::submit(trans('admin.Save') ,['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@stop
