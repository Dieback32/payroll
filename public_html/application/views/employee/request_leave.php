<div class="panel-heading">
    <h3 class="panel-title"><i class="fas fa-plane"></i>&nbsp;Request Leave</h3>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <form action="<?php echo site_url()?>dailytimerecord/requestingLeaves" method="post">
                <div class='input-group date' id='request-leaves'>
                    <input type='text' name="request_date" class="form-control datetimepicker-input" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 20px">Request</button>
            </form>
        </div>
        <div class="col-md-9">
            <table id="leave-request-tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Date Requested</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($request as $leave): ?>
                    <?php
                    $status = "";
                    if ($leave->status == 1){
                        $status = "Approved";
                    }else{
                        $status = "Pending";
                    }
                    ?>
                    <tr>
                        <td><?php echo $leave->request_date;?></td>
                        <td><?php echo $status;?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>