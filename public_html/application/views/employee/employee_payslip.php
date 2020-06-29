<div class="panel-heading">
    <h3 class="panel-title"><i class="fas fa-tag"></i>&nbsp;Payroll</h3>
</div>
<div class="panel-body">
    <div class="row">
        <table id="payslip-emp-tbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Payslip ID #</th>
                <th>Date</th>
                <th>Gross Salary</th>
                <th>Deduction</th>
                <th>Net Pay</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($payslip as $cnt => $pay): ?>
                <?php if ($employee_info[0]->id == $pay->employee_id): ?>
                <?php $status = $pay->status; ?>
                <?php
                    $create_from = date_create($pay->date_from);
                    $create_to = date_create($pay->date_to);
                    $date_from = date_format($create_from,'M d,Y');
                    $date_to = date_format($create_to,'M d,Y');
                ?>
               <tr>
                   <td><?php echo $cnt+1;?></td>
                   <td><?php echo $pay->id_number;?></td>
                   <td><?php echo $date_from?> - <?php echo $date_to?></td>
                   <td><?php echo $pay->gross;?></td>
                   <td><?php echo $pay->deduction;?></td>
                   <td><?php echo $pay->net;?></td>
                   <td><?php echo $status==1?'Paid':'Unpaid';?></td>
                   <td><button class="btn btn-info emp-payslip-page" data-id="<?php echo $pay->id;?>" data-toggle="modal" data-target="#view-emp-payslip">View</button></td>
               </tr>
                <?php endif;?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!--View and Print Payslip -->
<div class="modal fade" id="view-emp-payslip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payslip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="printPayslip">
                <div class="row payslip-title">
                    <div class="col-md-12">
                        <div class="paid-logo-container-emp">
                            <img src="<?php echo base_url();?>assets/img/paid.png" alt="Paid" width="100" height="52" style="position: absolute">
                        </div>
                        <h4>3w Corner</h4>
                        <small></small>
                        <div class="payslip-date">
                            <p>Payslip for the period of <span id="payslip-from"></span> - <span id="payslip-to"></span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table-payslip">
                            <tr>
                                <td class="payslip-name"><span>Employee ID </span></td>
                                <td class="payslip-data">: <span id="payslip-employeeID"></span></td>
                                <td class="payslip-name" style="padding-left: 15px"><span>Name</span></td>
                                <td class="payslip-data" style="padding-left: 15px">: <span id="payslip-name"></span></td>
                            </tr>
                            <tr>
                                <td class="payslip-name"><span>Department</span></td>
                                <td class="payslip-data">: <span id="payslip-department"></span></td>
                                <td class="payslip-name" style="padding-left: 15px"><span>Designation</span></td>
                                <td class="payslip-data" style="padding-left: 15px">: <span id="payslip-designation"></span></td>
                            </tr>
                            <tr>
                                <td class="payslip-name">Days of Worked</td>
                                <td class="payslip-data">: <span id="payslip-worked-days"></span></td>
                                <td class="payslip-name" style="padding-left: 15px"><span>Paypal Account</span></td>
                                <td class="payslip-data" style="padding-left: 15px">: <span id="payslip-paypal"></span></td>
                            </tr>
                            <tr>
                                <td class="payslip-name"><span>Date of Joining</span></td>
                                <td class="payslip-data">: <span id="payslip-date-joined"></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="payslip-name"><span>Holiday</span></td>
                                <td class="payslip-data">: <span id="payslip-holiday"></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table-payslip" width="100%">
                            <thead>
                            <tr style="border-bottom: 2px solid black;">
                                <th style="margin-left: 5px">Earnings</th>
                                <th style="float: right;margin-right: 5px">Amount</th>
                                <th style="padding-left: 15px">Deductions</th>
                                <th style="float: right;margin-right: 5px">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="payslip-name">Monthly Rate</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-monthly-rate"></span></td>
                                <td class="payslip-name" style="padding-left: 15px">Undertime</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-undertime"></span></td>
                            </tr>
                            <tr>
                                <td class="payslip-name">Overtime</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-overtime"></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="payslip-name">Paid Leaves</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-paid-leaves"></span></td>
                                <td class="payslip-name"></td>
                                <td class="payslip-data"></td>
                            </tr>
                            <tr>
                                <td class="payslip-name">Paid Sick leaves</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-paid-sick"></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="payslip-name">Holiday Pay</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-holiday-pay"></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="payslip-name">Gross Salary</td>
                                <td class="payslip-data" style="float: right;margin-right: 5px"><span id="payslip-gross"></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr style="border-top: 1px solid black;">
                                <th style="margin-left: 5px">Total Earnings:</th>
                                <th style="float: right;"><span id="payslip-total"></span></th>
                                <th style="padding-left: 15px;">Total Deductions:</th>
                                <th style="float: right;"><span id="payslip-deduction"></span></th>
                            </tr>
                            <tr style="border-top: 1px solid black;">
                                <th></th>
                                <th></th>
                                <th style="padding-left: 15px;">Net Pay:</th>
                                <th style="float: right;"><span id="payslip-net"></span></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="printPayslip('printPayslip')" class="btn btn-dark">Print</button>
            </div>
        </div>
    </div>
</div>