<div class="panel-heading">
    <h3 class="panel-title"><i class="fas fa-user-plus"></i>&nbsp;Add Employee</h3>
</div>
<div class="panel-body">
    <form action="<?php echo site_url()?>dashboard/addingEmployee" method="post">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item active">
                <a style="color: grey" class="nav-link" href="#personal" role="tab" data-toggle="tab">Personal Details</a>
            </li>
            <li class="nav-item">
                <a style="color: grey" class="nav-link" href="#company" role="tab" data-toggle="tab">Company Details</a>
            </li>
            <li class="nav-item">
                <a style="color: grey" class="nav-link" href="#paypal" role="tab" data-toggle="tab">Paypay Details</a>
            </li>
            <li class="nav-item">
                <a style="color: grey" class="nav-link" href="#login" role="tab" data-toggle="tab">Login Info</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="personal">
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>Firstname</td>
                                <td><input type="text" name="employee[fname]" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Lastname</td>
                                <td><input type="text" name="employee[lname]" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Home Address</td>
                                <td><textarea style="resize: none" class="form-control" name="employee[address]" id="" cols="30" rows="5" required></textarea></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>Phone Number</td>
                                <td><input type="text" name="employee[phone]" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Mobile Number</td>
                                <td><input type="text" name="employee[mobile]" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td><input type="email" name="employee[email]" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Skype ID</td>
                                <td><input type="text" name="employee[skype]" class="form-control" required></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="company">
                <table>
                    <tr>
                        <td>Employee ID</td>
                        <td><input type="text" name="employee[employeeId]" value="<?php echo $random_id;?>" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td>
                            <select name="department" id="selected-department" class="form-control">
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
                            <select name="employee[designation]" id="show-designation" class="form-control" required>
                                <option value="">Select First a Department</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Start Date</td>
                        <td>
                            <div class='input-group date' id='start-joined'>
                                <input type='text' name="employee[startdate]" class="form-control datetimepicker-input" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Monthly Rate</td>
                        <td><input type="number" name="employee[rate]" class="form-control" required></td>
                    </tr>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="paypal">
                <table>
                    <tr>
                        <td>Paypal Account</td>
                        <td><input type="email" name="employee[paypal]" class="form-control" required></td>
                    </tr>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="login">
                <span id="error-pass" style="color: red"></span>
                <table>
                    <tr>
                        <td>Username/Email</td>
                        <td><input type="text" name="employee[username]" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" id="set-pass" name="employee[password]" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" id="confirm-pass" name="c_password" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="reset" class="btn btn-primary">Clear</button>&nbsp;<button type="submit" class="btn btn-success">Add Employee</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</div>
