@if (Session::has('flash_notification.message'))
<div class="alert alert-{{ Session::get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! str_replace(" id"," ",Session::get('flash_notification.message')) !!}
</div>
@endif
@section('javascripts')
<script>
    $('#flash-overlay-modal').modal();
</script>
@stop