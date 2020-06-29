<div class="container" style="margin-top: 20px">
    <?php if ($this->session->flashdata('process')){ ?>
        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('process');?>
        </div>
    <?php }elseif ($this->session->flashdata('process_f')){?>
        <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('process_f');?>
        </div>
    <?php } ?>
    <div style="margin-bottom: 30px"><h4 style="color: grey"><i class="fas fa-sync-alt"></i>&nbsp;Process List</h4></div>
    <table id="employee-tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($process as $cnt => $pro): ?>
            <tr>
                <td><?php echo $cnt+1;?></td>
                <td><?php echo $pro->description;?></td>
                <?php if ($pro->status == 1){$status = 'QUEUED';}else{$status = 'IN PROCESS';} ?>
                <td><?php echo $status;?></td>
                <td style="text-align: center">
                    <div class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none;color: grey;">
                            <i class="fas fa-cogs fa-lg"></i>
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item editProcess" data-id="<?php echo $pro->id;?>" href="#" data-toggle="modal" data-target="#edit-status"><i class="fas fa-pencil-alt"></i>&nbsp;Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item deleteProcess" data-id="<?php echo $pro->id;?>" href="#" data-toggle="modal" data-target="#delete-status"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!--Edit Process List -->
<div class="modal fade" id="edit-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Process</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
                <form action="<?php echo site_url();?>dashboard/editProcess" method="post">
                    <input type="hidden" name="process[id]" id="process-id">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="process[description]" id="description-pro" cols="0" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="process[status]" id="" class="form-control" style="width: 200px;" required>
                            <option id="status-pro"><span id="status-pro"></span></option>
                            <option>QUEUED</option>
                            <option>IN PROCESS</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Designation -->
<div class="modal fade" id="delete-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/deleteProcess" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="processID">
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