<div class="panel-heading">
    <h3 class="panel-title"><i class="fas fa-clipboard-list"></i>&nbsp;Timesheet</h3>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <label for="">Date From</label>
            <div class="form-group">
                <div class='input-group date' id='record-from'>
                    <input type='text' name="" id="date-from" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <small id="from-error" style="color: red"></small>
            </div>
        </div>
        <div class="col-md-3">
            <label for="">Date To</label>
            <div class="form-group">
                <div class='input-group date' id='record-to'>
                    <input type='text' name="" id="date-to" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Employee ID</label>
                <select name="" id="em_id" class="form-control" style="width: 200px">
                    <option value="">--Employee ID--</option>
                    <?php foreach ($employee as $em_data){ ?>
                        <option><?php echo $em_data->employee_id?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div id="show-employee-name"></div>
        </div>
    </div>
    <div class="row" style="margin-top: 30px"></div>
    <table id="employee-table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="overflow-y: scroll;max-height: 300px">
        <thead>
        <tr>
            <th>Shifts</th>
            <th>Weekdays</th>
            <th>Day</th>
            <th>Punch In</th>
            <th>Punch Out</th>
            <th>Overtime<br>(HH:MM)</th>
            <th>Undertime<br>(HH:MM)</th>
            <th>Duration<br>(HH:MM)</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody id="show-records">

        </tbody>
    </table>
</div>




