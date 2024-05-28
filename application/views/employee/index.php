<?php
echo $js;
?>

<style>
  table {
    text-align: center;
  }

  .card-block {
    margin: 10px;
  }
  div.dt-container {
        width: 800px;
        margin: 0 auto;
    }
</style>
<div class="breadcrumb" id="daftar_employee"></div>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-block">
              <form action="<?= base_url("employee/index") ?>" method="GET" style="margin-bottom: 0">
                <div class="d-flex flex-row">
                  <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label class="control-label">Name</label>
                      <input type="text" class="form-control boxed" name="cari_nama">
                    </div>
                  </div>
                  <!-- <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label for="status">Status</label>
                      <select class="custom-select form-control-border" name="cari_status">
                        <option value="" selected>Pilih..</option>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                      </select>
                    </div>
                  </div> -->
                  <div class="col-sm-12 col-md-2 ml-4">
                    <input class="btn btn-primary" style="width: 100%;margin-top: 32px; height: 38px" type="submit" name="publish" value="Cari">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employees Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Face</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $c = 1;
                  foreach ($employee as $data) : ?>
                    <tr>
                      <td><?php echo $c ?></td>
                      <td>
                      <?php
                      $avatar = $data->avatar ?
                        base_url('/upload/'. $data->avatar)
                        : base_url('/assets/dist/img/profile.jpg') 
                      ?>
                      <img src="<?= $avatar ?>" height="32" width="32">

                      </td>
                      <td><?php echo $data->name ?></td>
                      <td><?php echo $data->username ?></td>
                      <td><?php echo $data->address ?></td>
                      <td><?php echo $data->phone ?></td>
                      <td><?php echo $status = $data->isActive ? 'Active' : 'In-Active'; ?></td>
                      <td><?php echo $data->isFace  ? 'True' : 'False'; ?></td>
                      <td>
                        <button type="button" class="btn btn-primary detailEmployee" data-toggle="modal" data-target="#editModal" id="<?= $data->id ?>">Edit</button>
                        <button type="button" class="btn btn-danger deleteEmployee" id="<?= $data->id ?>" value="<?= $data->avatar ?>">Delete</button>
                      </td>
                    </tr>
                  <?php
                    $c++;
                  endforeach; ?>
                </tbody>
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
  <!-- /.content -->
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php $attributes = array('id' => 'editEmployee'); ?>
          <?php echo form_open_multipart('employee/edit', $attributes); ?>
          <input type="hidden" name="id" id="id1">
          <input type="hidden" name="avatarId" id="avatarId1">
          <div class="card-body">
            
          <div class="form-group">
                        <label for="name">Avatar</label>
                        <input type="file" class="form-control" name="avatar" id="avatar" accept="image/png, image/jpeg, image/jpg">
                      
                        <?php if (isset($error)) : ?>
                            <div class="invalid-feedback"><?= $error ?></div>
                        <?php endif; ?>

            </div>

            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name1" name="name" placeholder="Input name" required>
              <div id="validationServerUsernameFeedback" class="invalid-feedback name1">
              </div>
            </div>
            <div class="form-group">
              <label for="name">Username</label>
              <input type="text" class="form-control" id="username1" name="username" placeholder="Input username" required>
              <div id="validationServerUsernameFeedback" class="invalid-feedback username1">
              </div>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="address" class="form-control" id="address1" name="address" placeholder="Input Address" required>
              <div id="validationServerUsernameFeedback" class="invalid-feedback address1">
              </div>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone1" name="phone" placeholder="Input Phone" required>
              <div id="validationServerUsernameFeedback" class="invalid-feedback phone1">
              </div>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="custom-select form-control-border" id="status1" name="status1" required>
                <option value="1">Active</option>
                <option value="0">In-Active</option>
              </select>
            </div>
            <div class="form-group">
              <label for="face">Face</label>
              <select class="custom-select form-control-border" id="face1" name="face1" required>
                <option value="1">True</option>
                <option value="0">False</option>
              </select>
            </div>

            <input type="submit" class="btn btn-success" value="Save Changes">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {

    $("#example1").DataTable({
      "lengthChange": false,
      "searching": false,
      "ordering": true,              
      "autoWidth": false,
      "scrollX": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    $(document).on("click", ".detailEmployee", function() {
      $('#name1').removeClass('is-invalid')
      $('.name1').html('')
      $('#address1').removeClass('is-invalid')
      $('.address').html('')

      var id = $(this).attr('id');
      $.ajax({
        url: "<?= base_url("employee/show") ?>",
        type: "post",
        dataType: 'json',
        data: {
          id
        },
        success: function(data) {
          $('#id1').val(data.id);
          $('#name1').val(data.name);
          $('#username1').val(data.username);
          $('#address1').val(data.address);
          $('#phone1').val(data.phone);
          $('#status1').val(data.isActive);
          $('#avatarId1').val(data.avatar);
          $('#face1').val(data.isFace);
        }
      });
    });

    $('#editEmployee').submit(function(e) {
      e.preventDefault();
      let id = $('#id1').val();
      let name = $('#name1').val();
      let username = $('#username1').val();
      let address = $('#address1').val();
      let phone = $('#phone1').val();
      let status = $('#status1').val();
      let avatarId = $('#avatarId1').val();
      let face = $('#face1').val();

      var fd = new FormData();
      var files = $('#avatar')[0].files[0];

      fd.append('id',id);
      fd.append('avatar',files);
      fd.append('name',name);
      fd.append('username',username);
      fd.append('address',address);
      fd.append('phone',phone);
      fd.append('status',status);
      fd.append('avatarId',avatarId);
      fd.append('isFace',face);

      $.ajax({
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        url: "<?php echo base_url("employee/update"); ?>",
        dataType: "json",
        success: function(result) {
          if (result.error) {
            if (result.error.name) {
              $('#name1').addClass('is-invalid')
              $('.name1').html(result.error.name)
            } else {
              $('#name1').removeClass('is-invalid')
              $('.name1').html('')
            }
            if (result.error.email) {
              $('#address1').addClass('is-invalid')
              $('.address1').html(result.error.address)
            } else {
              $('#address1').removeClass('is-invalid')
              $('.address').html('')
            }
          } else {
            $('#name1').removeClass('is-invalid')
            $('.name1').html('')
            $('#address1').removeClass('is-invalid')
            $('.address1').html('')
            $('#editModal').modal('toggle');
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Employee Changed",
              showConfirmButton: false,
              timer: 1500,
            });

            setTimeout(function() {
              window.location.reload(1);
            }, 1500);
          }

        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      })
    })


    $(document).on("click", ".deleteEmployee", function() {
      var id = $(this).attr('id');
      var avatar = $(this).val();

      console.log(avatar);
      $.ajax({
        type: "POST",
        data: {
          id,
          avatar
        },
        url: "<?php echo base_url("employee/delete"); ?>",
        dataType: "json",
        success: function(result) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Employee deleted",
              showConfirmButton: false,
              timer: 1500,
            });

            setTimeout(function() {
              window.location.reload(1);
            }, 1500);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      })
  })
})
</script>