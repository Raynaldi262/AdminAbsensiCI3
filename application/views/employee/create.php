<style>
    .error {
        color: red;
    }
</style>
<?php
echo $js;
?>
<div class="breadcrumb" id="tambah_employee"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Employee</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form New Employee</h3>
                </div>
                <div class="sweeatAlert" id="<?= $status; ?>"></div>
                <?php $hidden = array('created_at' => date('Y-m-d H:i:s'), 'modified_at' => date('Y-m-d H:i:s'), 'flag' => 1); ?>
                <?php echo form_open('employee/store', '', $hidden); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control <?= (form_error('name')) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= set_value('name');  ?>" placeholder="Input name">
                        <?php echo form_error('name'); ?>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="address" class="form-control <?= (form_error('address')) ? 'is-invalid' : '' ?>" id="address" name="address" value="<?= set_value('address');  ?>" placeholder="Input address">
                        <?php echo form_error('address'); ?>
                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        <input type="phone" class="form-control <?= (form_error('phone')) ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= set_value('phone');  ?>" placeholder="Input phone">
                        <?php echo form_error('phone'); ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    $(document).ready(function() {

        let status = $('.sweeatAlert').attr('id');

        if (status === 'success') {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Employee Created",
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