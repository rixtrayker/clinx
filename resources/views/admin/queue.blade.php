@extends('layouts.contentLayoutMaster')
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


        <div class="text-center">
            <h2 >
            <a class="btn-lg btn-primary py-2 px-2" href="{{route('patients.index')}}">
                    {{__('admin.Children')}} <i data-feather="users"></i>
                </a>
            </h2>
        </div>

        <div class="row px-4 py-4">
            <div class="col-4 ">
                <div class="queue-circle py-3">
                    <h3>المريض الحالى:

                        @if($rowCurrent)
                          <a href="{{url('/ar/admin/patients/view/'.$rowCurrent->patient->id)}}">{{$rowCurrent->patient->patient_number}}  - {{$rowCurrent->patient->name}}</a>
                        {{-- {{$rowCurrent->patient->patient_number}}  - {{$rowCurrent->patient->name}}</h3> --}}
                        @else
                        0
                        @endif
                    </h3>
                </div>
            </div>
            <div class="col-4">
                <div class="queue-circle py-3">
                    <h3>المريض التالى:
                        @if(sizeof($rowsE) > 0)
                        {{$rowsE[0]->patient->patient_number}} - {{$rowsE[0]->patient->name}}
                        @elseif(sizeof($rowsN) > 0)
                        {{$rowsN[0]->patient->patient_number}} - {{$rowsN[0]->patient->name}}
                        @else
                        0

                        @endif
                      </h3>
                </div>
            </div>
            <div class="col-4">
                <div class="queue-circle py-3">
                    <h3>عدد الحالات فى صف الانتظار:
                        {{sizeof($rows)}}
                    </h3>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table tabel-stripped">
                <tbody>
                    <tr class="text-lg bold">
                        <td class="text-center">اسم الطفل</td>
                        <td class="text-center">رقم ملف</td>
                        <td class="text-center">رقم الدور</td>
                        <td class="text-center">الحجز</td>
                        <td class="text-center">نوع الحجز</td>
                        <td class="text-center">الاجراءات</td>
                    </tr>

                    @foreach($rowsE as $row)
                      <tr>
                        <td>{{$row->name}}</td>
                        <td>{{$row->patient_number}}</td>
                        <td></td>
                        <td>@if($row->reservation_type == 1)
                          كشف
                          @elseif($row->reservation_type == 2)
                          استشارة
                          @elseif($row->reservation_type == 3)
                          تطعيم
                          @endif
                        </td>
                        <td>
                          مستعجل
                        </td>
                        <td><a class="btn btn-danger" href="{{url('/admin/patients/delete-reservation/'.$row->id)}}">مسح الحجز</a></td>
                      </tr>
                    @endforeach
                    @php
                    $nRowsN = App\Models\Reservation::whereNull("extra")->whereIn("status",[0,1,2])->
                    whereDate('created_date', date('Y-m-d'))->orderBy("created_date","asc")->pluck('id')->toArray();
                    @endphp
                    @foreach($rowsN as $row)
                      <tr>
                        <td>{{$row->name}}</td>
                        <td>{{$row->patient_number}}</td>
                        <td>
                            @php

                                    $n= array_search($row->id,$nRowsN)+1;
                            @endphp
                            {{$n}}
                            {{-- {{$loop->iteration}} --}}
                        </td>
                        <td>@if($row->reservation_type == 1)
                          كشف
                          @elseif($row->reservation_type == 2)
                          استشارة
                          @elseif($row->reservation_type == 3)
                          تطعيم
                          @endif
                        </td>
                        <td>
                          عادي
                          </td>
                        <td><a class="btn btn-danger" href="{{url('/admin/delete-reservation/'.$row->id)}}">مسح الحجز</a></td>
                      </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        </div>
</div>

@endsection
