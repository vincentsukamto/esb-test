<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ESB | Invoice</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
  <div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url("index")?>" class="brand-link" style="background-color:#dark-gray;padding-left:20px;">
      ESB
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('/'); ?>" id="invoice" class="nav-link active" style="color:black">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                Invoice
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php if (session()->getFlashdata('insert_success')) : ?>
      <script>
        swal({
          position: 'top-end',
          icon: 'success',
          title: 'Insert Invoice Successful!',
          showConfirmButton: false,
          timer: 1700
        });
      </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('deleted')) : ?>
      <script>
        swal({
          position: 'top-end',
          icon: 'success',
          title: 'Invoice Deleted!',
          showConfirmButton: false,
          timer: 1700
        });
      </script>
    <?php endif; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6" style="padding-left: 20px;">
              <h1 class="m-0">Invoice</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div style="padding: 0 20px 10px 20px;">
        <a href="<?php echo base_url('invoice/create')?>" class="btn btn-success">Create New Invoice</a>
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="row" style="padding: 0 20px;">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive" style="align-content:flex-end">
              <table id="invoice_table" class="table table-striped table-bordered table-sm" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>ISSUE DATE</th>
                    <th>DUE DATE</th>
                    <th>SUBJECT</th>
                    <th>AMOUNT DUE</th>
                    <th>PAYMENT</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

  <script src="<?php echo base_url('adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>

  <script>
    $(document).ready(function() {
      $('#invoice_table').DataTable({
        "ajax": {
          "url": "<?php echo base_url('invoice/search'); ?>",
          "dataSrc": ""
        },
        "columns": [
          {
            "data": "id"
          },
          {
            "data": "issue_date"
          },
          {
            "data": "due_date"
          },
          {
            "data": "subject"
          },
          {
            "data": "amount_due",
            "className": "text-right"

          },
          {
            "data": "payments",
            "className": "text-right"
          },
          {
            "data": "status"
          },
          {
            data: null,
            name: null,
            sortable: false,
            render: function(data, type, row, meta) {
              return `
                <a href="<?php echo base_url('invoice/view') ?>/${row.id}" class="btn" title="view invoice" style="background-color:#5cc5e6; color:white;"><i class="fas fa-eye"></i></a>
                <form method='GET' action='<?php echo base_url('invoice/edit') ?>/${row.id}' style='display: unset;'>
                  <button type='submit' class='btn' style="background-color:#5cc5e6; color:white;" title="edit invoice"><i class="fas fa-edit"></i></button>
                </form>
                <form method='POST' action='<?php echo base_url('invoice/delete') ?>/${row.id}' style='display: unset;'>
                  <button type='submit' class='btn btn-danger' title="delete invoice" onclick="return confirm('Are you sure you want to delete this invoice?')"><i class="fas fa-trash"></i></button>
                </form>
              `;
            }
          },
        ]
      });
    });
  </script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>