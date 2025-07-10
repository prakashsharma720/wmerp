

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $subject ?></title>
                <style>
table, th, td {
  border:1px solid black;
  border-collapse: collapse;
}
</style>
    </head>
    <body >   
   
        <h1 face="trebuchet ms, sans-serif">Dear, Management</h1>
        <!-- <p face="trebuchet ms, sans-serif"><b>Subject:</b> <?= $subject ?></p> -->
        
       
        <p face="trebuchet ms, sans-serif">Here is the details of today leads.</p>
        <br>
      
        <table>
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Total Leads</th>
                    <th>Actual Leads</th>
                    <th>Duplicate Leads</th>
                    <th>Target Short</th>
                 
                </tr>
            </thead>
            <tbody>
            <?php 
            $count=0;
                foreach($query as $result){
                    
                
           
?>
                <tr  style="text-align:center;">
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