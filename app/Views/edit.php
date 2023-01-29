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
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6" style="padding-left: 20px;">
              <h1 class="m-0">Edit Invoice #<?php echo $data_invoice['invoice']['id']?></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="row" style="padding: 0 20px;">
        <div class="col-12">
          <div class="card" style="padding:20px">
            <!-- /.card-header -->
            <form method="POST" action="<?php echo base_url('invoice/update/')."/".$data_invoice['invoice']['id']?>">
            <div class="form-group">
                <label for="issue_date">ISSUE DATE</label>
                <input class="form-control" type="date" name="issue_date" value="<?php echo $data_invoice['invoice']['issue_date']?>" id="issue_date">
            </div>
            <div class="form-group">
                <label for="due_date">DUE DATE</label>
                <input class="form-control" type="date" name="due_date" value="<?php echo $data_invoice['invoice']['due_date']?>" id="due_date">
            </div>
            <div class="form-group">
                <label for="subject">SUBJECT</label>
                <input class="form-control" type="text" name="subject" value="<?php echo $data_invoice['invoice']['subject']?>" id="subject">
            </div>
            <div class="form-group">
                <label for="subtotal">SUBTOTAL</label>
                <input class="form-control" type="number" name="subtotal" min="0" value="<?php echo $data_invoice['invoice']['subtotal']?>" id="subtotal" readonly>
            </div>
            <div class="form-group">
                <label for="tax">TAX (10%)</label>
                <input class="form-control" type="number" name="tax" min="0" value="<?php echo $data_invoice['invoice']['tax']?>" id="tax" readonly>
            </div>
            <div class="form-group">
                <label for="payment">PAYMENT</label>
                <input class="form-control" type="number" name="payment" min="0" value="<?php echo $data_invoice['invoice']['payments']?>" id="payment" oninput="countAmountDue()">
            </div>
            <div class="form-group">
                <label for="amount_due">AMOUNT DUE</label>
                <input class="form-control" type="number" name="amount_due" min="0" value="<?php echo $data_invoice['invoice']['amount_due']?>" id="amount_due" readonly>
            </div>
            <div class="form-group">
                <label for="status">STATUS</label>
                <select class="form-control" name="status" id="status">
                    <option value="UNPAID"<?php if($data_invoice['invoice']['status'] == "UNPAID"){echo "selected";}?>>Unpaid</option>
                    <option value="PAID"<?php if($data_invoice['invoice']['status'] == "PAID"){echo "selected";}?>>Paid</option>
                </select>
            </div>
            <div class="form-group" align="center">
                <label for="payment">ITEMS</label>
                <table id="invoice_item">
                  <thead>
                    <tr>
                      <td>
                        <label for="item_type0">ITEM TYPE</label>
                      </td>
                      <td>
                        <label for="description0">DESCRIPTION</label>
                      </td>
                      <td>
                        <label for="quantity0">QUANTITY</label>
                      </td>
                      <td>
                        <label for="unit_price0">UNIT PRICE</label>
                      </td>
                      <td>
                        <label for="amount0">AMOUNT</label>
                      </td>
                    </tr>
                  </thead>
                  <?php for($i=0;$i<count($data_invoice['detail_invoice']);$i++):?>
                      <tr class="rowProduct">
                        <input type="hidden" name="array_count[<?php echo $i?>]" value="<?php echo $i?>">
                        <td>
                            <input class="form-control" type="text" name="item_type<?php echo $i?>" value="<?php echo $data_invoice['detail_invoice'][$i]['item_type']?>" id="item_type<?php echo $i?>">
                        </td>
                        <td>
                            <input class="form-control" type="text" name="description<?php echo $i?>" value="<?php echo $data_invoice['detail_invoice'][$i]['description']?>" id="description<?php echo $i?>">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="quantity<?php echo $i?>" min="0" value="<?php echo $data_invoice['detail_invoice'][$i]['quantity']?>" id="quantity<?php echo $i?>" oninput="countSubtotal()">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="unit_price<?php echo $i?>" min="0" value="<?php echo $data_invoice['detail_invoice'][$i]['unit_price']?>" id="unit_price<?php echo $i?>" oninput="countSubtotal()">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="amount<?php echo $i?>" min="0" value="<?php echo $data_invoice['detail_invoice'][$i]['amount']?>" id="amount<?php echo $i?>" readonly>
                        </td>
                        <td><a type="button" onclick="deleteRow(this)" class="btn btn-block btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                      </tr> 
                  <?php endfor?>
                    <tbody id="invoice_item">
                    </tbody>
                    <tr>
                        <td colspan="6">
                            <a type="button" onclick="addRow()" class="btn btn-block btn-secondary">Add Item</a>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">SUBMIT</button>
            </div>
            </form>
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

<script>
        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            countSubtotal();
        }

        function addRow() {
            var count = $(".rowProduct").length;
            html = `<tr class="rowProduct">
                        <input type="hidden" name="array_count[${count}]" value="${count}">
                        <td>
                            <input class="form-control" type="text" name="item_type${count}" placeholder="Item Type" id="item_type${count}">
                        </td>
                        <td>
                            <input class="form-control" type="text" name="description${count}" placeholder="Description" id="description${count}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="quantity${count}" min="0" placeholder="Quantity" id="quantity${count}" oninput="countSubtotal()">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="unit_price${count}" min="0" placeholder="Unit Price" id="unit_price${count}" oninput="countSubtotal()">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="amount${count}" min="0" placeholder="Amount" id="amount${count}" readonly>
                        </td>
                        <td><a type="button" onclick="deleteRow(this)" class="btn btn-block btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>`;
            $('#invoice_item').append(html);
        }

        function countTax() {
            var subtotal = $("#subtotal").val();
            var tax = (subtotal*10/100);
            var taxValue = document.getElementById('tax');
            taxValue.value = tax;
        }

        function countAmountDue() {
            let subtotal = $("#subtotal").val();
            let tax = $("#tax").val();
            let payment = $("#payment").val();

            let amount = (payment*1) - ((subtotal*1) + (tax*1));
            var amountForm = document.getElementById('amount_due');
            amountForm.value = amount;
        }

        function countSubtotal() {
            var count = $(".rowProduct").length;
            var quantity=0;
            var quantityValue=0;
            var price = 0;
            var subtotal = 0;
            var amount = 0;
            for(var i=0;i<count;i++) {
                quantityValue =  $(`#quantity${i}`).val();
                price = $(`#unit_price${i}`).val();
                amount = quantityValue*price;
                var amountForm = document.getElementById(`amount${i}`);
                amountForm.value = amount;
                subtotal = subtotal + (quantityValue*price);
            }
            var subTotal = document.getElementById('subtotal');
            subTotal.value = subtotal;
            countTax();
            countAmountDue();
        }
    </script>

</html>