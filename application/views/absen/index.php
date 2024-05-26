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
<div class="breadcrumb" id="absen"></div>
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
              <form action="<?= base_url("absen/index") ?>" method="GET" style="margin-bottom: 0">
                <div class="d-flex flex-row">
                  <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label class="control-label">Name</label>
                      <input type="text" class="form-control boxed" name="name">
                    </div>
                  </div>
                  <div style="margin-right: 20px; width: 100%">
                    <div class="form-group" style='margin-bottom: 0'>
                      <label class="control-label">Date</label>
                      <input type="date" class="form-control boxed" name="date">
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
              <h3 class="card-title">Absen Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Loc In</th>
                    <th>In Time</th>
                    <th>Loc Out</th>
                    <th>Out Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $c = 1;
                  foreach ($absen as $data) : ?>
                    <tr>
                      <td><?php echo $c ?></td>
                      <td><?php echo $data->name ?></td>
                      <td><?php echo date("d-M-Y", strtotime($data->date))?></td>
                      <td><?php echo $data->locIn ?></td>
                      <td><?php echo $data->inTime ?></td>
                      <td><?php echo $data->locOut ?></td>
                      <td><?php echo $data->outTime ?></td> 
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
</div>
<script>
  $(document).ready(function() {

    $(function() {
            $("#example1").DataTable({
              "lengthChange": false,
              "searching": false,  
              "autoWidth": false,
              "ordering": true,
              "scrollX": true,
                "buttons": [{
                        extend: "csv",
                        messageTop: "Absensi",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        }
                    }, 
                    {
                        extend: "pdf",
                        messageTop: "Absensi",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        }
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
})
</script>