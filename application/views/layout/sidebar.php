<style>
  .breadcrumb {
    margin-top: -2%;
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

  .pagination {
    float: right !important;
  }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url() ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url() ?>/assets/dist/img/steven2.jpg" style="width: 100px;" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Steven Surya</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="<?= base_url() . "dashboard/index"; ?>" class="nav-link" id="dashboard">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- <li class="nav-item menu-open">
          <a href="#" class="nav-link" id="pic">
            <i class="nav-icon fas fa fa-user-plus"></i>
            <p>
              PIC
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item" id="pic">
              <a href="<?php echo base_url() ?>pic/index" class="nav-link" id="daftar_pic">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar PIC</p>
              </a>
            </li>
            <li class="nav-item" id="pic">
              <a href="<?php echo base_url() ?>pic/insert" class="nav-link" id="tambah_pic">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambahkan PIC</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item menu-open">
          <a href="<?= base_url("email/index"); ?>" class="nav-link" id="email">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Email
            </p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  $(document).ready(function() {
    let active = $('.breadcrumb').attr('id');

    $(".nav-link").removeClass("active");
    let a = $(".nav-link#" + active).addClass('active');

    let x = $(a).parent().attr('id');
    $('#' + x).addClass('active');
  });
</script>