@extends('admin.layouts.master')

@section('title')
  <h1 class="page-title">{{trans('admin.Create Job')}}</h1>
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
{!! Form::model($row, ['url' => 'admin/'.$module.'/create', 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
@include('admin.'.$module.'.form',$row)
{!! Form::submit(trans('admin.Save') ,['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@stop
