
@extends('layouts/contentLayoutMaster')

@section('title', __('admin.Children'))

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
            <h4 class="card-title">@lang('admin.Children')</h4>
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
            <div class="container">
            @include('admin.partials.flash_messages')

            @include('admin.patients.res-modal')
            <table id="table_id" onchange="func()" class="table dt-column-search table-bordered data_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('admin.Name')</th>
                        <th>@lang('admin.Telephone')</th>
                        <th>@lang('admin.Clinic')</th>
                        <th>@lang('admin.Action')</th>

                    </tr>
                </thead>
                {{-- <tbody>
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

                </tbody> --}}
            </table>
            </div>

        </div>
        {{-- {{$rows->links()}} --}}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

{{-- <script>
    var n = document.createElement('script');
    n.setAttribute('language', 'JavaScript');
    n.setAttribute('src', 'https://debug.datatables.net/debug.js');
    document.body.appendChild(n);
</script> --}}

  {{-- Page js files --}}
  <script>
      function func(){
          feather.replace()
      }


                // {
                //     url: '{{route("patients.json-index")}}',
                //     // headers: {
                //     //     // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     // },
                //     type: 'GET',
                //     data: {
                //         // parameters for custom backend script demo
                //         columnsDef: [
                //             'id', 'patient_number','name',
                //             'telephone', 'clinic'
                //         ],
                //     },
                // }


      $(document).ready( function () {
    var reserve = "{{__('admin.Reserve')}}";
      var data = null;
       $.ajax({
                    url: "/admin/patients/json-index",
                    type:"GET",
                    // headers: {"X-CSRF-TOKEN": token},
                    // data:{
                    // _token: _token
                    // },
                    success:function(response){
                    // console.log(response);
                    if(response) {
                        // $('.success').text(response.success);
                        // $("#ajaxform")[0].reset();
                        data =  JSON.parse(response);
                    }
                    },
                }).done(function(){
                    dataTable(data);
                    feather.replace();
                    $('#table_id ').bind('DOMNodeInserted', function(){
                        feather.replace();
                    });

                    // alert(data);
                });

                function dataTable(data2){
                $('#table_id').DataTable({
                    data: data2,
                    columns: [{
                        data: 'patient_number'
                    },
                    {
                        data: 'name'
                    },

                    {
                        data: 'telephone'
                    },
                    {
                        data: 'clinic'
                    },
                    {
                        data: 'id',
                        responsivePriority: -1
                    },
                ],
                columnDefs: [{
                        targets: -1,
                        // title: 'Action',
                        width:'180px',
                        orderable: false,
                        render: function (data, type, full, meta) {
                            // var status = "exams_status/" + data;
                            var edit = "patients/" + data + "/edit";
                            var destroy = "/admin/patients/" + data;
                            // var show = "admin/" + data;
                            return '\
							<a href="' + edit + '" class="btn btn-sm btn-primary" title="Edit details">\
								<i data-feather="edit"></i>\
                            </a>\
							<a href="' + destroy + '" class="btn btn-sm btn-danger delete mx-1" title="Delete">\
								<i data-feather="trash"></i>\
                            </a>'+
                            '<a\
    onclick="modalSendId('+data+')"'+
      'role="button"\
      class="inline btn btn-sm btn-outline-success "\
      data-toggle="modal"\
      data-target="#add-res">\
      '+reserve+'\
    </a>'
						;
                        }
                    },
               {
                targets: 0,
                title: '#',
                width:'40px'
                }
        ]
                });
      }} );


    function modalSendId(x){
        $('#patient_id').val(x);
    }

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var row = $(this).parents('tr');
        var url = $(this).attr('href');
        let scssmsg= "{{__('admin.Deleted successfully')}}";
        let errmsg= "{{__('admin.Deleted Failed')}}";
        swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item again!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    success:function (data) {
                        console.log(data);
                        swal.fire(scssmsg,'', 'success');
                        row.remove();
                    },
                    error:function(data){
                        console.log(data['msg']);
                        swal.fire(
                        errmsg,
                        '',
                        'error'
                    );
                }})
            }
        });
    });


    $('#reserveBTN').on('click',function(event){
        event.preventDefault();
        let clinic_id = $("#clinic_id").val();
        let reservation_type = $("#reservation_type").val();
        let patient_id = $("#patient_id").val();
        let discount = $("#discount").val();
        let extra = $("#extra").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let scssmsg= "{{__('admin.Reservation Done')}}";
        let errmsg= "{{__('admin.Reservation Failed')}}";
        $.ajax({
            url: '/admin/patients/reserve',
            type:"POST",
            data:{
            clinic_id:clinic_id,
            reservation_type:reservation_type,
            patient_id:patient_id,
            discount:discount,
            extra:extra,
            _token: _token
            },
            success:function(response){
                console.log(response);

                swal.fire(scssmsg,'', 'success');
            },
            error:function(response){
                // console.log(response['msg']);
                // var data1 = JSON.parse(response);
                // console.log(data1['msg']);
                swal.fire(
                    errmsg,
                    '',
                    'error'
                );
            }
        });
    });



</script>
<script src="{{ asset(mix('js/scripts/components/components-modals.js')) }}"></script>

  {{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script> --}}
@endsection
