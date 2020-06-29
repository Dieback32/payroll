<?php if ($this->session->userdata('shift_status') == 1 || $this->session->userdata('shift_status') != null){ ?>
    <div class="panel-heading">
        <h3 class="panel-title">Punch Out</h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo site_url()?>dailytimerecord/timeOut" method="post">
            <div class="form-group">
                <textarea name="note" id="" cols="30" rows="5" class="form-control" style="width: 300px;resize: none" placeholder="Note"></textarea>
            </div>
            <div class="form-group">
                <label for="">Request for Overtime</label>
                <input type="checkbox" name="request" value="1">
            </div>
            <button type="submit" class="btn btn-primary">Out</button>
        </form>
    </div>
<?php }else{ ?>
    <div class="panel-heading">
        <h3 class="panel-title">Punch In</h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo site_url()?>dailytimerecord/timeIn" method="post">
            <div class="form-group">
                <button type="submit" class="btn btn-success">In</button>
            </div>
        </form>
    </div>
<?php }?>

