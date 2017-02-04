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
                    <h1 class="page-header">Ubah Barang</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <form class="form" action="../proses_update_barang" method="post">
                        <?php foreach ($get as $row){?>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" value="<?php echo $row->nama;?>" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Barang (dalam Rp)</label>
                                        <input type="text" class="form-control" name="harga" placeholder="misal : 10000" value="<?php echo $row->harga;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Barang</label>
                                        <input type="text" class="form-control" name="qty" value="<?php echo $row->harga;?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar Barang</label><br>
                                        <a href="<?=base_url()?>assets/image/gambar_barang/original/<?=$row->gambar;?>" target="blank"><img style="width: 100px;height: 79px;" src="<?=base_url()?>assets/image/gambar_barang/resized/<?=$row->gambar;?>"></a>
                                        <a href="#" onclick="return change_picture('<?php echo $row->id_barang;?>')">Ubah Gambar</a>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal diterima</label>
                                        <input type="text" class="form-control" name="tgl_diterima" id="datepicker" value="<?php echo $row->tgl_diterima;?>"" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="id_supplier">
                                            <?php foreach($get2 as $row2){?>
                                            <option value="<?php echo $row->id_supplier;?>"><?php echo $row2->nama_supplier;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <input type="hidden" class="form-control" name="id_barang" value="<?php echo $row->id_barang?>" required><br>
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
                                    <?php } ?>
                                </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Ganti Gambar</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" enctype="multipart/form-data" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="id" /> 
                                <input type="hidden" value="" name="nama" />
                                <input type="hidden" value="" name="gambar" /> 
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Gambar Baru</label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="filefoto" />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->

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
    <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
  <script type="text/javascript">
            function change_picture(id)
            {
               save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
             
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('barang/ajax_ubah_barang/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
             
                        $('[name="id"]').val(data.id_barang);
                        $('[name="nama"]').val(data.nama);
                        $('[name="gambar"]').val(data.gambar);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Ganti Gambar'); // Set title to Bootstrap modal title
             
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;
             
                if(save_method == 'update') {
                    url = "<?php echo site_url('barang/ubah_gambar')?>";
                }
                var formData = new FormData();
                formData.append('filefoto', $('input[type=file]')[0].files[0]);
                //var form = $('form').get(0); 
                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: new FormData(form),
                     contentType: false,  
                     cache: false,  
                     processData:false,
                     
                    //data: $('#form').serialize(),

                    dataType: "JSON",
                    success: function(data)
                    {
             
                        if(data.status) //if success close modal and reload ajax table
                        {
                            $('#modal_form').modal('hide');
                            //reload_table();
                            window.location.reload();
                        }
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable
                         
                    }
                    
                    //error: function(xhr, status, error) {
                       // alert(xhr.responseText);
                      //  $('#btnSave').text('save'); //change button text
                       // $('#btnSave').attr('disabled',false); //set button enable 
                   // }
                });
            }
        </script>

</body>
    <?php include '/../../layout/footer.php'; ?>
</html>
