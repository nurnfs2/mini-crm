
@extends('layouts.app')

@section('content')



<style>


input[type="file"] {
        display: none;
}
.custom-file-upload {
    border: 1px solid #0288d1;
    display: inline-block;
    padding: 5px 34px;
    cursor: pointer;
    background: #0288d1;
    color: #fff;
}
.custom-file-upload:hover{
    background: #000066;
    color: #fff;
}

.logo{
    height: 100px;
    width: 100px;
}

</style>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Company Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Company Information</li>
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
                    <i class="fas fa-edit"></i> Add New Company
                  </a>
            </div>







            <div class="modal fade" id="newModal" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <form id="new-form" enctype="multipart/form-data">
                        @csrf
                        <input id="mode" type="hidden" />
                        <input id="Id" name="Id" type="hidden" />
                        <input id="oldImage" name="oldimage" type="hidden" />

                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Company Information</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                            <div class="col-md-7">

                                <div class="card  card-box" style="margin-top: -10px">
                                    <div class="card-head">
                                        <header>Company Information</header>
                                    </div>
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="name">Company Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Company Name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="email">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="website">Website</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>


                            <div class="col-md-5">

                                <div class="card  card-box" style="margin-top: -10px">
                                    <div class="card-head">
                                        <header>Company Logo</header>
                                    </div>
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label" for="image">Logo</label>
                                                    <div class="form-group" style="height: 200px;">
                                                        <div style="position: absolute; height: 200px; width: 200px; z-index:11111;">
                                                            <img id="uploadPreview" style="width: 150px; height: 150px;" src="{{asset('theme/no_img.jpg')}}" />
                                                            <label for="uploadImage" class="custom-file-upload" style="color:#fff">
                                                                Select Logo
                                                            </label>
                                                            <input id="uploadImage" type="file" name="file" accept="image/*" onchange="PreviewImage();" />
                                                            <script type="text/javascript">
                                                                function PreviewImage() {
                                                                    var oFReader = new FileReader();
                                                                    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                                                                    oFReader.onload = function (oFREvent) {
                                                                        document.getElementById("uploadPreview").src = oFREvent.target.result;
                                                                    };
                                                                };
                                                            </script>
                                                        </div>
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
                      <h3 class="card-title">Company Information Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>SL</th>
                          <th>LOGO</th>
                          <th>COMPANY NAME</th>
                          <th>EMAIL</th>
                          <th>WEBSITE</th>
                          <th>STATUS</th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php
                                $Companies = \App\Http\Controllers\Admin\CompanyController::read();
                                $sl=1;
                            ?>

                            @foreach ($Companies as $data)

                            <tr>
                                <td>{{$sl}}</td>
                                <td>
                                    <img src="images/companies/{{$data->logo}}" alt="user-avatar" class="logo img-fluid">
                                </td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->website}}</td>
                                <td>
                                    @if ($data->status==1)
                                    <label class="text-success">Active</label>
                                    @else
                                    <label class="text-danger">Inactive</label>
                                    @endif

                                </td>
                                <td>
                                    <a onclick="getEditData({{$data->id}},'{{$data->name}}');" href="javascript:;" class="btn btn-block bg-gradient-success btn-xs" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a onclick="performDelete({{$data->id}},'{{$data->name}}','{{$data->logo}}');" href="javascript:;" class="btn btn-block bg-gradient-danger btn-xs" title="Delete">
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


    function showNewModal() {
        $('#new-form')[0].reset();
        $('#pBtn').html('Save Information');
        $('.modal-title').html('Company Information');
        $('#mode').val("Add");
        var url = baseURL_web+'theme/no_img.jpg';
        document.getElementById("uploadPreview").src = url;

        $('#newModal').modal('show');
    }


    $('#new-form').on('submit', function(event) {

        event.preventDefault();

     //   $('.swalDefaultError').click();

        var mode = $('#mode').val();

        if (mode == "Add") {
            $.ajax({
                url: baseURL_API + "store-company",
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
                        console.log(data.error);

                    }

                }
            });
        }

        if (mode == "Update") {

            $.ajax({
                url: baseURL_API + "update-comapany-data",
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
        $('.modal-title').html('Edit Company Information');
        $('#pBtn').html('Update Information');
        $('#newModal').modal('show');
        //var id=	$('#id').val();

        $.ajax({
            url: baseURL_API + "get-company-data",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data) {

                $('#Id').val(data.result.id);
                $('#oldImage').val(data.result.image);
                $('#name').val(data.result.name);
                $('#email').val(data.result.email);

                $('#website').val(data.result.website);

                var url = baseURL_web+'images/companies/'+data.result.logo;
                document.getElementById("uploadPreview").src = url;

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
                url: baseURL_API + "delete-company",
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
