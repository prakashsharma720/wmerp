<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
setlocale(LC_MONETARY, 'en_IN');
//$amount = number_format($obj['grand_total'],2);
//echo $amount; 

?>
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
        <style type="text/css">
            p{
                text-color:#000;
                font-family: "Times New Roman","serif";
                font-size: 15px;
            }   
            h3{
                text-color:#000;
                font-family: "Times New Roman","serif";  
            }    
        </style>
    </head>
    <body>        

        <h3><?= $heading ?></h3>       
        <p class="MsoNormal"><?= $text ?></p>
        <p class="MsoNormal"><?= $invoice_info ?></p>
        <table style="width:100%;border-collapse: collapse;">   
            <thead>
                <tr style="border: 1px solid black;">
                    <th style="border: 1px solid black;"> S.NO.</th>
                    <th style="border: 1px solid black;"> Grade Name</th>
                    <th style="border: 1px solid black;"> HSN Code</th>
                    <th style="border: 1px solid black;"> No. of Bags</th>
                    <th style="border: 1px solid black;"> QTY(MT)</th>
                    <th style="border: 1px solid black;"> RATE/MT</th>
                    <th style="border: 1px solid black;"> AMOUNT</th>
                </tr> 
            </thead>
            <tbody>

                <?php $i=1;foreach($invoice_data['0']['invoice_details'] as $invoice_details) { ?>
                             
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;"><?= $i ?></td>
                    <td style="border: 1px solid black;">
                            <b> <?= $invoice_details['mineral_name']?></b><br>
                             Grade: <?= $invoice_details['grade_name']?> <br>
                            Lot no: <?= $invoice_details['lot_no']?> &nbsp;&nbsp;
                            Batch No : <?= $invoice_details['batch_no']?><br></td>
                    <td style="border: 1px solid black;"><?= $invoice_details['hsn_code']?></td>
                    <td style="border: 1px solid black;"><?= $invoice_details['no_of_bags']?></td>
                    <td style="border: 1px solid black;"><?= $invoice_details['quantity']?></td>
                    <td style="border: 1px solid black;"><?php echo number_format($invoice_details['rate'],2);?></td>
                    <td style="border: 1px solid black;">
                          <?php echo number_format($invoice_details['amount'],2);?>
                    </td>
                </tr>                
                <?php $i++;} ?>             
            </tbody>
        </table>
        <br>
        <p class="MsoNormal"> Hope above is in line with your requirements. <br><br>
        Thanks and best regards </p><br>

        <p class="MsoNormal"><i><span lang="EN-US" style="font-size:18.0pt;font-family:&quot;Monotype Corsiva&quot;;color:black">Siddharth Choudhary</span></i><span lang="EN-US" style="color:black"><u></u><u></u></span></p>

        <p class="MsoNormal"><img width="138" height="46" id="m_-2981390755796548248Picture_x0020_1" src="http://chaudhary.muskowl.com/uploads/logo.png" alt="CNCO Logo.jpg" data-image-whitelisted="" class="CToWUd"><span lang="EN-US">&nbsp;<u></u><u></u></span></p>

        <p class="MsoNormal"><span lang="EN-US" style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">(A NSIC-CRISIL Performance and Credit Rated Co)<u></u><u></u></span></p>

        <p class="MsoNormal"><?= $footer ?></p>
         <p class="MsoNormal"><span lang="EN-GB" style="font-size:18.0pt;font-family:Webdings;color:green">P</span><span lang="EN-GB" style="font-size:10.0pt;color:navy"> </span><span lang="EN-GB" style="font-size:8.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:green">please don't print this e-mail unless you really need to.</span><span lang="EN-US" style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><u></u><u></u></span></p>
        <p class="MsoNormal"><span lang="EN-GB" style="font-size:8.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:green">Save trees, protect enviornment.</span><span lang="EN-US" style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:#1f497d"><u></u><u></u></span></p>

    </body>
</html>
