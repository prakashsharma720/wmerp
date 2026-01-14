
  <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Success!</h5>
                 <?php echo $this->session->flashdata('success'); ?>

                 
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
      

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $subject ?></title>
    </head>
    <body >   
   
        <h1 face="trebuchet ms, sans-serif"><?= $this->lang->line('dear_management') ?></h1>
        <!-- <p face="trebuchet ms, sans-serif"><b>Subject:</b> <?= $subject ?></p> -->
        
       
        <p face="trebuchet ms, sans-serif"><?= $this->lang->line('today_lead_details') ?></p>
        <br>
      
        <table  class="table table-bordered">
            <thead>
                <tr>
                    <th><?= $this->lang->line('dear_management'); ?></th>
<th><?= $this->lang->line('total_leads'); ?></th>
<th><?= $this->lang->line('actual_leads'); ?></th>
<th><?= $this->lang->line('duplicate_leads'); ?></th>
<th><?= $this->lang->line('target_short'); ?></th>
                 
                </tr>
            </thead>
            <tbody>
            <?php 
            $count=0;
                foreach($query as $result){
                    
                
           
?>
                <tr>
                    <td><?= $result['person_name']?></td>
                    <td><?= $result['lead_count']?></td>
                    <td><?php
                           echo $result['lead_count']-$result['is_duplicate'];
                    ?></td>
                    <td><?= $result['is_duplicate']?></td>
                    <td><?= $result['target']-$result['lead_count']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        
  
      
        
        <hr>
        <b><font size="4" face="trebuchet ms, sans-serif">Thanks &amp;&nbsp;Regards</font></b>
        <!-- <div><font size="4" face="trebuchet ms, sans-serif"></font></div>
        <div><b><font size="4" face="trebuchet ms, sans-serif"></font></b></div> -->
        <div><b><font face="trebuchet ms, sans-serif">(Muskowl LLP)</font></b></div>
    </body>
</html>
     