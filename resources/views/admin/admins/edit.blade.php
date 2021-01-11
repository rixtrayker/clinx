
@extends('layouts/contentLayoutMaster')

@section('title',__('admin.Edit'))

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li class="p-1">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section id="basic-input">
<div class="row">
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">@lang('admin.Edit')</h4>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-12">

{!! Form::model($row, ['url' => route('admins.update',$row->id), 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
@method('PUT')
@include('admin.'.$module.'.form',$row)
{!! Form::submit(trans('admin.Save') ,['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

</div>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection


@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

@endsection

@section('page-script')
{{-- Page js files --}}
{{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script> --}}

<script>
      var select = $('.select2');
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });

</script>
@endsection
