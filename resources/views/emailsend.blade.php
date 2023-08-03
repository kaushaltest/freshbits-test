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
            <h1 class="m-0">Email send</h1>
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
                <h3 class="card-title">Email send list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form id="form_send_email">
                    <div class="row">
                        <div class="col-md-4"> 
                              <div class="form-group">
                                <label for="drp_emailtemplate">Select email template</label>
                                <select class="form-control" name="drp_emailtemplate" id="drp_emailtemplate">
                                  
                                </select>
                              </div>
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label for="drp_users">Select Users</label>
                            <select class="select2 w-100" name="drp_users" id="drp_users" multiple="multiple" data-placeholder="Select a State" >
                            
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 mt-2"> 
                            <button class="btn btn-primary mt-4">Send email</button>
                        </div>
                    </div>
                </form>
             
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
<x-footer/>
  

  <script>
    $(function() {

      $('.select2').select2();

      getEmailTemplate();
      function getEmailTemplate()
      {
        $.ajax({
          type: 'GET',
          url: '/getemailtemplate',
          beforeSend: function() {
            $("#preloader").show();
          },
          success: function(data) {
            if (data.success) {
              let emailtemplateList='<option value="">Select email template</option>';
              for (let index = 0; index < data.data.length; index++) {
                emailtemplateList+='<option value="'+data.data[index].id+'">'+data.data[index].subject+'</option>'
              }
              $("#drp_emailtemplate").html(emailtemplateList); 
            } else {
              toastr.error(data.message);
            }
          },
          complete: function() {
            $("#preloader").hide();
          },
        });
      }
      getUser();
      function getUser()
      {
        $.ajax({
          type: 'GET',
          url: '/getuser',
          beforeSend: function() {
            $("#preloader").show();
          },
          success: function(data) {
            if (data.success) {
              let userList='';
              for (let index = 0; index < data.data.length; index++) {
                userList+='<option value="'+data.data[index].id+'">'+data.data[index].name+'</option>'
              }
              $("#drp_users").html(userList);
            } else {
              toastr.error(data.message);
            }
          },
          complete: function() {
            $("#preloader").hide();
          },
        });
      }

       //send email
       $('#form_send_email').validate({
        rules: {

          drp_emailtemplate: {
            required: true,
          },
          drp_users: {
            required: true,
          },

        },
        messages: {
          drp_emailtemplate: "Please select email template",
          drp_users: "Please select user",
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

      $('#form_send_email').submit(function(e) {
        e.preventDefault();
        if($('#form_send_email').valid())
        {
          
      
          $.ajax({
            type: 'POST',
            url: '/sendemail',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              emailtemplate_id:$("#drp_emailtemplate").val(),
              users:$("#drp_users").val()
            },
            beforeSend: function() {
              $("#preloader").show();
            },
            success: function(data) {
              if (data.success) {
                $("#form_send_email")[0].reset();
                $("#drp_users").val('').trigger('change');
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

    });
</script>