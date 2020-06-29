 <div class="panel-heading">
        <h3 class="panel-title"><i class="fas fa-users"></i>&nbsp;Employee List</h3>
    </div>
    <div class="panel-body">
        <table id="employee-tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Home Address</th>
                <th>Phone #</th>
                <th>Mobile #</th>
                <th>Email Add.</th>
                <th>Skype ID</th>
                <th>Monthly Salary</th>
                <th>Paypal Account</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($employee_info as $info): ?>
                <tr>
                    <td><?php echo $info->employee_id?></td>
                    <td><?php echo $info->em_firstname?>&nbsp;<?php echo $info->em_lastname?></td>
                    <td><?php echo $info->em_home_address?></td>
                    <td><?php echo $info->em_phone?></td>
                    <td><?php echo $info->em_mobile?></td>
                    <td><?php echo $info->em_email?></td>
                    <td><?php echo $info->em_skype?></td>
                    <td><?php echo $info->monthly_salary?></td>
                    <td><?php echo $info->paypal_accnt;?></td>
                    <?php
                    $em_des = '';
                    $em_dep = '';
                    ?>
                    <?php foreach ($designation as $des): ?>
                        <?php foreach ($department as $dep): ?>
                            <?php if ($dep->id == $des->department_id && $des->id == $info->designation_id): ?>
                                <?php $em_des = $des->designation; ?>
                                <?php $em_dep = $dep->department; ?>
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach;?>
                    <td><?php echo $em_dep;?></td>
                    <td><?php echo $em_des;?></td>
                    <td>
                        <div class="dropdown" style="display: inline-block">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none;color: grey;">
                                <i class="fas fa-cog fa-lg"></i>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                               <li><a class="dropdown-item set-salary" data-toggle="modal" data-target="#setModal" id="<?php echo $info->id?>" href="#">Set Salary</a></li>
                               <li><a class="dropdown-item set-leaves" data-toggle="modal" data-target="#leavesModal" id="<?php echo $info->id?>" href="#">Set Leaves Credits</a></li>
                               <li><a class="dropdown-item set-sick" data-toggle="modal" data-target="#sickModal" id="<?php echo $info->id?>" href="#">Set Sick Credits</a></li>
                               <li><a class="dropdown-item set-allowance" data-toggle="modal" data-target="#allowanceModal" id="<?php echo $info->id?>" href="#">Set Internet Allowance</a></li>
                            </ul>
                        </div>
                        &nbsp;|&nbsp;
                        <a style="display: inline-block" href="" data-toggle="modal" data-target="#editModal" class="editEmployee" id="<?php echo $info->id?>"><i class="far fa-edit fa-lg"></i></a>&nbsp;|&nbsp;
                        <a style="display: inline-block" href="" data-toggle="modal" data-target="#deleteModal" class="deleteEmployee" id="<?php echo $info->id?>"><i class="fas fa-trash-alt fa-lg"></i></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<!--Set Salary Modal -->
<div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/setSalary" method="post">
                    <div class="form-group">
                        <label for="">Monthly Salary</label>
                        <input type="hidden" name="id" id="id-employee">
                        <input type="number" name="salary" id="employee-salary" class="form-control" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Set</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Set Leave Credits Modal -->
<div class="modal fade" id="leavesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Leave Credits</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/setLeaves" method="post">
                    <div class="form-group">
                        <label for="">Leave Credits</label>
                        <input type="hidden" name="id" id="idEmployee">
                        <input type="number" name="leaves" id="employee-leave" class="form-control" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Set</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Set Sick Credits Modal -->
<div class="modal fade" id="sickModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Sick Credits</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/setSickCredits" method="post">
                    <div class="form-group">
                        <label for="">Sick Credits</label>
                        <input type="hidden" name="id" id="employeeId">
                        <input type="number" name="sick" id="employee-sick" class="form-control" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Set</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--Set Internet Allowance Modal -->
<div class="modal fade" id="allowanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Internet Allowance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/setInternetAllowance" method="post">
                    <div class="form-group">
                        <label for="">Internet Allowance</label>
                        <input type="hidden" name="id" id="employee_Id">
                        <input type="number" name="allowance" id="internet-allowance" class="form-control" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Set</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
                <form action="<?php echo site_url();?>dashboard/editEmployeeInfo" method="post">
                    <input type="hidden" name="employee[id]" id="id-Employee">
                    <table>
                        <tr>
                            <td>Employee ID</td>
                            <td><span id="employeeID"></span></td>
                        </tr>
                        <tr>
                            <td>Firstname</td>
                            <td><input type="text" name="employee[fname]" class="form-control" id="fname" required></td>
                        </tr>
                        <tr>
                            <td>Lastname</td>
                            <td><input type="text" name="employee[lname]" id="lname" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Home Address</td>
                            <td><textarea class="form-control" name="employee[address]" id="address" cols="30" rows="5" required></textarea></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><input type="text" name="employee[phone]" id="phone" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Mobile Number</td>
                            <td><input type="text" name="employee[mobile]" id="mobile" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td><input type="email" name="employee[email]" id="email" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Skype ID</td>
                            <td><input type="text" name="employee[skype]" id="skype" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td>Start Date</td>
                            <td>
                                <div class="form-group">
                                    <div class='input-group date' id='edit-start-joined'>
                                        <input type='text' id="startdate" name="employee[startdate]" class="form-control datetimepicker-input" />
                                        <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>
                                <select name="" id="selected-department" class="form-control">
                                    <option value="">Select Department</option>
                                    <?php foreach ($department as $dep): ?>
                                        <option><?php echo $dep->department;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>
                                <select name="employee[designation]" id="show-designation" class="form-control">
                                    <option id="em-designation"><span id="em-designation"></span></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Paypal Account</td>
                            <td><input type="email" name="employee[paypal]" id="paypal-accnt" class="form-control" required></td>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/deleteEmployee" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="emID">
                        <h3 style="text-align: center">Are you sure?</h3>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>