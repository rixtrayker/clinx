

{!! Form::hidden('patient_number', $patient_number ?? $row->patient_number, null) !!}

<section>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{trans('admin.Child info')}}</h4>
    </div>
    <div class="card-body">
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
