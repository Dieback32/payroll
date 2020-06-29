<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <?php if ($this->session->userdata('authorization') == 1){ ?>
                    <li><a href="<?php echo site_url();?>dashboard/index"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="#employee-sub" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Employee</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="employee-sub" class="collapse ">
                            <ul class="nav">
                                <li><a href="<?php echo site_url()?>dashboard/addEmployee_page" class="">Add Employee</a></li>
                                <li><a href="<?php echo site_url()?>dashboard/employeeList_page" class="">Employee List</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="<?php echo site_url()?>dashboard/department" class=""><i class="lnr lnr-apartment"></i> <span>Department</span></a></li>
                    <li><a href="<?php echo site_url()?>dashboard/holidaysPage" class=""><i class="lnr lnr-calendar-full"></i> <span>Holidays</span></a></li>
                    <li>
                        <a href="#request-sub" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pointer-up"></i> <span>Request</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="request-sub" class="collapse ">
                            <ul class="nav">
                                <li><a href="<?php echo site_url()?>dashboard/overTimeRequest" class="">Overtime Request</a></li>
                                <li><a href="<?php echo site_url()?>dashboard/leaveRequest" class="">Leave Request</a></li>
                                <li><a href="<?php echo site_url()?>dashboard/sickLeaves" class="">Sick Leaves</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="<?php echo site_url()?>dashboard/employeeRecordsPage" class=""><i class="lnr lnr-list"></i> <span>Timesheet</span></a></li>
                    <li>
                        <a href="#payroll-sub" data-toggle="collapse" class="collapsed"><i class="lnr lnr-tag"></i> <span>Payroll</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="payroll-sub" class="collapse ">
                            <ul class="nav">
                                <li><a href="<?php echo site_url()?>dashboard/payrollPage" class="">Create Payroll</a></li>
                                <li><a href="<?php echo site_url()?>dashboard/payslip_page" class="">Payslip</a></li>
                            </ul>
                        </div>
                    </li>
                <?php }elseif ($this->session->userdata('authorization') == 2){?>
                    <li><a href="<?php echo site_url();?>dailytimerecord/index"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                    <li><a href="<?php echo site_url()?>dailytimerecord/attendance" class=""><i class="lnr lnr-briefcase"></i> <span>In/Out</span></a></li>
                    <li><a href="<?php echo site_url()?>dailytimerecord/employee_breaks" class=""><i class="lnr lnr-coffee-cup"></i> <span>Breaks</span></a></li>
                    <li><a href="<?php echo site_url()?>dailytimerecord/requestLeave" class=""><i class="lnr lnr-train"></i> <span>Leaves</span></a></li>
                    <li><a href="<?php echo site_url()?>dailytimerecord/requestSickLeaves" class=""><i class="lnr lnr-heart-pulse"></i> <span>Sick Leaves</span></a></li>
                    <li><a href="<?php echo site_url()?>dailytimerecord/payslip" class=""><i class="lnr lnr-tag"></i> <span>Payroll</span></a></li>
                <?php }?>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->