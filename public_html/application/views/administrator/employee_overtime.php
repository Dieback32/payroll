<div class="panel-heading">
    <h3 class="panel-title"><i class="fas fa-hourglass-start"></i>&nbsp;Overtime Request</h3>
</div>
<div class="panel-body">
    <table id="employee-tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Date</th>
            <th>Notes</th>
            <th>Approval</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($request as $req):?>
            <?php foreach ($employee_info as $info): ?>
                <?php if ($req->employee_id == $info->employee_id): ?>
                    <tr>
                        <td><?php echo $info->employee_id?></td>
                        <td><?php echo $info->em_firstname?></td>
                        <td><?php echo $info->em_lastname?></td>
                        <td><?php echo $req->date?><input type="hidden" id="date-request" value="<?php echo $req->date?>"></td>
                        <td><?php echo $req->note?></td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#approvalModal" class="requestApproval" id="<?php echo $req->id?>"><i class="fas fa-thumbs-up fa-lg"></i></a>
                        </td>
                    </tr>
                <?php endif;?>
            <?php endforeach; ?>
        <?php endforeach;?>
        </tbody>
    </table>

</div>

<!--Approval Modal-->
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
                <form action="<?php echo site_url();?>dashboard/requestOTApproved" method="post">
                    <div class="form-group">
                        <input type="hidden" name="request_id" id="request-ot-id">
                        <h3 style="text-align: center">Are you sure?</h3>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Approve</button>
            </div>
            </form>
        </div>
    </div>
</div>