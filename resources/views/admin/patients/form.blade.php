

{!! Form::hidden('patient_number', $patient_number ?? $row->patient_number, null) !!}

<section>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{trans('admin.Child info')}}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            @php $input='clinic_id'; @endphp
            <div class="form-group col-md-6">
                {!! Form::rawLabel($input, trans('admin.Clinic'),['class' => 'col-form-label col-form-label-lg']) !!}
                <div>
                    {!! Form::select($input,$clinics, $row? $row->clinic_id : null,['class'=>'form-control']) !!}

                </div>
            </div>

            @php $input='opening_date'; @endphp
            <div class="form-group col-md-6">
            {!! Form::rawLabel($input,'تاريخ فتح الملف',['class' => 'col-form-label col-form-label-lg']) !!}
                <div>
                    {!! Form::date($input,null,['class'=>'form-control']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            @php $input = 'name'; @endphp
             <div class="form-group col-md-6">
                 {!! Form::rawLabel($input,trans('admin.Name')."<em class='red'>*</em>",['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                     {!! Form::text($input,null,['class'=>'form-control']) !!}
                     @foreach(@$errors->get($input) as $message)
                     <span class="help-inline text-danger">{{ $message }}</span>
                     @endforeach
             </div>
            @php $input = 'birthdate'; @endphp
             <div class="form-group col-md-6">
                 {!! Form::rawLabel($input,trans('admin.Birth Date'),['class' => 'col-form-label col-form-label-lg']) !!}
                     {!! Form::date($input,null,['class'=>'form-control flatpickr-inline flatpickr-input','placeholder'=>'']) !!}
                     @foreach($errors->get($input) as $message)
                     <span class="help-inline text-danger">{{ $message }}</span>
                     @endforeach
             </div>
           </div>
           <div class="row">
            @php $input = 'age'; @endphp
             <div class="form-group col-md-6">
                 {!! Form::rawLabel($input,trans('admin.Age'),['class' => 'col-form-label col-form-label-lg']) !!}
                     {!! Form::text($input,null,['class'=>'form-control ','placeholder'=>'']) !!}
                     @foreach($errors->get($input) as $message)
                     <span class="help-inline text-danger">{{ $message }}</span>
                     @endforeach
             </div>
           @php $input='gender'; @endphp
           <div class="form-group col-md-6">
               {!! Form::rawLabel($input,trans('admin.Gender'),['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
               <div class="form-check form-check-inline ">
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1" checked value="male">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Male')}}</label>
                    </div>
                    <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" value="female">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.Female')}}</label>
                    </div>
                </div>
           </div>
        </div>

        <div class="row">
            @php $input='father_job'; @endphp
            <div class="form-group col-md-6">
            {!! Form::rawLabel($input,trans('admin.Father job'),['class' => 'col-form-label col-form-label-lg']) !!}
                <div>
                    {!! Form::text($input,null,['class'=>'form-control']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
            </div>

            @php $input='mother_job'; @endphp
            <div class="form-group col-md-6">
                {!! Form::rawLabel($input, trans('admin.Mother job'),['class' => 'col-form-label col-form-label-lg']) !!}
                <div>
                    {!! Form::text($input,null,['class'=>'form-control']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            @php $input='telephone'; @endphp
            <div class="form-group col-md-6">
            {!! Form::rawLabel($input,trans('admin.Telephone'),['class' => 'col-form-label col-form-label-lg']) !!}
                <div>
                    {!! Form::text($input,null,['class'=>'form-control']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
            </div>

        @php $input='gov_id'; @endphp
        <div class="form-group col-md-6">
            {!! Form::rawLabel($input,trans('admin.Address'),['class' => 'col-form-label col-form-label-lg']) !!}
            <div class="row">
                <div class="col-md-4">
                  {!! Form::select($input,$govs, $row? $row->gov_id : null,['class'=>'form-control select2 inline' ,"placeholder"=>trans('admin.Governments')]) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
                <div class="col-md-4">
                    @php $input='city_id'; @endphp
                    {!! Form::select($input,$cities, $row? $row->city_id : null,['class'=>'form-control select2 inline' ,"placeholder"=>trans('admin.Cities')]) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        </div>

        <div class="row">
            @php $input = 'whatsapp'; @endphp
             <div class="form-group col-md-6">
                 {!! Form::rawLabel($input,trans('admin.Whatsapp'),['class' => 'col-form-label col-form-label-lg']) !!}
                     {!! Form::text($input,null,['class'=>'form-control ','placeholder'=>'']) !!}
                     @foreach($errors->get($input) as $message)
                     <span class="help-inline text-danger">{{ $message }}</span>
                     @endforeach
             </div>
             @php $input = 'street'; @endphp
             <div class="form-group col-md-6">
                 {!! Form::rawLabel($input,trans('admin.Street'),['class' => 'col-form-label col-form-label-lg']) !!}
                     {!! Form::text($input,null,['class'=>'form-control ','placeholder'=>'']) !!}
                     @foreach($errors->get($input) as $message)
                     <span class="help-inline text-danger">{{ $message }}</span>
                     @endforeach
             </div>
        </div>



    </div>
</div>

</section>

<section>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{trans('admin.Family medical history')}}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            @php $input='father_mother_kindred'; @endphp
           <div class="form-group col-md-4 ">
               {!! Form::rawLabel($input,trans('admin.father_mother_kindred'),['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
               <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1" value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                    </div>
                    <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                    </div>
                </div>
           </div>

           @php $input='family_genetic_diseases_check'; @endphp
           <div class="form-group col-md-6">
               {!! Form::rawLabel($input,trans('admin.family_genetic_diseases_check'),['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
               <div class="form-check form-check-inline">
                   <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1" value="1">
                        <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                    </div>
                    <div class="custom-control custom-radio mx-1">
                        <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                        <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                    </div>
               </div>
            </div>
        </div>

        <!-- row -->
        <div class="row">
            @php $input='father_chronic_diseases'; @endphp
           <div class="form-group col-md-4">
               {!! Form::rawLabel($input,trans('admin.father_chronic_diseases').' ?',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
               <div class="form-check form-check-inline ">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="{{$input}}" id="{{$input}}1" value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Father')}}</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-1">
                    <input type="checkbox" class="custom-control-input" name="{{$input}}" id="{{$input}}2" value="2">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.Mother')}}</label>
                    </div>
                </div>
                 @foreach($errors->get($input) as $message)
                   <span class = 'help-inline text-danger'>{{ $message }}</span>
                @endforeach
           </div>
           @php $input='chronic_diseases'; @endphp
            <div class="form-check form-check-inline" >
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="1" id="{{$input}}1">
                    <label class="custom-control-label" for="{{$input}}1">الضغط</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="2" id="{{$input}}2">
                    <label class="custom-control-label" for="{{$input}}2">السكر</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="3" id="{{$input}}3">
                    <label class="custom-control-label" for="{{$input}}3">حساسية الأنف</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="4" id="{{$input}}4">
                    <label class="custom-control-label" for="{{$input}}4">حساسية الصدر</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="5" id="{{$input}}5">
                    <label class="custom-control-label" for="{{$input}}5">حساسية الجليد</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="6" id="{{$input}}6">
                    <label class="custom-control-label" for="{{$input}}6">أنيميا الفول</label>
                </div>
            </div>

        </div>
        <!-- end row-->

        <!-- row -->
        <div class="row">
            @php $input='father_family_chronic_diseases'; @endphp
           <div class="form-group col-md-4">
               {!! Form::rawLabel($input,trans('admin.father_family_chronic_diseases').' ?',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
               <div class="form-check form-check-inline ">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="{{$input}}" id="{{$input}}1" value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Father')}}</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-1">
                    <input type="checkbox" class="custom-control-input" name="{{$input}}" id="{{$input}}2" value="2">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.Mother')}}</label>
                    </div>
                </div>
                 @foreach($errors->get($input) as $message)
                   <span class = 'help-inline text-danger'>{{ $message }}</span>
                @endforeach
           </div>

           @php $input='family_chronic_diseases'; @endphp
            <div class="form-check form-check-inline">
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="1" id="{{$input}}1">
                    <label class="custom-control-label" for="{{$input}}1">الضغط</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="2" id="{{$input}}2">
                    <label class="custom-control-label" for="{{$input}}2">السكر</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="3" id="{{$input}}3">
                    <label class="custom-control-label" for="{{$input}}3">حساسية الأنف</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="4" id="{{$input}}4">
                    <label class="custom-control-label" for="{{$input}}4">حساسية الصدر</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="5" id="{{$input}}5">
                    <label class="custom-control-label" for="{{$input}}5">حساسية الجليد</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="6" id="{{$input}}6">
                    <label class="custom-control-label" for="{{$input}}6">أنيميا الفول</label>
                </div>
            </div>

        </div>

        <!-- end row-->

        <!-- row -->
            <div class="row">
                @php $input='family_genetic_diseases_CHECK'; @endphp
                <div class="form-group col-md-4">
                    {!! Form::rawLabel($input,trans('admin.family_genetic_diseases').' ?',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
                <div class="form-check form-check-inline ">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                            <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                        </div>
                        <div class="custom-control custom-radio mx-1">
                            <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                            <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                        </div>
                    </div>
                    @foreach($errors->get($input) as $message)
                        <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>

                @php $input = 'family_genetic_diseases'; @endphp
                <div class="form-group col-md-6">
                    {!! Form::rawLabel($input,trans('admin.family_genetic_diseases'),['class' => 'col-form-label col-form-label-lg']) !!}
                    {!! Form::text($input,null,['class'=>'form-control ','placeholder'=>'']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class="help-inline text-danger">{{ $message }}</span>
                    @endforeach
                </div>


            </div>
        <!--end row>

        <!-- row -->
          <div class="row">
            @php $input='brothers_genetic_diseases_check'; @endphp
           <div class="form-group col-md-4">
               {!! Form::rawLabel($input,trans('admin.brothers_genetic_diseases').' ?',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1" value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                    </div>
                    <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                    </div>
                 </div>
                 @foreach($errors->get($input) as $message)
                   <span class = 'help-inline text-danger'>{{ $message }}</span>
                @endforeach
           </div>

            @php $input = 'brothers_genetic_diseases'; @endphp
            <div class="form-group col-md-6">
                {!! Form::rawLabel($input,trans('admin.brothers_genetic_diseases'),['class' => 'col-form-label col-form-label-lg']) !!}
                    {!! Form::text($input,null,['class'=>'form-control ','placeholder'=>'']) !!}
                    @foreach($errors->get($input) as $message)
                    <span class="help-inline text-danger">{{ $message }}</span>
                    @endforeach
            </div>
          </div>
        <!-- end row-->

        <!-- row -->

        <!-- end row-->

        <!-- row -->

        <!-- end row-->

        <!-- row -->

        <!-- end row-->

        <!-- row -->

        <!-- end row-->

        <!-- row -->

        <!-- end row-->




    </div>
</div>

</section>


@php $input='chiled_chronic_diseases'; @endphp
@php $input='chiled_chronic_diseases'; @endphp
@php $input='hospital_care_reason_checked'; @endphp
@php $input='hospital_care_reason'; @endphp
@php $input='chiled_genetics_diseases_checked'; @endphp
@php $input='chiled_genetics_diseases'; @endphp
@php $input='child_number'; @endphp
@php $input='child_week'; @endphp
@php $input='child_moth'; @endphp
@php $input='compulsory_vaccinations_checked'; @endphp
@php $input='compulsory_vaccinations'; @endphp
@php $input='blood_transfer'; @endphp
@php $input='number_of_doses'; @endphp
@php $input='dose_id'; @endphp

 <!-- row -->
    <div class="row">
        @php $input='birth_type'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input, 'نوع الولادة',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">طبيعي</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">قيصرى</label>
                </div>
            </div>
            @foreach($errors->get($input) as $message)
                <span class = 'help-inline text-danger'>{{ $message }}</span>
            @endforeach
        </div>
        @php $input='breastfeeding_type'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input, 'نوع الولادة',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">طبيعي</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">صناعي</label>
                </div>
            </div>
            @foreach($errors->get($input) as $message)
                <span class = 'help-inline text-danger'>{{ $message }}</span>
            @endforeach
        </div>

    </div>
<!-- end row-->
    <div class="row">
        @php $input='drug_sensitivity_checked'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل الطفل يعاني من حساسية لأى دواء؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>

        @php $input = 'drug_sensitivity'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'اسم الدواء',['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                {!! Form::text($input,null,['class'=>'form-control']) !!}
                @foreach(@$errors->get($input) as $message)
                <span class="help-inline text-danger">{{ $message }}</span>
                @endforeach
        </div>

    </div>
<!-- row -->
    <div class="row">
        @php $input='hospitalized'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل تم حجزه فى مستشفى من قبل؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>



    </div>
<!-- end row-->
<div class="row">
    @php $input='did_surgery_checked'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل الطفل أجريت له أى عمليات سابقا؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>

        @php $input='did_surgery'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'اسم العملية',['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                {!! Form::text($input,null,['class'=>'form-control']) !!}
                @foreach(@$errors->get($input) as $message)
                <span class="help-inline text-danger">{{ $message }}</span>
                @endforeach
        </div>
</div>
<!-- row -->
    <div class="row">
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل هناك اى امراض مزمنة عند الطفل ؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        </div>
        @php $input='chiled_chronic_diseases'; @endphp
            <div class="col-md-6 form-check form-check-inline" >
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="1" id="{{$input}}1">
                    <label class="custom-control-label" for="{{$input}}1">الضغط</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="2" id="{{$input}}2">
                    <label class="custom-control-label" for="{{$input}}2">السكر</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="3" id="{{$input}}3">
                    <label class="custom-control-label" for="{{$input}}3">حساسية الأنف</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="4" id="{{$input}}4">
                    <label class="custom-control-label" for="{{$input}}4">حساسية الصدر</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="5" id="{{$input}}5">
                    <label class="custom-control-label" for="{{$input}}5">حساسية الجليد</label>
                </div>
                <div class="custom-control custom-checkbox mx-1">
                    <input class="custom-control-input" name="{{$input}}[]" type="checkbox" value="6" id="{{$input}}6">
                    <label class="custom-control-label" for="{{$input}}6">أنيميا الفول</label>
                </div>
            </div>
    </div>
<!-- end row-->

<!-- row -->
    <div class="row">
        @php $input='compulsory_vaccinations_checked'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل حصل الطفل على التطعيمات الاجبارية المقررة فى جدول وزارة الصحة؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>

        @php $input='compulsory_vaccinations'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'اسم التطعيمات',['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                {!! Form::text($input,null,['class'=>'form-control']) !!}
                @foreach(@$errors->get($input) as $message)
                <span class="help-inline text-danger">{{ $message }}</span>
                @endforeach
        </div>

    </div>
<!-- end row-->


 <!-- row -->
    <div class="row">
        @php $input='hospital_care_reason_checked'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل دخل حضانة بعد ولادته؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>

        @php $input='hospital_care_reason'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'السبب',['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                {!! Form::text($input,null,['class'=>'form-control']) !!}
                @foreach(@$errors->get($input) as $message)
                <span class="help-inline text-danger">{{ $message }}</span>
                @endforeach
        </div>
    </div>
<!-- end row-->

<!-- row -->
    <div class="row">
        @php $input='chiled_genetics_diseases_checked'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل الطفل يعاني من اى امراض وراثية؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>

        @php $input='chiled_genetics_diseases'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'اسم المرض',['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                {!! Form::text($input,null,['class'=>'form-control']) !!}
                @foreach(@$errors->get($input) as $message)
                <span class="help-inline text-danger">{{ $message }}</span>
                @endforeach
        </div>
    </div>
<!-- end row-->

<!-- row -->
    <div class="row">
        @php $input='child_number'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'ترتيب الطفل بين إخوته',['class' => 'col-col-form-label col-form-label-lg col-col-form-label col-form-label-lg-lg']) !!}
                {!! Form::number($input,null,['class'=>'form-control']) !!}
                @foreach(@$errors->get($input) as $message)
                <span class="help-inline text-danger">{{ $message }}</span>
                @endforeach
        </div>
        @php $input='blood_transfer'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'هل تم نقل دم للطفل مسبقا؟',['class' => 'col-form-label col-form-label-lg mb-1','style'=>'display:block']) !!}
        <div class="form-check form-check-inline ">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}1"  value="1">
                    <label class="custom-control-label" for="{{$input}}1">{{trans('admin.Yes')}}</label>
                </div>
                <div class="custom-control custom-radio mx-1">
                    <input type="radio" class="custom-control-input" name="{{$input}}" id="{{$input}}2" checked value="0">
                    <label class="custom-control-label" for="{{$input}}2">{{trans('admin.No')}}</label>
                </div>
            </div>
        </div>


    </div>
<!-- end row-->
    @php
    $months = \App\Models\Month::all()->pluck('title','title');
    $weeks = \App\Models\Week::all()->pluck('title','title');
    @endphp

<!-- row -->
    <div class="row">
        @php $input='child_week'; @endphp
        <div class="form-group col-md-4">
            {!! Form::rawLabel($input,'متى كانت الولادة؟',['class' => 'col-form-label col-form-label-lg']) !!}
            <div class="row">
                <div class="col-md-6">
                  {!! Form::select($input,$weeks, $row? $row->child_week : null,['class'=>'form-control select2 inline' ]) !!}
                    @foreach($errors->get($input) as $message)
                    <span class = 'help-inline text-danger'>{{ $message }}</span>
                    @endforeach
                </div>

                <div class="col-md-6">
                    @php $input='child_month'; @endphp
                    {!! Form::select($input,$months, $row? $row->child_month : null,['class'=>'form-control select2 inline' ]) !!}
                </div>
            </div>
        </div>

        @php $input='number_of_doses'; @endphp
        <div class="form-group col-md-6 ">
            {!! Form::rawLabel($input,'هل حصل على تطعيمات اضافية؟ وعدد الجرعات',['class' => 'col-form-label col-form-label-lg']) !!}
            <div class="row">
                <div class="form-group col-md-4">
                    {!! Form::number($input,null,['class'=>'form-control',"placeholder"=>"عدد الجرعات"]) !!}
                </div>
                @php
                    $vaccinations = \App\Models\Vaccination::pluck('title','id');
                @endphp
                <div class="form-group col-md-4">
                    @php $input='dose_id'; @endphp
                    {!! Form::select($input,$vaccinations, $row? $row->dose_id : null,['class'=>'form-control select2 inline' ,"placeholder"=>"اسم التطعيم"]) !!}
                </div>
            </div>
        </div>
    </div>
<!-- end row-->

<!-- row -->

<!-- end row-->



{{--
<section>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{trans('admin.How you know us')}}</h4>
        </div>
        <div class="card-body">
        </div>
    </div>

</section> --}}



<section>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{trans('admin.How you know us')}}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            @php $input='how_know_us'; @endphp
            <div class="form-group">
                {!! Form::rawLabel($input,'',['class' => 'col-md-4 col-form-label col-form-label-lg']) !!}
                <div class="col-md-8 form-check form-check-inline">

                    <div class="custom-control custom-checkbox mx-1">
                        <input class="custom-control-input" type="checkbox" name="{{$input}}[]"  value="1" id="{{$input}}1">
                        <label class="custom-control-label"  for="{{$input}}1">صديق</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-1">
                        <input class="custom-control-input" type="checkbox"  name="{{$input}}[]" value="2" id="{{$input}}2">
                        <label class="custom-control-label" for="{{$input}}2">فيسبوك</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-1">
                        <input class="custom-control-input" type="checkbox"  name="{{$input}}[]" value="3" id="{{$input}}3">
                        <label class="custom-control-label" for="{{$input}}3">تويتر</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-1">
                        <input class="custom-control-input" type="checkbox"  name="{{$input}}[]" value="4" id="{{$input}}4">
                        <label class="custom-control-label" for="{{$input}}4">انستجرام</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-1">
                        <input class="custom-control-input" type="checkbox" name="{{$input}}[]" value="5" id="{{$input}}5">
                        <label class="custom-control-label" for="{{$input}}5">جوجل</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
