
@php $input='name'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Name')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@php $input='email'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Email')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@php $input='mobile'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Telephone')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@php $input='password'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Password')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        <input type="password" name="password" class="form-control">
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@php $input='role_id[]'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Roles')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select($input, $roles, $row?$row->roles->pluck('id')->toArray():null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- {!! Form::textarea($input,null,['class'=>'form-control']) !!} --}}
