@extends('layouts.contentLayoutMaster')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('title',__('locale.Queue'))
@section('content')

@php
    $rows = App\Models\Reservation::whereIn("status",[2])->
    whereDate('created_date',date('Y-m-d'))->orderBy("created_date","asc")->get();
@endphp
@php
    $rowCurrent = App\Models\Reservation::whereIn("status",[0])->
    whereDate('created_date',date('Y-m-d'))->orderBy("created_date","asc")->first();
    // dd(date('Y-m-d H:i:s'));
    // dd($rowCurrent);
@endphp

@php
$rowsE = App\Models\Reservation::whereNotNull("extra")->whereIn("status",[2])->
        whereDate('created_date', date('Y-m-d'))->orderBy("created_date","asc")->get();
$rowsN = App\Models\Reservation::whereNull("extra")->whereIn("status",[2])->
whereDate('created_date', date('Y-m-d'))->orderBy("created_date","asc")->get();
@endphp
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center">{{@$date}}</h3>
    </div>
    <div class="card-body">


        <div class="text-right">
            <h2 >
            <a class="btn-lg btn-primary py-2 px-2" href="{{route('patients.index')}}">
                    {{__('admin.Children')}} <i data-feather="users"></i>
                </a>
            </h2>
        </div>
        @php
            $clinics = \App\Models\Clinic::pluck('title', 'id');
        @endphp
        <div class="row px-4 pt-4 pb-3">
            <div class="col-4 ">
                <div class="queue-circle py-3">
                    <h3>الموظفين:

                        @php
                            $tmp = \App\Models\User::count();
                            echo $tmp;
                        @endphp
                    </h3>
                </div>
            </div>
            <div class="col-4">
                <div class="queue-circle py-3">
                    <h3>الاطفال :
                        @php
                            $tmp = \App\Models\Patient::count();
                            echo $tmp;
                        @endphp
                      </h3>
                </div>
            </div>
            <div class="col-4">
                <div class="queue-circle py-3">
                    <h3>الحجوزات :
                        @php
                            $tmp = \App\Models\Reservation::count();
                            echo $tmp;
                        @endphp

                    </h3>
                </div>
            </div>
        </div>
        <div class="text-center mb-4">
            {!! Form::model(null, ['url' => route('admin.reports'), 'method' => 'post','enctype'=>'multipart/form-data'] ) !!}
            <div class="row">
                <div class="form-group offset-md-3 col-md-2">
                    {!! Form::rawLabel(null,'من تاريخ',['class' => 'col-form-label col-form-label-lg']) !!}
                    {!! Form::date('from', $from??\Carbon\Carbon::now()->firstOfMonth() , ['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-md-2">
                    {!! Form::rawLabel(null,'الى تاريخ',['class' => 'col-form-label col-form-label-lg']) !!}
                    {!! Form::date('to', $to??\Carbon\Carbon::now() , ['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-md-2">
                    {!! Form::rawLabel(null,'العيادة',['class' => 'col-form-label col-form-label-lg']) !!}
                    {!! Form::select('clinic_id', $clinics ,$clinic_id??null, ['class'=>'form-control select2','placeholder'=>'اختر العيادة']) !!}
                </div>
            </div>
            <button class="btn btn-lg btn-success">بحث</button>
            {!! Form::close() !!}

        </div>

        @php
            $tmp = \App\Models\User::count();
        @endphp

        <div class="row px-4 py-4 ">
            <div class="offset-md-1 col-md-2 ">
                <div class="queue-circle2 py-1">
                    <h4>{{@$res1}} :عدد الكشوفات
                    </h4>

                       <h4>
                            {{@$rev1}} :القيمة
                        </h4>
                </div>
            </div>
            <div class="col-md-2">
                <div class="queue-circle2 py-1">
                    <h4>
                        {{@$res2}} :عدد الاستشارات

                    </h4>
                    <h4>
                        {{@$rev2}} :القيمة
                    </h4>
                </div>
            </div>
            <div class="col-md-2">
                <div class="queue-circle2 py-1">
                    <h4>{{@$resD}} :عدد حالات الخصم
                    </h4>
                    <h4>    {{@$revD}} :القيمة
                    </h4>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="queue-circle2 py-1">
                    <h4>{{@$res3}} :عدد التطعيمات
                    </h4>
                     <h4> {{@$rev3}} :القيمة
                    </h4>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="queue-circle2 py-1">
                    <h4>{{@$resT}} :عدد الزيارات
                    </h4>
                    <h4>
                        {{@$revT}} :الاجمالى
                    </h4>
                </div>
            </div>

        </div>


        </div>
</div>

@endsection

@section('vendor-script')
{{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
    var select = $('.select2');
    select.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownAutoWidth: true,
        width: '100%',
        dropdownParent: $this.parent()
      });
    });
</script>
@endsection
