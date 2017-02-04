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
                    <h1 class="page-header">Ubah User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <form class="form" action="../proses_update_user" method="post">
                        <?php foreach($get as $row){ ?>
                                    <input type="hidden" class="form-control" name="id_user" value="<?php echo $row->id_user; ?>" required>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $row->username; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <a href="#" onclick="return change_password('<?php echo$row->id_user;?>')">Ubah Password</a>
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select class="form-control" id="levelselector" name="level"> 
                                            <option value="admin" <?php if($row->level == 'admin'){echo "selected";}?>>Admin</option>
                                            <option value="sales" <?php if($row->level == 'sales'){echo "selected";}?>>Sales</option>
                                        </select>
                                    </div>
   
                                        <div class="form-group sales" id="sales" <?php if($row->level == 'sales'){?> style="display: block;"<?php } else { ?> style="display: none;" <?php } ?>>
                                           <!--
                                            <label>Nama Sales</label>
                                            <select name="sales" class="form-control">
                                                <?php foreach($get2 as $row2){?>
                                                    <option value="<?php echo $row2->nama;?>" <?php if($row2->nama = $row->sales){echo "selected";}?>><?php echo $row2->nama;?></option>
                                                <?php } ?>
                                            </select>     
                                            -->
                                            <div <?php if($row->level == 'admin'){?> style="display: none;" <?php } else { ?> style="display: block;" <?php } ?>>
                                                <label for="sales">Nama Sales : </label>
                                                <input type="text" class="form-control" id="sales-status" name="sales" value="<?php echo $row->sales;?>" readonly>
                                                <a href="#" id="ubah-sales">Ubah</a>
                                            </div>
                                            <div id="sales-input" <?php if($row->level == 'sales'){?> style="display: none;"<?php } else { ?> style="display: block;" <?php } ?>>
                                                <br>
                                                <label for="sales">Nama Sales : </label>
                                                <?php $sales2['#'] = 'Please Select';?>
                                                <?php echo form_dropdown('sales', $sales2, '#', 'class="form-control" id="sales2"'); ?><br />
                                            </div>              
                                        </div>                                   
                                    
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
                                                    <a href="<?php echo base_url();?>users"><button class="btn btn-warning" type="button">Cancel</button></a>   
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
            <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Ganti Password</h3>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="id" /> 
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Password Baru</label>
                                        <div class="col-md-9">
                                            <input name="password" placeholder="Password Baru" class="form-control" type="text">
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
    <script type="text/javascript">
         $(document).ready(function(){
         $('#levelselector').change(function(){ 
             $("#sales2 > option").remove(); 
                 $.ajax({
                     type: "POST",
                     url: "http://localhost/globalindo/users/get_sales",                
                     success: function(sales2) 
                     {
                     $.each(sales2,function(id_sales,sales) 
                     {
                     var opt = $('<option />'); 
                     opt.val(sales);
                     opt.text(sales);
                     $('#sales2').append(opt); 
                     });
                     }               
                 });
             });
         });
        </script>

        <script type="text/javascript">
         $(document).ready(function(){
                 $.ajax({
                     type: "POST",
                     url: "http://localhost/globalindo/users/get_sales",                
                     success: function(sales2) 
                     {
                     $.each(sales2,function(id_sales,sales) 
                     {
                     var opt = $('<option />'); 
                     opt.val(sales);
                     opt.text(sales);
                     $('#sales2').append(opt); 
                     });
                     }               
                 });
         });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#ubah-sales').click(function(){
                    $("#sales-input").show();
                    $("#sales-status").attr('disabled','disabled');
                });
            });
        </script>
        <script type="text/javascript">
            function change_password(id)
            {
               save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
             
                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('users/ajax_ubah_password/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
             
                        $('[name="id"]').val(data.id_user);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Ganti Password'); // Set title to Bootstrap modal title
             
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
                    url = "<?php echo site_url('users/ubah_password')?>";
                }
             
                // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data)
                    {
             
                        if(data.status) //if success close modal and reload ajax table
                        {
                            $('#modal_form').modal('hide');
                            reload_table();
                        }
             
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
             
             
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
             
                    }
                });
            }
        </script>

</body>
    <?php include '/../../layout/footer.php'; ?>
</html>
