<x-header />
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <x-sidebar />

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User </h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">




            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 mb-4 text-right">
                  <button type="button" class="btn btn-success mt-2 mr-2" id="btn_addquestion"><i class="fa fa-plus"></i> Upload User Excel</button><button type="button" class="btn btn-primary mt-2 btn_action" id="btn_addrole" data-id="1"><i class="fa fa-plus"></i> Add User</button>
                  </div>
                </div>
                <table id="tbl_user" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

  </div>

  <!-- //edit product model -->
  <div class="modal fade" id="modal_add_edit_user">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_add_edit_user_title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" id="form_add_edit_user" method="post">
          <div class="modal-body">
            <input type="hidden" name="hid_userid" id="hid_userid">
            <input type="hidden" name="hid_actionid" id="hid_actionid">
            <div class="form-group">
              <label>User name </label>
              <input type="text" name="txt_username" placeholder="User name" class="form-control" id="txt_username">
            </div>
            <div class="form-group">
              <label>Email </label>
              <input type="email" name="txt_useremail" placeholder="User email" class="form-control" id="txt_useremail">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn_modal_add_edit_user"></button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- //delete user model -->
  <div class="modal fade" id="modal-delete-user">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title " id="modal-delete-user-title">Delete user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" id="form_edit_product" method="post">
          <div class="modal-body">
            <input type="hidden" name="hid_deleteid" id="hid_deleteid">
           <p id="modal-delete-user-message">Are you Sure want to delete user ?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn-delete">Delete</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

   <!-- //edit product model -->
   <div class="modal fade" id="modal-add-excelquestion">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Upload Question</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" id="form_add_question" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload excel file </label>
              <input type="file" name="file_uploadquestion" class="form-control" id="file_uploadquestion">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <x-footer />

  <script>
    $(function() {


      var table = $('#tbl_user').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
          'url': '/getuser',
          beforeSend: function() {
            $('#preloader').show();
          },
          complete: function() {
            $('#preloader').hide();
          }
        },
        "columns": [{
            "data": "name",
        },
        {
            "data": "email"
        },
        {
            visible:true,
            data:null
        }
        ],
        "createdRow": function(row, data, index) {
          $('td', row).eq(2).html('<button type="button" name="btn_edit" data-id="2" id="btn_edit" class="btn btn-warning btn_action"><i class="fa fa-edit"></i></button><button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger" data-id="' + data['id'] + '"><i class="fa fa-trash"></i></button>');
        },

      });


      $("body").on("click", ".btn_action", function() {
        if ($(this).attr("data-id") == 1) {
          $("#hid_actionid").val(1);
          $("#modal_add_edit_user_title").text("Add User")
          $("#btn_modal_add_edit_user").text("Add")
        } else {
          var data = table.row($(this).parents('tr')).data();
          $("#hid_actionid").val(2);
          $("#hid_userid").val(data['id']);
          $("#txt_username").val(data['name']);
          $("#txt_useremail").val(data['email']);
          $("#modal_add_edit_user_title").text("Edit User");
          $("#btn_modal_add_edit_user").text("Update");


        }
        $("#modal_add_edit_user").modal()
      });



      $('#modal_add_edit_user').on('hidden.bs.modal', function() {
        $("#form_add_edit_user")[0].reset();
        $("#form_add_edit_user").each(function() {
          $(".form-control").removeClass('is-invalid')
        })
      })

      //add , edit user
      $('#form_add_edit_user').validate({
        rules: {

          txt_username: {
            required: true,
          },
          txt_useremail: {
            required: true,
            email:true
          },

        },
        messages: {
          txt_username: "Please enter a user name",
          txt_useremail:{
            required:"Please enter a email name",
            email:'Please enter valid email'
          } 
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });

      $('#form_add_edit_user').submit(function(e) {
        e.preventDefault();
        if($('#form_add_edit_user').valid())
        {
          var url;
          var type=''
          var actionData = [];
          if ($("#hid_actionid").val() == 1) {
            url = "/adduser";
            type="POST";
            actionData = {
              _method:type,
              name: $("#txt_username").val(),
              email: $("#txt_useremail").val(),
              
            };
          } else {
            url = "/edituser";
            type="PUT";
            actionData = {
              _method:type,
              user_id: $("#hid_userid").val(),
              name: $("#txt_username").val(),
              email: $("#txt_useremail").val(),
            };
          }
          $.ajax({
            type: 'POST',
            url: url,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: actionData,
            beforeSend: function() {
              $("#preloader").show();
            },
            success: function(data) {
              if (data.success) {
                $("#modal_add_edit_user").modal('toggle')
                toastr.success(data.message);
                table.ajax.reload();
              } else {
                toastr.error(data.message);

              }
            },
            complete: function() {
              $("#preloader").hide();
            },
          });
      }
      });


      //add user with excel
      $('#modal-add-excelquestion').on('hidden.bs.modal', function() {
        $("#form_add_question")[0].reset();
      })
      
      
      $("#btn_addquestion").click(function() {
        $("#modal-add-excelquestion").modal();
      });
      $("#form_add_question").on("submit", function(e) {
        e.preventDefault();
        if ($("#form_add_question").valid()) {
          var fd = new FormData();
          var files = $('#file_uploadquestion')[0].files;
          fd.append("file", files[0]);
          fd.append('_token', $('meta[name="csrf-token"]').attr('content'));
          $.ajax({
            type: 'POST',
            url: '{{url("/import")}}',
            contentType: false,
            processData: false,
            // dataType: 'json',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fd,
            beforeSend: function() {
              $("#preloader").show();
            },
            success: function(data) {
              if (data.success) {
                $("#modal-add-excelquestion").modal('toggle')

                toastr.success(data.message);
              } else {
                toastr.error(data.message);

              }
            },
            complete: function() {
              $("#preloader").hide();
            },
          });
        }

      });
      $('#form_add_question').validate({
        rules: {
          file_uploadquestion: {
            required: true,
            extension: "xlsx"
          },

        },
        messages: {
          file_uploadquestion: {
            required:"Please select excel file",
            extension: "Please select only xl, xlsx, file"
          },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });


     //delete user
     $("body").on("click", "#btn_delete", function() {
        $("#hid_deleteid").val($(this).attr('data-id')); 
        $("#modal-delete-user").modal();
      });

      $("#btn-delete").click(function() {
        $.ajax({
          type: 'DELETE',
          url: '/deleteuser',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            _method: 'DELETE',
            user_id: $("#hid_deleteid").val(),
          },
          beforeSend: function() {
            $("#preloader").show();
          },
          success: function(data) {
            if (data.success) {
              $("#modal-delete-user").modal('toggle')
              toastr.success(data.message);
              table.ajax.reload();
            } else {
              toastr.error(data.message);
            }
          },
          complete: function() {
            $("#preloader").hide();
          },
        });
      })


    });
</script>