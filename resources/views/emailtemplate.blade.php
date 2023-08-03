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
            <h1 class="m-0">Email template</h1>
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
                <h3 class="card-title">Email template list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 mb-4 text-right">
                  <button type="button" class="btn btn-primary mt-2 btn_action" id="btn_addrole" data-id="1"><i class="fa fa-plus"></i> Add Email Template</button>
                  </div>
                </div>
                <table id="tbl_emailtemplate" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Content</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th>Subject</th>
                      <th>Content</th>
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
  <div class="modal fade" id="modal_add_edit_email_template">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal_add_edit_email_template_title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" id="form_add_edit_email_template" method="post">
          <div class="modal-body">
            <input type="hidden" name="hid_templateid" id="hid_templateid">
            <input type="hidden" name="hid_actionid" id="hid_actionid">
            <div class="form-group">
              <label>Subject </label>
              <input type="text" name="txt_subject" placeholder="Subject" class="form-control" id="txt_subject">
            </div>
            <div class="form-group">
              <label>Content </label>
              <textarea  name="text_content" cols="1" rows="5" placeholder="Content" class="form-control" id="text_content">
              </textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn_modal_add_edit_email_template"></button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- //delete user model -->
  <div class="modal fade" id="modal-delete-email-template">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title " id="modal-delete-email-template-title">Delete email template</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="#" id="form_edit_product" method="post">
          <div class="modal-body">
            <input type="hidden" name="hid_deleteid" id="hid_deleteid">
           <p id="modal-delete-email-template-message">Are you Sure want to delete email template ?</p>
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


      var table = $('#tbl_emailtemplate').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
          'url': '/getemailtemplate',
          beforeSend: function() {
            $('#preloader').show();
          },
          complete: function() {
            $('#preloader').hide();
          }
        },
        "columns": [{
            "data": "subject",
        },
        {
            "data": "content"
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
          $("#modal_add_edit_email_template_title").text("Add email template")
          $("#btn_modal_add_edit_email_template").text("Add")
        } else {
          var data = table.row($(this).parents('tr')).data();
          $("#hid_actionid").val(2);
          $("#hid_templateid").val(data['id']);
          $("#txt_subject").val(data['subject']);
          $("#text_content").val(data['content']);
          $("#modal_add_edit_email_template_title").text("Edit email template");
          $("#btn_modal_add_edit_email_template").text("Update");


        }
        $("#modal_add_edit_email_template").modal()
      });



      $('#modal_add_edit_email_template').on('hidden.bs.modal', function() {
        $("#form_add_edit_email_template")[0].reset();
        $("#form_add_edit_email_template").each(function() {
          $(".form-control").removeClass('is-invalid')
        })
      })

      //add , edit user
      $('#form_add_edit_email_template').validate({
        rules: {

          txt_subject: {
            required: true,
          },
          text_content: {
            required: true,
          },

        },
        messages: {
          txt_subject: "Please enter a subject",
          text_content: {
            required: "Please enter a content",
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

      $('#form_add_edit_email_template').submit(function(e) {
        e.preventDefault();
        if($('#form_add_edit_email_template').valid())
        {
          var url;
          var type=''
          var actionData = [];
          if ($("#hid_actionid").val() == 1) {
            url = "/addemailtemplate";
            type="POST";
            actionData = {
              _method:type,
              subject: $("#txt_subject").val(),
              content: $("#text_content").val(),
              
            };
          } else {
            url = "/editemailtemplate";
            type="PUT";
            actionData = {
              _method:type,
              template_id: $("#hid_templateid").val(),
              subject: $("#txt_subject").val(),
              content: $("#text_content").val(),
              
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
                $("#modal_add_edit_email_template").modal('toggle')
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


     
     //delete user
     $("body").on("click", "#btn_delete", function() {
        $("#hid_deleteid").val($(this).attr('data-id')); 
        $("#modal-delete-email-template").modal();
      });

      $("#btn-delete").click(function() {
        $.ajax({
          type: 'DELETE',
          url: '/deleteemailtemplate',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            _method: 'DELETE',
            template_id: $("#hid_deleteid").val(),
          },
          beforeSend: function() {
            $("#preloader").show();
          },
          success: function(data) {
            if (data.success) {
              $("#modal-delete-email-template").modal('toggle')
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