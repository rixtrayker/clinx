
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
            <a class=" text-lg btn-lg btn-primary btn-round waves-effect waves-float waves-light" href="{{route($module.'.create')}}"> <i data-feather='plus' class="text-3xl mr-1"></i> @lang('admin.Create')</a>
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
                        <th>@lang('admin.Guard name')</th>
                        <th>@lang('admin.Action')</th>

                    </tr>
                </thead>
                <tbody>
                        @foreach ($rows as $record)

                        <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->guard_name}}</td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true">@lang('admin.Action')</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route($module.'.edit', $record->id)}}"><i class="fa fa-edit"></i> @lang('admin.Edit')</a>
                                        <a class="dropdown-item" data-toggle="modal" href="#myModal-{{ $record->id }}"><i class="fa fa-trash"></i> @lang('admin.Delete')</a>
                                    </div>
                                        <div class="modal fade" id="myModal-{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                        <form role="form" action="{{ route($module.'.destroy',$record->id) }}" class="" method="POST">
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
    // var dt_filter_table = $('.dt-column-search');
    // if (dt_filter_table.length) {
    //     // Setup - add a text input to each footer cell
    //     $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
    //     $('.dt-column-search thead tr:eq(1) th').each(function (i) {
    //         var title = $(this).text();
    //         $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

    //         $('input', this).on('keyup change', function () {
    //             if (dt_filter.column(i).search() !== this.value) {
    //                 dt_filter.column(i).search(this.value).draw();
    //             }
    //         });
    //     });

    //     let token   = $('meta[name="csrf-token"]').attr('content');

    //     var data = $.ajax({
    //                 url: "/admin/roles/get-index",
    //                 type:"GET",
    //                 headers: {"X-CSRF-TOKEN": token},
    //                 // data:{
    //                 // _token: _token
    //                 // },
    //                 success:function(response){
    //                 console.log(response);
    //                 if(response) {
    //                     // $('.success').text(response.success);
    //                     // $("#ajaxform")[0].reset();
    //                     data = response;
    //                 }
    //                 },
    //             });

    //         var dt_filter = dt_filter_table.DataTable({
    //         // ajax: assetPath + 'data/table-datatable.json',
    //         ajax: data,
    //         columns: [
    //             { data: 'name' },
    //             { data: 'guard_name' }
    //             // { data: 'post' },
    //             // { data: 'city' },
    //             // { data: 'start_date' },
    //             // { data: 'salary' }
    //         ],
    //         dom:
    //             '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    //             orderCellsTop: true,
    //         language: {
    //             paginate: {
    //             // remove previous & next text from pagination
    //             previous: '&nbsp;',
    //             next: '&nbsp;'
    //             }
    //         }
    //     });
    // }
</script>
  {{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script> --}}
@endsection
