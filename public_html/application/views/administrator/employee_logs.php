<div class="container" style="margin-top: 20px;margin-bottom: 65px">
    <div style="margin-bottom: 30px"><h4 style="color: grey"><i class="fas fa-clock"></i>&nbsp;Employee Logs</h4></div>
    <div class="row">
        <div class="col-md-3" style="">
            <ul class="employee-list">
                <?php foreach ($employee_info as $em): ?>

                    <div id="check-status">
                        <?php foreach ($employee_logged as $logged): ?>
                        <?php
                        if ($logged->user_id == $em->id):
                        if ($logged->logged == 0){
                            $bg = "background-color: #bbb";
                        }elseif ($logged->logged == 2){
                            $bg = "background-color: #bb1423";
                        }elseif ($logged->logged == 1){
                            $bg = "background-color: #3abb3a";
                        }
                        endif;
                        ?>
                    <?php endforeach;?>
                    </div>
                    <li>
                        <img src="<?php echo base_url()?>assets/images/avatar.jpg" alt="" height="30" width="30" style="border-radius: 50%">
                        <?php echo $em->em_firstname?>&nbsp;<?php echo $em->em_lastname?>
                        <span class="dot" style="<?php echo $bg?>" ></span>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-md-9">
            <table class="employee-logs"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Logs</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($em_shifts as $shifts): ?>
                    <?php foreach ($employee_info as $em): ?>
                        <?php if ($shifts->employee_id == $em->id): ?>
                            <tr>
                                <td><?php echo $em->employee_id?></td>
                                <td><?php echo $em->em_firstname?>&nbsp;<?php echo $em->em_lastname?></td>
                                <td><?php echo $shifts->shift_details?></td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>