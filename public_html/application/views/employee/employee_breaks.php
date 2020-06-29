
    <?php if ($this->session->flashdata('start')){ ?>
        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('start').' '.date('h:i A');?>
        </div>
    <?php }?>
    <?php if ($this->session->flashdata('end')){ ?>
        <div class="alert alert-secondary alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('end').' '.date('h:i A');?>
        </div>
    <?php }?>
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fas fa-coffee"></i>&nbsp;Breaks</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <?php if ($this->session->userdata('break') != true){ ?>
                    <h4>Start</h4>
                    <form action="<?php echo site_url()?>dailytimerecord/startBreak" method="post">
                        <button type="submit" class="btn btn-primary">Break</button>
                    </form>
                <?php }else{ ?>
                    <h4>END</h4>
                    <form action="<?php echo site_url()?>dailytimerecord/endBreak" method="post">
                        <button type="submit" class="btn btn-info">Return</button>
                    </form>
                <?php }?>
            </div>
            <div class="col-md-10">
                <table class="employee-logs"  cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Logs</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($em_breaks as $break): ?>
                        <?php
                        $status = '';
                        if ($break->punch_type == 2){
                            $status = 'Start';
                        }else{
                            $status = 'End';
                        }
                        ?>
                        <tr>
                            <td><?php echo date('M d,y h:i A',$break->time);?></td>
                            <td><?php echo $status?></td>

                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
