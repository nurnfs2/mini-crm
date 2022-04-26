
@extends('layouts.app')

@section('content')



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employee Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Employee Information</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">



            <div class="row">
                <a class="btn btn-bg btn-app bg-warning" onclick="showNewModal();">
                    <i class="fas fa-edit"></i> Add New Employee
                  </a>
            </div>







            <div class="modal fade" id="newModal" data-backdrop="static">
                <div class="modal-dialog">
                    <form id="new-form" enctype="multipart/form-data">
                        @csrf
                        <input id="mode" type="hidden" />
                        <input id="Id" name="Id" type="hidden" />
                        <input id="oldImage" name="oldimage" type="hidden" />

                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Employee Information</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                            <div class="col-md-12">

                                <div class="card  card-box" style="margin-top: -10px">
                                    <div class="card-head">
                                        <header>Employee Information</header>
                                    </div>
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="first_name">First Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="last_name">Last Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="First Name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="company_id">Company</label>
                                                    <div class="col-sm-8">
                                                        <select id="company_id" name="company_id" class="form-control select2" required>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="email">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="phone">Phone</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Website">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-4">Status</div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check">
                                                            <input name="status" value="1" class="form-check-input" type="checkbox" checked="checked" id="status">
                                                            <label class="form-check-label" for="gridCheck1">Status
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" id="pBtn">Save</button>
                    </div>
                  </div>
                </form>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->


        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Employee Information Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>SL</th>
                          <th>FIRST NAME</th>
                          <th>LAST NAME</th>
                          <th>COMPANY NAME</th>
                          <th>EMAIL</th>
                          <th>PHONE</th>
                          <th>STATUS</th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php
                                $Employees = \App\Http\Controllers\Admin\EmployeeController::read();
                                $sl=1;
                            ?>

                            @foreach ($Employees as $data)

                            <tr>
                                <td>{{$sl}}</td>
                                <td>{{$data->first_name}}</td>
                                <td>{{$data->last_name}}</td>
                                <td>{{$data->company_name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                                <td>
                                    @if ($data->status==1)
                                    <label class="text-success">Active</label>
                                    @else
                                    <label class="text-danger">Inactive</label>
                                    @endif

                                </td>
                                <td>
                                    <a onclick="getEditData({{$data->id}},'{{$data->first_name}}');" href="javascript:;" class="btn btn-block bg-gradient-success btn-xs" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a onclick="performDelete({{$data->id}},'{{$data->first_name}}');" href="javascript:;" class="btn btn-block bg-gradient-danger btn-xs" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>

                            @endforeach




                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>


<a class="swalDefaultSuccess"></a>
<a class="swalDefaultError"></a>

<a class="swalDefaultEditSuccess"></a>

<a class="swalDefaultDelSuccess"></a>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  @endsection



  @section('script')

  <script type="text/javascript">
    $(function () {

      //  alert(baseURL_API);

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });


        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Data Added successfully.'
            })
        });

        $('.swalDefaultError').click(function() {
            Toast.fire({
                icon: 'error',
                title: 'Something error happen.'
            })
        });

        $('.swalDefaultEditSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Data successfully Updated.'
            })
        });


        $('.swalDefaultDelSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Data successfully Deleted.'
            })
        });

      loadTableData();


    });


    function loadTableData() {
        $("#example1").DataTable({
            "responsive": true,
            // "processing": true,
            // "serverSide": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }


    function getCompanyList() {
        var GetURL = baseURL_API + "get-all-company";
        var selectID = $('#company_id');
        selectDataLoadAjax(selectID, GetURL, 'GET');
    }

    function selectDataLoadAjax(id, URLWithAPIRoute, type) {
        $.ajax({
            type: type,
            url: URLWithAPIRoute,
            dataType: "json",
            success: function(data) {
                // the next thing you want to do
                var $optiondata = id;
                $optiondata.empty();
                $optiondata.append("<option value=''>Select option</option>");
                for (var i = 0; i < data.length; i++) {
                    $optiondata.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
                }
            }
        });
    }


    function showNewModal() {
        $('#new-form')[0].reset();
        $('#pBtn').html('Save Information');
        $('.modal-title').html('Employee Information');
        $('#mode').val("Add");
        getCompanyList();

        $('#newModal').modal('show');
    }


    $('#new-form').on('submit', function(event) {

        event.preventDefault();

     //   $('.swalDefaultError').click();

        var mode = $('#mode').val();

        if (mode == "Add") {
            $.ajax({
                url: baseURL_API + "store-employee",
                method: "POST",
                contentType: false,
                cache: false,
                processData:false,
                data: new FormData(this),
                //      data: $(this).serialize(),
                    // dataType: "json",
                success: function(data) {

                    if (data.success) {
                        $('#newModal').modal('hide');

                        $('.swalDefaultSuccess').click();

                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);

                    }else{

                        $('.swalDefaultError').click();

                    }

                }
            });
        }

        if (mode == "Update") {

            $.ajax({
                url: baseURL_API + "update-employee-data",
                method: "POST",
                contentType: false,
                cache: false,
                processData:false,
                data: new FormData(this),
                //      data: $(this).serialize(),
                    // dataType: "json",
                success: function(data) {

                    if (data.success) {
                        $('#newModal').modal('hide');

                        $('.swalDefaultEditSuccess').click();

                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);

                    }else{

                        $('.swalDefaultError').click();

                    }

                }
            });
        }

    });



    function getEditData(id, name) {
        $('#mode').val("Update");
        $('.modal-title').html('Edit Employee Information');
        $('#pBtn').html('Update Information');
        $('#newModal').modal('show');
        //var id=	$('#id').val();

        $.ajax({
            url: baseURL_API + "get-employee-data",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {

                getCompanyList();

                $('#Id').val(data.result.id);
                $('#first_name').val(data.result.first_name);
                $('#last_name').val(data.result.last_name);

                window.setTimeout(function () {
                    $('#company_id').val(data.result.company_id).trigger('change');
                }, 800);

                $('#email').val(data.result.email);
                $('#phone').val(data.result.phone);


                if (data.result.status == 1) {
                    $('#status').prop('checked', true);
                } else {
                    $('#status').prop('checked', false);
                }

            }
        });

    }






    function performDelete(id,name,image) {

        let text = "Are you sure? you want to delete "+name;
        if (confirm(text) == true) {

            $.ajax({
                url: baseURL_API + "delete-employee",
                type: "POST",
                dataType: "json",
                data: {id: id, image: image},
                success: function (data) {
                    if (data.success) {
                        $('.swalDefaultDelSuccess').click();
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            });


        } else {

        }


    }



  </script>

  @endsection
