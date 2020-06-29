 <div class="panel-heading">
        <h3 class="panel-title"><i class="far fa-calendar-check"></i>&nbsp;Holidays</h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo site_url()?>dashboard/setHolidays" method="post" id="set-holiday">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Select Holiday</label>
                    <div class="form-group" style="width: 220px">
                        <div class='input-group date' id='holiday-picker'>
                            <input type='text' name="holiday" id="selected-holiday" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <span id="check-error" style="color: red"></span>
                    <input type="hidden" id="present-date" value="<?php echo date('m/d/Y')?>">
                </div>
                <div class="col-md-3" style="margin-top: 30px">
                    <button class="btn btn-success"  type="submit">Set</button>
                </div>
            </div>
        </form>
        <div class="row">
            <table id="employee-tbl" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($holidays as $day): ?>
                    <?php
                    $create_date = date_create($day->date);
                    $date = date_format($create_date,'M d, Y');
                    ?>
                    <tr>
                        <td><span style="font-weight: bold"><?php echo $date;?></span></td>
                        <td><a href="" data-toggle="modal" data-target="#holidayModal" class="removeHoliday" id="<?php echo $day->id?>" style="color:red"><i class="fas fa-trash-alt fa-lg"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<!--    Modal-->
<div class="modal fade" id="holidayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
                <form action="<?php echo site_url();?>dashboard/removeHoliday" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="holidayID">
                        <h3 style="text-align: center">Are you sure?</h3>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Remove</button>
            </div>
            </form>
        </div>
    </div>
</div>