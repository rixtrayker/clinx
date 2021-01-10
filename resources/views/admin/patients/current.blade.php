
@extends('layouts/contentLayoutMaster')

@section('title', __('locale.Current'))


@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
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
        <h4 class="card-title">{{@$row->name}}</h4>
        </div>
        <div class="card-body">



            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item"  role="presentation">
                  <a class="nav-link active" id="child-info-tab" data-toggle="pill" href="#child-info"  aria-selected="true">@lang('admin.Child info')</a>
                </li>
                <li class="nav-item"  role="presentation">
                  <a class="nav-link" id="fmh-tab" data-toggle="pill" href="#fmh"  aria-selected="false" >@lang('admin.Family medical history')</a>
                </li>
                <li class="nav-item"  role="presentation">
                  <a class="nav-link" id="cmh-tab" data-toggle="pill" href="#cmh"  aria-selected="false" >@lang('admin.Child medical history')</a>
                </li>
                <li class="nav-item"  role="presentation">
                  <a class="nav-link" id="diag-tab" data-toggle="pill" href="#diag"  aria-selected="false" >@lang('admin.Diagnose')</a>
                </li>
                <li class="nav-item"  role="presentation">
                  <a class="nav-link" id="vacc-tab" data-toggle="pill" href="#vacc"  aria-selected="false" >@lang('admin.Vaccinations')</a>
                </li>
                <li class="nav-item"  role="presentation">
                  <a class="nav-link" id="finances-tab" data-toggle="pill" href="#finances"  aria-selected="false" >@lang('admin.Finances')</a>
                </li>

                </ul>
                <div aria-labelledby="" class="tab-content" id="pills-tabContent">

                    <div aria-labelledby="child-info-tab" class="tab-pane fade show active" id="child-info" role="tabpanel" aria-labelledby="">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>@lang('admin.File number')</td>
                                        <td>{{$row->patient_number}}</td>
                                        <td>@lang('admin.Gender')</td>
                                        <td>{{$row->gender}} </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin.Child name')</td>
                                        <td>{{$row->name}}</td>
                                        <td>@lang('admin.Age')</td>
                                        <td>{{$row->age}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin.Father job')</td>
                                        <td>{{$row->father_job}}</td>
                                        <td>@lang('admin.Mother job')</td>
                                        <td>{{$row->mother_job}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin.Telephone')</td>
                                        <td>{{$row->telephone}}</td>
                                        <td>@lang('admin.Address')</td>
                                        <td>{{$row->giv}} - {{$row->city}} </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin.Whatsapp')</td>
                                        <td>{{$row->whatsapp}}</td>
                                        <td>@lang('admin.Clinic')</td>
                                        <td>{{$row->clinic}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin.Birthdate')</td>
                                        <td>{{$row->birthdate}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>@lang('admin.How you know us')</td>
                                        <td>                                                                                 صديق
                                        <br>
                                                                                                                                                                                                                            </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div aria-labelledby="fmh-tab" class="tab-pane fade" id="fmh" role="tabpanel">...</div>
                    <div aria-labelledby="cmh-tab" class="tab-pane fade" id="cmh" role="tabpanel">...</div>
                    <div aria-labelledby="diag-tab" class="tab-pane fade" id="diag" role="tabpanel">...</div>
                    <div aria-labelledby="vacc-tab" class="tab-pane fade" id="vacc" role="tabpanel">...</div>
                    <div aria-labelledby="finances-tab" class="tab-pane fade" id="finances" role="tabpanel">...</div>
                </div>


        </div>

    </div>
</div>
</div>
</section>

@endsection


@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}

<script>


</script>
@endsection


{{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
    </li>
</ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">.dsvcdcds.</div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
  </div> --}}


    {{-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </li> --}}
