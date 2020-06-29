<!-- NAVBAR -->
<?php $user = $this->session->userdata('authorization'); ?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand" style="padding: 15px 39px!important;">
        <img src="<?php echo base_url();?>assets/img/3wlogo.png" alt="Klorofil Logo" class="img-responsive logo" height="21" width="60">
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url();?>assets/img/avatar.jpg" class="img-circle" alt="Avatar">
                        <span><?php echo $user==1?ucfirst('administrator'):ucfirst($this->session->userdata('username'));?></span> <i class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url();?>dashboard/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->