<div class="panel-heading">
    <h3 class="panel-title"><i class="fas fa-tag"></i>&nbsp;Payroll</h3>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <label for="">Date From</label>
            <div class="form-group">
                <div class='input-group date' id='payroll-from'>
                    <input type='text' name="date-from" id="payroll_date_from" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label for="">Date To</label>
            <div class="form-group">
                <div class='input-group date' id='payroll-to'>
                    <input type='text' name="date-to" id="payroll_date_to" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label for="">Employee ID</label>
            <div class="form-group">
                <select name="employee_id" id="employee_ID" class="form-control">
                    <option value="">--Employee ID--</option>
                    <?php foreach ($employee_info as $employee): ?>
                        <option><?php echo $employee->employee_id?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <form action="<?php echo site_url();?>dashboard/createPayslip" method="post" id="create-em-payslip">
                <input type="hidden" name="payslip[employee_id]" id="employees_ID" required>
                <input type="hidden" name="payslip[date_from]" id="create-date-from" required>
                <input type="hidden" name="payslip[date_to]" id="create-date-to" required>
                <input type="hidden" name="payslip[worked_days]" id="create-worked-days" required>
                <input type="hidden" name="payslip[holiday]" id="create-holiday" required>
                <input type="hidden" name="payslip[leaves]" id="create-leaves" required>
                <input type="hidden" name="payslip[sick]" id="create-sick" required>
                <input type="hidden" name="payslip[overtime]" id="create-overtime" required>
                <input type="hidden" name="payslip[undertime]" id="create-undertime" required>
                <input type="hidden" name="payslip[gross]" id="create-gross" required>
                <input type="hidden" name="payslip[total]" id="create-total" required>
                <input type="hidden" name="payslip[deduction]" id="create-deduction" required>
                <input type="hidden" name="payslip[net]" id="create-net" required>
                <button type="submit" class="btn btn-primary" style="margin-top: calc(2.25rem + 2px)">Create</button>
            </form>
            <small id="error-payslip" style="color: red"></small>
        </div>
    </div>
    <div class="row" id="show-employee" style="margin-top: 20px">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <div class="em-payroll">
                <div class="em-payroll-header">
                    <span><i class="far fa-user"></i>&nbsp;Employee</span>
                </div>
                <div class="em-payroll-container">
                    <table>
                        <tbody>
                        <tr>
                            <td style="color: grey;text-align: right">Name</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Monthly Rate</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Working Hours<br>(HH:MM)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Overtime<br>(HH:MM)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Undertime<br>(HH:MM)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Worked Days</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="em-payroll">
                <div class="em-payroll-header">
                    <span><i class="fas fa-tag"></i>&nbsp;Payroll</span>
                </div>
                <div class="em-payroll-container">
                    <table>
                        <tbody>
                        <tr>
                            <td style="color: grey;text-align: right">Vacation/Paid Leaves</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Unpaid Leaves</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Paid Sick Credits</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Unpaid Sick Credits</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Gross Salary</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Deduction</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="color: grey;text-align: right">Net Pay</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


