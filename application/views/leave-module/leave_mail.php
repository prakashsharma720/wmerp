<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $subject ?></title>
    </head>
    <body >        
        <h1 face="trebuchet ms, sans-serif">Dear, Management</h1>
        <p face="trebuchet ms, sans-serif"><b>Subject:</b> <?= $subject ?></p>
        <p face="trebuchet ms, sans-serif"><b>Leave Reason:</b> <?= $leave_reason ?></p>
        <p face="trebuchet ms, sans-serif"><b>Leave Type:</b> <?= $leave_type ?></p>
        <?php if ($leave_category == 'full') { ?>
        <p face="trebuchet ms, sans-serif">I humbly request to you that I need full day leave on <b><?= @$from_date ?> to <?= @$to_date ?></b>.</p>
    <?php }else if ($leave_category == 'half'){ ?>
           <p face="trebuchet ms, sans-serif">I humbly request to you that I need half day leave on <b><?= @$halfday_date ?></b> from <b><?= @$halfday_type ?> </b>.</p>
    <?php } else {?>

           <p face="trebuchet ms, sans-serif">I humbly request to you that I need a Gate Pass leave on <b>
            <?= @$gate_date. ' ('.@$gate_time_from.' - '.@$gate_time_to.')'; ?> </b>.</p>
    <?php } ?>
        <!-- <p>because <?= $leave_reason ?></p> -->
        <p face="trebuchet ms, sans-serif">Please allow me. I would be very thank full to you for this act of compassion.</p>
        <hr>
        <b><font size="4" face="trebuchet ms, sans-serif">Thanks &amp;&nbsp;Regards</font></b>
        <div><font size="4" face="trebuchet ms, sans-serif"><?= @$user_name?></font></div>
        <div><b><font size="4" face="trebuchet ms, sans-serif"><?= @$designation?></font></b></div>
        <div><b><font face="trebuchet ms, sans-serif">(Muskowl LLP)</font></b></div>
    </body>
</html>
