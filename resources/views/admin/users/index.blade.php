
@extends('layouts/contentLayoutMaster')

@section('title', __('admin.Roles'))

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')
<!-- Column Search -->
<section id="column-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header border-bottom">
            <h4 class="card-title">@lang('admin.Roles')</h4>
            <a class=" text-lg btn-lg btn-primary btn-round waves-effect waves-float waves-light" href="{{route('users.create')}}"> <i data-feather='plus' class="text-3xl mr-1"></i> @lang('admin.Create')</a>
          </div>
          <div class="card-datatable px-3">
            {{-- <table class="dt-column-search table table-responsive">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Guard name</th>
                  <th>Action</th>
                </tr>
              </thead>

            </table> --}}

            <table id="table_id" class="table dt-column-search table-bordered data_table">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>@lang('admin.Name')</th>
                        <th>@lang('admin.Email')</th>
                        <th>@lang('admin.Telephone')</th>
                        <th>@lang('admin.Action')</th>

                    </tr>
                </thead>
                <tbody>
                        @foreach ($rows as $record)

                        <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$record->mobile}}</td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true">@lang('admin.Action')</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('users.edit', $record->id)}}"><i class="fa fa-edit"></i> @lang('admin.Edit')</a>
                                        <a class="dropdown-item" data-toggle="modal" href="#myModal-{{ $record->id }}"><i class="fa fa-trash"></i> @lang('admin.Delete')</a>
                                    </div>
                                        <div class="modal fade" id="myModal-{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                        <form role="form" action="{{ route('users.destroy',$record->id) }}" class="" method="POST">
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{ csrf_field() }}
                                        <p>are you sure</p>
                                        <button type="submit" class="btn btn-danger" name='delete_modal'><i class="fa fa-trash" aria-hidden="true"></i> delete</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </form>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Column Search -->
@endsection


@section('vendor-script')
{{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>

$(document).ready( function () {
        $('#table_id').DataTable();
    } );

</script>
@endsection
