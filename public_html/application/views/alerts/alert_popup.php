<!--Department-->
<?php if ($this->session->flashdata('added_dep_des')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('added_dep_des');?>
    </div>
<?php }elseif ($this->session->flashdata('error_des')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('error_des');?>
    </div>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('added_dep');?>
    </div>
<?php }elseif ($this->session->flashdata('error_dep')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('error_dep');?>
    </div>
<?php }elseif ($this->session->flashdata('updated_dep')){?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('updated_dep');?>
    </div>
<?php }elseif ($this->session->flashdata('dep_updated_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('dep_updated_failed');?>
    </div>
<?php }elseif ($this->session->flashdata('delete_dep')){?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('delete_dep');?>
    </div>
<?php }elseif ($this->session->flashdata('delete_dep_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('delete_dep_failed');?>
    </div>
<?php }elseif ($this->session->flashdata('update_des')){?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('update_des');?>
    </div>
<?php }elseif ($this->session->flashdata('update_des_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('update_des_failed');?>
    </div>
<?php }elseif ($this->session->flashdata('delete_des')){?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('delete_des');?>
    </div>
<?php }elseif ($this->session->flashdata('delete_des_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('delete_des_failed');?>
    </div>
<?php }?>

<!--Add Employee-->
<?php if ($this->session->flashdata('added')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('added');?>
    </div>
<?php }elseif ($this->session->flashdata('failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('failed');?>!
    </div>
<?php }?>

<!--Employee List-->

<?php if ($this->session->flashdata('set')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('set');?>
    </div>
<?php }elseif ($this->session->flashdata('failed_set')){ ?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('failed_set');?>
    </div>
<?php }?>
<?php if ($this->session->flashdata('updated')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('updated');?>
    </div>
<?php }elseif ($this->session->flashdata('failed_update')){ ?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('failed_update');?>
    </div>
<?php }?>
<?php if ($this->session->flashdata('set_leaves')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('set_leaves');?>
    </div>
<?php }elseif ($this->session->flashdata('failed_leave')){ ?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('failed_leave');?>
    </div>
<?php }?>
<?php if ($this->session->flashdata('set_sick')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('set_sick');?>
    </div>
<?php }elseif ($this->session->flashdata('failed_sick')){ ?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('failed_sick');?>
    </div>
<?php }elseif ($this->session->flashdata('set_internet')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('set_internet');?>
    </div>
<?php }elseif ($this->session->flashdata('internet_failed')){ ?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('internet_failed');?>
    </div>
<?php }?>
<!--Holiday-->

<?php if ($this->session->flashdata('holiday_set')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('holiday_set');?>
    </div>
<?php }elseif ($this->session->flashdata('holiday_failed')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('holiday_failed');?>!
    </div>
<?php }elseif ($this->session->flashdata('remove_holiday')){?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('remove_holiday');?>!
    </div>
<?php }elseif ($this->session->flashdata('remove_failed')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('remove_failed');?>!
    </div>
<?php }?>
<!--Leave Request-->

<?php if ($this->session->flashdata('leave_approved')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('leave_approved');?>
    </div>
<?php }elseif ($this->session->flashdata('leave_disapproved')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('leave_disapproved');?>
    </div>
<?php } ?>
<!--Sick Leave request-->
<?php if ($this->session->flashdata('sick_approved')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('sick_approved');?>
    </div>
<?php }elseif ($this->session->flashdata('sick_disapproved')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('sick_disapproved');?>
    </div>
<?php } ?>
<!--Payroll error msg-->
<?php if ($this->session->flashdata('payslip_failed')){ ?>
    <div class="alert alert-warning alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('payslip_failed');?>
    </div>
<?php }?>
<!--Employee request leaves-->
<?php if ($this->session->flashdata('leaves')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('leaves');?>
    </div>
<?php }elseif ($this->session->flashdata('leaves_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('leaves_failed');?>
    </div>
<?php } ?>
<!--Employee request sick leaves-->
<?php if ($this->session->flashdata('sick')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('sick');?>
    </div>
<?php }elseif ($this->session->flashdata('sick_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('sick_failed');?>
    </div>
<?php } ?>
<!--Payroll update-->
<?php if ($this->session->flashdata('unpaid_set') || $this->session->flashdata('paid_set')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('unpaid_set');?>
        <?php echo $this->session->flashdata('paid_set');?>
    </div>
<?php } ?>
<!--Employee Punch In/Out-->
<?php if ($this->session->flashdata('out')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('out');?>
    </div>
<?php }elseif ($this->session->flashdata('out_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('out_failed');?>!
    </div>
<?php }?>
<?php if ($this->session->flashdata('in')){ ?>
    <div class="alert alert-success alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('in');?>
    </div>
<?php }elseif ($this->session->flashdata('in_failed')){?>
    <div class="alert alert-info alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('in_failed');?>!
    </div>
<?php }?>
