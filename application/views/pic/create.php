<style>
    .error {
        color: red;
    }
    .select2-selection {
        -webkit-box-shadow: 0;
        box-shadow: 0;
        background-color: #fff;
        border: 0;
        border-radius: 0;
        color: #555555;
        font-size: 14px;
        outline: 0;
        min-height: 40px;
        text-align: left;
    }
    
    .select2-selection__rendered {
        margin: 10px;
        margin-left: -10px;
    }

    .select2-selection__arrow {
        margin: 10px;
    }
    
</style>
<div class="breadcrumb" id="tambah_pic"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah PIC</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Pendaftaran PIC baru</h3>
                </div>
                <div class="sweeatAlert" id="<?= $status; ?>"></div>
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
                    <div class="form-group">
                        <label for="abbr">Kode Bank</label>
                        <select class="custom-select form-control-border selectAbbr" id="abbr" name="abbr" value="<?= set_value('abbr');  ?>">
                            <?php foreach ($banks as $bank) : ?>
                                <option value="<?= $bank->initial ?>"><?= $bank->initial ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('abbr'); ?>
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
        $('.selectAbbr').select2({
            placeholder: "Silahkan Pilih",
            width: '100%'
        });
        
        let status = $('.sweeatAlert').attr('id'); 

        if(status === 'success'){
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Data PIC berhasil ditambahkan",
                showConfirmButton: false,
                timer: 1500,
            });
        }else if(status === 'error'){
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Data PIC gagal ditambahkan",
                showConfirmButton: false,
                timer: 1500,
            });
        }
        
    });
</script>