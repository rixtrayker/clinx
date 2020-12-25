
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
@php $input='description'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Description')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
