
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
{{-- @php $input='guard_name'; @endphp
<div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,trans('admin.Permissions')."<em class='red'>*</em>",['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select($input, , $row->permissions->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div> --}}
