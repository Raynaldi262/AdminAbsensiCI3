<style>
    .error {
        color: red;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add PIC</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div>
                <?php $hidden = array('created_at' => time(), 'modified_at' => time(), 'flag' => 1); ?>
                <?php echo form_open('pic/store', '', $hidden); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control <?= (form_error('name')) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= set_value('name');  ?>" placeholder="Masukkan nama">
                        <?php echo form_error('name'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email');  ?>" placeholder="Masukkan email">
                        <?php echo form_error('email'); ?>
                    </div>
                    <h4>Kode Bank</h4>
                    <div class="form-group">
                        <select class="custom-select form-control-border" id="abbr" name="abbr" value="<?= set_value('abbr');  ?>">
                            <?php foreach ($banks as $bank) : ?>
                                <option value="<?= $bank->initial ?>"><?= $bank->initial ?></option>
                            <?php endforeach; ?>
                            <?php echo form_error('abbr'); ?>
                        </select>
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
        Swal.fire({
            icon: 'success',
            title: 'Signed in successfully'
        })
    });
</script>