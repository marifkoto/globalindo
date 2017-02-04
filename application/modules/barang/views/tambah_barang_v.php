<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GLOBALINDO PRISHA SENTOSA</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php include '/../../layout/header.php'; ?>
        <?php include '/../../layout/menu_bar.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tambah Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <form class="form" action="proses_tambah_barang" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Barang (dalam Rp)</label>
                                        <input type="text" class="form-control" name="harga" placeholder="misal : 10000" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Barang</label>
                                        <input type="text" class="form-control" name="qty" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar Barang</label>
                                        <input type="file" class="form-control" name="filefoto">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal diterima</label>
                                        <input type="text" class="form-control" name="tgl_diterima" id="datepicker" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="id_supplier">
                                            <?php foreach($get as $row){?>
                                            <option value="<?php echo $row->id_supplier;?>"><?php echo $row->nama_supplier;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <input type="hidden" class="form-control" name="id_user" id="datepicker" value="<?php echo $id_user?>" required><br>
                                    <table>
                                    <tr>
                                        <td>
                                            <div class="form-group" style="margin-right:20px;">
                                                <div class="input-group-btn">
                                                    <input type="submit" value="Submit" class="btn btn-primary">   
                                                </div>
                                            </div>        
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group-btn">
                                                    <a href="<?php echo base_url();?>barang"><button class="btn btn-warning" type="button">Cancel</button></a>   
                                                </div>
                                            </div>        
                                        </td>
                                    </tr>
                                    </table>
                                    
                                       
                                </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    <script type="text/javascript">
        $(function() {    // Makes sure the code contained doesn't run until
                  //     all the DOM elements have loaded

            $('#levelselector').change(function(){
                $('.sales').hide();
                $('#' + $(this).val()).show();
            });

        });
    </script>
    <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>

</body>
    <?php include '/../../layout/footer.php'; ?>
</html>
