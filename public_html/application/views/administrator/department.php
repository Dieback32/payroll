
    <div class="panel-heading">
        <h3 class="panel-title"><i class="far fa-building"></i>&nbsp;Department</h3>
    </div>
    <div class="panel-body">
        <div class="row" style="margin-bottom: 16px;">
            <a href="" data-toggle="modal" data-target="#add-department" class="btn btn-primary" style="margin-bottom: 16px"><i class="fas fa-plus"></i>&nbsp;Add Department</a>
        </div>
        <table id="employee-tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Total Employees</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($department as $cnt => $dep): ?>
                <tr>
                    <td><?php echo $cnt+1?></td>
                    <td><?php echo $dep->department?></td>
                    <?php $cnt_des = 0;?>
                    <td>
                        <?php foreach ($designation as $des): ?>
                            <?php if ($dep->id == $des->department_id): ?>
                                <?php $cnt_des = $cnt_des +  $des->total_employees;?>
                                <div class="row">
                                    <div class="col-md-9">
                                        <?php echo $des->designation;?> <strong>(<?php echo $des->total_employees;?>)</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="dropdown">
                                            <a href="" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none;color: grey;">
                                                <i class="fas fa-cog"></i>
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="editDesignation" data-id="<?php echo $des->id;?>" data-toggle="modal" data-target="#edit-designation"><i class="fas fa-pencil-alt"></i>&nbsp;Edit</a></li>
                                                <li><a href="#" class="deleteDesignation" data-id="<?php echo $des->id;?>" data-toggle="modal" data-target="#delete-designation"><i class="fas fa-trash"></i>&nbsp;Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td style="text-align: center;font-weight: bold"><?php echo $cnt_des;?></td>
                    <td style="text-align: center">
                        <div class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none;color: grey;">
                                <i class="fas fa-cogs fa-lg"></i>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="editDepartment" data-id="<?php echo $dep->id;?>" data-toggle="modal" data-target="#edit-department"><i class="fas fa-pencil-alt"></i>&nbsp;Edit</a></li>
                                <li><a href="#" class="deleteDepartment" data-id="<?php echo $dep->id;?>" data-toggle="modal" data-target="#delete-department"><i class="fas fa-trash"></i>&nbsp;Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<!--Add Department and Designation -->
<div class="modal fade" id="add-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
                <form action="<?php echo site_url();?>dashboard/addDepartment" method="post">
                    <div class="form-group">
                        <label for="">Department Name</label>
                        <input type="text" name="department" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Designation</label>
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" name="designation[]" class="form-control">
                                <div id="items-des"></div>
                            </div>
                            <div class="col-md-5">
                                <button id="add-designation" class="btn btn-primary"><i class="fas fa-plus"></i></button>&nbsp;
                                <i id="remove-icon-des" style="color: grey;display: inline-block;cursor: pointer" class="fas fa-trash fa-lg"></i>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Designation -->
<div class="modal fade" id="edit-designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/editDesignation" method="post">
                    <input type="hidden" name="des_id" id="des-id">
                    <div class="form-group">
                        <label for="">Designation</label>
                        <input type="text" id="designation" name="designation" class="form-control" >
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Department -->
<div class="modal fade" id="edit-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
                <form action="<?php echo site_url();?>dashboard/editDepartment" method="post">
                    <input type="hidden" name="dep_id" id="dep_id">
                    <div class="form-group">
                        <label for="">Department Name</label>
                        <input type="text" id="department" name="department" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Add Designation</label>
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" name="designation[]" class="form-control">
                                <div class="items-des-edit"></div>
                            </div>
                            <div class="col-md-5">
                                <a href="" id="add-field-des" class="btn btn-primary"><i class="fas fa-plus"></i></a>&nbsp;
                                <i id="remove-icon-des-edit" style="color: grey;display: inline-block;cursor: pointer" class="fas fa-trash fa-lg"></i>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Delete Department -->
<div class="modal fade" id="delete-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/deleteDepartment" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="delete-dep">
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

<!--Delete Designation -->
<div class="modal fade" id="delete-designation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>dashboard/deleteDesignation" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="designationID">
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