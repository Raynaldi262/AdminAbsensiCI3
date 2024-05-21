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
<div class="breadcrumb" id="map"></div>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <div class="sweeatAlert" id="<?= $status; ?>"></div>
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
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cordinate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('map/store', ''); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="number" step="0.0000000000000001" value=<?php echo $gps->lat ?> class="form-control" name="lat" id="lat" placeholder="Enter Latitude" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Longitude</label>
                    <input type="number" step="0.0000000000000001" value=<?php echo $gps->long ?> class="form-control" name="long" id="long" placeholder="Enter Longtitude" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <!-- Modal -->
  
</div>

<script>
    $(document).ready(function() {

        let status = $('.sweeatAlert').attr('id');

        if (status === 'success') {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Cordinate Saved",
                showConfirmButton: false,
                timer: 1500,
            });
        } else if (status === 'error') {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Error",
                showConfirmButton: false,
                timer: 1500,
            });
        }

    });
</script>