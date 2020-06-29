<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>assets/img/3wlogo.png">
<!--    <!--    DataTables CSS-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/responsive.bootstrap4.min.css">
<!--<!--    Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style01.css">
<!--    DateTimepicker CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

</head>
<body>
<!-- WRAPPER -->
<div id="wrapper">
<?php $this->load->view($navbar); ?>
<?php $this->load->view($sidebar); ?>
<?php $this->load->view($alert); ?>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <?php $this->load->view($content);?>
            </div>
        </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

<div class="clearfix"></div>
    <?php $this->load->view($footer); ?>
</div>
<!-- END WRAPPER -->
</body>
</html>
<!-- Javascript -->
<script src="<?php echo base_url();?>assets/vendor/jquery/jquery.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/klorofil-common.js"></script>
<!--Moment JS-->
<script src="<?php echo base_url();?>assets/scripts/moment.js"></script>
<!--<!--Custom JS-->
<script src="<?php echo base_url();?>assets/scripts/script.js"></script>
<!--<!--    FontAwesome JS-->
<script src="<?php echo base_url();?>assets/vendor/fontawesome/svg-with-js/js/fontawesome-all.js"></script>
<!--<!--    DataTables JS-->
<script src="<?php echo base_url();?>assets/scripts/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/responsive.bootstrap4.min.js"></script>
<!--Datetime picker-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/datetime_picker.js"></script>
<script>
    //DataTables JS
    $('#employee-tbl').DataTable();
    $('#employee-table').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    });
    $('#payslip-table').DataTable();

</script>
