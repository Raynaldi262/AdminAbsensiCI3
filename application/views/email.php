<div class="breadcrumb" id="email"></div>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Compose</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Compose</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Compose New Message</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php echo form_open_multipart('email/sendmail', array('id' => 'sendemail1')); ?>
              <div class="form-group">
                <input type="text" id="subject1" name="subject" class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
                <textarea id="compose-textarea" name="body" class="form-control" style="height: 300px"></textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fas fa-paperclip"></i> Attachment
                  <input type="file" id="attachment1" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
              </div>
            </div>
            </form>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script>
  $('#sendemail1').submit(function(e) {
    e.preventDefault()
     $.ajax({
          type: "POST",
          data: new FormData(this),
          url: "<?php echo base_url("email/sendmail"); ?>",
          dataType: "json",
          contentType: false,
          cache: false,
          processData: false,
          success: function(result) {
              if(result.error){
                Swal.fire({
                        position: "center",
                        icon: "error",
                        title: result.error,
                        showConfirmButton: true,
                    });
              }else{
                Swal.fire({
                        position: "center",
                        icon: "success",
                        title: result.sukses,
                        showConfirmButton: true,
                    });
                    $('#subject1').val('')
                    $('#compose-textarea').val('')
                    $('#attachment1').val('')
              }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
        })
  })
</script>