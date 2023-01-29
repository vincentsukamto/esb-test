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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="row" style="padding: 20px 20px;">
        <div class="col-12">
            <div class="card">
                <div class="col-sm-6" style="padding:20px;">
                    <h1 class="m-0" style="font-weight: bolder;">INVOICE</h1>
                </div>
                <div style="position: absolute; left: 500px; top: 100px;">
                    <?php if($data_invoice['invoice']['status'] == "PAID"):?>
                        <img src="\assets/paid.jpg" alt="" width="20%">
                    <?php else:?>
                        <img src="\assets/unpaid.jpg" alt="" width="20%">
                    <?php endif?>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive" style="align-content:flex-end;">
                    <div style="padding-bottom: 20px;">
                        <table class="table-sm">
                            <tr>
                                <td class="border-right">Invoice ID</td>
                                <td><?php echo $data_invoice['invoice']['id']?></td>
                            </tr>
                            <tr>
                                <td class="border-right">Issue Date</td>
                                <td><?php echo date("d/m/Y", strtotime($data_invoice['invoice']['issue_date']))?></td>
                            </tr>
                            <tr>
                                <td class="border-right">Due Date</td>
                                <td><?php echo date("d/m/Y", strtotime($data_invoice['invoice']['due_date']))?></td>
                            </tr>
                            <tr>
                                <td class="border-right">Subject</td>
                                <td><?php echo $data_invoice['invoice']['subject']?></td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table id="invoice_table" class="table table-striped table-bordered table-sm" style="width:100%;">
                            <thead>
                            <tr>
                                <th>Item Type</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<count($data_invoice['detail_invoice']);$i++):?>
                                    <tr>
                                        <td><?php echo $data_invoice['detail_invoice'][$i]['item_type']?></td>
                                        <td><?php echo $data_invoice['detail_invoice'][$i]['description']?></td>
                                        <td><?php echo $data_invoice['detail_invoice'][$i]['quantity']?></td>
                                        <td><?php echo $data_invoice['detail_invoice'][$i]['unit_price']?></td>
                                        <td><?php echo $data_invoice['detail_invoice'][$i]['amount']?></td>
                                    </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <table class="table-sm">
                            <tr>
                                <td>Subtotal</td>
                                <td><?php echo $data_invoice['invoice']['subtotal']?></td>
                            </tr>
                            <tr>
                                <td>Tax (10%)</td>
                                <td><?php echo $data_invoice['invoice']['tax']?></td>
                            </tr>
                            <tr>
                                <td>Payments</td>
                                <td><?php echo $data_invoice['invoice']['payments']?></td>
                            </tr>
                            <tr>
                                <td><h4 style="font-weight: bold;">Amount Due</h4></td>
                                <td><?php echo $data_invoice['invoice']['amount_due']?></td>
                            </tr>
                        </table>
                    </div>            
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
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
</body>

</html>