
@php
  $clinics = \App\Models\Clinic::published()->get()->pluck("title","id");
@endphp

   <!-- Vertical modal -->
   <div class="vertical-modal-ex">

    <!-- Modal -->
    <div
      class="modal fade"
      id="add-res"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{__('admin.Add new reservation')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{route('admin.patient.res.post')}}" method="post">
                <div>
                    {!! Form::hidden('patient_id', '', ['id'=>'patient_id']) !!}
                    <div class="row form-group">
                        <label class="col-form-label col-form-label-lg col-3">العيادة</label>
                        {!! Form::select("clinic_id",$clinics,null,["style"=>"width: 100%","id"=>"clinic_id",'class'=>'select2 mx-1 col-md-4 form-control']) !!}
                    </div>
                    <div class="row form-group">
                        <label class="col-form-label col-form-label-lg col-3">نوع الحجز</label>
                        <select id="reservation_type" name="reservation_type" required class="select2 form-control mx-1 col-md-4" style="width: 100%">
                        <option selected value="1">كشف</option>
                        <option value="2">استشارة</option>
                        <option value="3">تطعيم</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label class="col-form-label col-form-label-lg col-3">خصم</label>
                        <input id="discount" type="number" class=" form-control mx-1 col-md-4" name="discount">
                    </div>
                    <div class="row form-group">
                        <label class="col-form-label col-form-label-lg col-3">زيادة</label>
                        <input id="extra" type="number" class=" form-control mx-1 col-md-4" name="extra">
                    </div>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <div class="row text-center">
                  <button type="submit"  id="reserveBTN" class="btn btn-success" data-dismiss="modal">{{__('admin.Create')}}</button>

              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Vertical modal end-->
