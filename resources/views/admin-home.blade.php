@extends('layouts.contentLayoutMaster')
@section('title',__('admin.Dashboard'))
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-center">{{$date}}</h3>
    </div>
    <div class="card-body">

        <div>
            <div>
              <div class="panel-body">
                <div class="row col-with-divider">
                  <h3>المريض الحالى:
                    @php
                        $rows = App\Models\Reservation::whereIn("status",[2])->
                        whereBetween('created_at',[date('Y-m-d').' 00:00:00', date('Y-m-d H:i:s')])->orderBy("created_at","asc")->get();
                    @endphp
                    @php
                        $rowCurrent = App\Models\Reservation::whereIn("status",[0])->
                        whereBetween('created_at',[date('Y-m-d').' 00:00:00', date('Y-m-d H:i:s')])->orderBy("created_at","asc")->first();
                        // dd(date('Y-m-d H:i:s'));
                        // dd($rowCurrent);
                    @endphp
                    @if($rowCurrent)
                      <a href="{{url('/ar/admin/patients/view/'.$rowCurrent->patient->id)}}">{{$rowCurrent->patient->patient_number}}  - {{$rowCurrent->patient->name}}</a></h3>
                      {{-- {{$rowCurrent->patient->patient_number}}  - {{$rowCurrent->patient->name}}</h3> --}}
                    @else
                    0
                    @endif
                </div>
               </div>
            </div>
        </div>
        @php
        $rowsE = App\Models\Reservation::whereNotNull("extra")->whereIn("status",[2])->
                whereBetween('created_at', [date('Y-m-d')." 00:00:00",date('Y-m-d H:i:s')])->orderBy("created_at","asc")->get();
        $rowsN = App\Models\Reservation::whereNull("extra")->whereIn("status",[2])->
                whereBetween('created_at', [date('Y-m-d')." 00:00:00",date('Y-m-d H:i:s')])->orderBy("created_at","asc")->get();
        @endphp
        <div>
            <div>
              <div class="panel-body">
                <div class="row col-with-divider">
                  <h3>المريض التالى:
                    @if(sizeof($rowsE) > 0)
                    {{$rowsE[0]->patient->patient_number}} - {{$rowsE[0]->patient->name}}
                    @elseif(sizeof($rowsN) > 0)
                    {{$rowsN[0]->patient->patient_number}} - {{$rowsN[0]->patient->name}}
                    @else
                    0
                    {{dd($rowsN)}}
                    @endif
                  </h3>
                </div>
              </div>
            </div>
          </div>

        <div>
            <div>
                <div class="panel-body">
                <div class="row col-with-divider">
                    <h3>عدد الحالات فى صف الانتظار:
                    {{sizeof($rows)}}
                </div>
                </div>
            </div>
            </div>
        </div>
</div>

@endsection
