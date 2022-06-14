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
</style>
<div class="breadcrumb" id="daftar_pic"></div>
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
              <form action="<?= base_url("pic/index") ?>" method="GET" style="margin-bottom: 0">
                <div class="d-flex flex-row">
                  <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label class="control-label">Nama</label>
                      <input type="text" class="form-control boxed" name="cari_nama">
                    </div>
                  </div>
                  <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label for="cari_bank">Kode Bank</label>
                      <select class="custom-select form-control-border selectAbbr2" id="cari_bank" name="cari_bank">
                      </select>
                    </div>
                  </div>
                  <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label for="status">Status</label>
                      <select class="custom-select form-control-border" name="cari_status">
                        <option value="" selected>Pilih..</option>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-2 ml-4">
                    <input class="btn btn-primary" style="width: 100%;margin-top: 32px; height: 38px" type="submit" name="publish" value="Cari">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kode Bank</th>
                    <th>Status</th>
                    <th>Tanggal pembuatan</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $c = 1;
                  foreach ($pics as $pic) : ?>
                    <tr>
                      <td><?php echo $c ?></td>
                      <td><?php echo $pic->name ?></td>
                      <td><?php echo $pic->email ?></td>
                      <td><?php echo $pic->bank_code ?></td>
                      <td><?php echo $status = $pic->flag ? 'Active' : 'In-Active'; ?></td>
                      <td><?php echo  date("d-M-Y", strtotime($pic->created_at)); ?></td>
                      <td><button type="button" class="btn btn-primary detailPic" data-toggle="modal" data-target="#editModal" id="<?= $pic->id ?>">Ubah</button></td>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data PIC</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php $attributes = array('id' => 'editPIC'); ?>

          <?php echo form_open('pic/store', $attributes); ?>
          <input type="hidden" name="id" id="id1">
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name1" name="name" placeholder="Masukkan nama">
              <div id="validationServerUsernameFeedback" class="invalid-feedback name1">
              </div>
            </div>
            <div class="form-group">
              <label for="email">Alamat Email</label>
              <input type="email" class="form-control" id="email1" name="email" placeholder="Masukkan email">
              <div id="validationServerUsernameFeedback" class="invalid-feedback email1">
              </div>
            </div>
            <div class="form-group">
              <label for="abbr">Kode Bank</label>
              <select class="custom-select form-control-border selectAbbr" id="abbr1" name="abbr">
                <?php foreach ($banks as $bank) : ?>
                  <option value="<?= $bank->initial ?>"><?= $bank->initial ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="custom-select form-control-border" id="status1" name="status1">
                <option value="1">Active</option>
                <option value="0">In-Active</option>
              </select>
            </div>
            <input type="submit" class="btn btn-success" value="Simpan">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {

    callAjaxUser($('.selectAbbr2'), '<?= base_url('pic/get_bankcode') ?>', 0);


    $('.selectAbbr2').change(function() {
      callAjaxUser($('.selectAbbr2'), '<?= base_url('pic/get_bankcode') ?>', 0);
    })

    // $('.selectAbbr2').select2({
    //   placeholder: "Silahkan Pilih",
    //   width: '100%'
    // });

    $('.selectAbbr').select2({
      dropdownParent: $('#editModal'),
      placeholder: "Pilih..",
      width: '100%'
    });

    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": false,
      "ordering": true,
      "paging": true,
      "info": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $(document).on("click", ".detailPic", function() {
      $('#name1').removeClass('is-invalid')
      $('.name1').html('')
      $('#email1').removeClass('is-invalid')
      $('.eamil1').html('')

      var id = $(this).attr('id');
      $.ajax({
        url: "<?= base_url("pic/show") ?>",
        type: "post",
        dataType: 'json',
        data: {
          id
        },
        success: function(data) {
          $('#id1').val(data.id);
          $('#name1').val(data.name);
          $('#email1').val(data.email);
          $('#abbr1').val(data.bank_code);
          $('#status1').val(data.flag);
          $('#abbr1').select2({
            dropdownParent: $('#editModal'),
            placeholder: "Pilih..",
            width: '100%'
          }).trigger('change');
          $('#status').val(data.flag);
        }
      });
    });

    $('#editPIC').submit(function(e) {
      e.preventDefault();
      let id = $('#id1').val();
      let name = $('#name1').val();
      let email = $('#email1').val();
      let abbr = $('#abbr1').val();
      let status = $('#status1').val();

      $.ajax({
        type: "POST",
        data: {
          id,
          name,
          email,
          abbr,
          status
        },
        url: "<?php echo base_url("pic/update"); ?>",
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
              $('#email1').addClass('is-invalid')
              $('.email1').html(result.error.email)
            } else {
              $('#email1').removeClass('is-invalid')
              $('.email1').html('')
            }
          } else {
            $('#name1').removeClass('is-invalid')
            $('.name1').html('')
            $('#email1').removeClass('is-invalid')
            $('.email1').html('')
            $('#editModal').modal('toggle');
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Data PIC berhasil diubah",
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
  })
</script>