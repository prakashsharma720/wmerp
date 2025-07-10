<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <title> Pyrotech Workspace Landing Page Enquiry</title>
    </head>
    <body>        
        <h1>Hello Admin !</h1>       
        <p> You have received new enquiry from pyrotech workspace landing page.</p>
        <table style="width:100%;border-collapse: collapse;">            
            <tbody>
                <tr style="border: 1px solid black;">
                    <th style="border: 1px solid black;">Name</th>
                    <td style="border: 1px solid black;"><?= $name ?></td>
                </tr>                
                <tr style="border: 1px solid black;">
                    <th style="border: 1px solid black;">Email</th>
                    <td style="border: 1px solid black;"><?= $email ?></td>
                </tr>                
                <tr style="border: 1px solid black;">
                    <th style="border: 1px solid black;">Mobile No</th>
                    <td style="border: 1px solid black;"><?= $contact ?></td>
                </tr>                
                <tr style="border: 1px solid black;">
                    <th style="border: 1px solid black;"> Enquiry For </th>
                    <td style="border: 1px solid black;"><?= $inquiry ?></td>
                </tr>                
            </tbody>
        </table>


        <p>Thanks & Regards <br>
        Pyrotech Workspace Solutions </p>
    </body>
</html>
