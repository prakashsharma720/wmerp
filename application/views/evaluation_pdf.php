<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url=base_url();
$img=$base_url.'uploads/logo.jpg';
//print_r($img);exit;
?>
<?php 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);


	if($result)
	{
	$id=$result[0]['id'];
	$name=$result[0]['supplier'];
	$created_on=date('d-m-Y',strtotime($result['0']['created_on']));
	$contact='9664100138';
	$email='yashgmail.com';
	$roles='Super Admin';
	$contact_other='9772061340';
	$dob='17-10-1992';
	$age='26 years';
	$address='Udaipur';
	/*$table=[];
	foreach($result['0']['er_details'] as $key => $value) {
			$criteria=$value['criteria'];
			$marks=$value['marks_obtained'];

			$table[]= '<tr>
						<td width="50%">
							 '.$criteria.':
						</td>
						<td width="50%">'.$marks.'</td>
					</tr>';
		}*/
	//print_r($table);exit;
	/*$contact=$result['contact'];
	$address=$result['address'];
	$email=$result['email'];
	$roles=$result['roles'];
	$contact_other=$result['contact_other'];
	$dob=date('d-m-Y',strtotime($result['dob']));
	$from = new DateTime($result['dob']);
	$to   = new DateTime('today');
	$age= $from->diff($to)->y; */
	//echo date_diff(date_create('1970-02-01'), date_create('today'))->y;
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica', '', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
   ob_start();
	echo '<html>
			<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
			<style type="text/css">
			tr{
				margin:5px;
			}
			</style>
			<script type="text/javascript" src="4f92bc82-86b3-11e9-9d71-0cc47a792c0a_id_4f92bc82-86b3-11e9-9d71-0cc47a792c0a_files/wz_jsgraphics.js"></script>
			</head>
			<body><table class="table" width="100%">
					<tr>
						<td width="100%">
							<img src="'.$img.'" >
						
						</td>
					</tr>
					<br>
					
					<tr>
						<td width="33%">
							Enrollment ID : PPL/'.$id.'
						</td>
						<td width="33%">
						 Joining Date: '.$created_on.'
						</td>
						<td width="33%">
						 Form No : ..............
						</td>
					</tr>
					<br>
					<tr>
						<td width="50%">
							Full Name of Candidate :
						</td>
						<td width="50%">'.$name.'</td>
					</tr>
					<br>
					<tr>
						<td width="50%">
							Father Name of Candidate :
						</td>
						<td width="50%">'.$contact.'</td>
					</tr>
					<br>
					
					<tr>
						<td width="50%">
							Mobile No. (Self) +91 :
						</td>
						<td width="50%">'.$contact.'</td>
					</tr>
					<br>
					<tr>
						<td width="50%">
							Mobile No. (Parents) +91 : 
						</td>
						<td width="50%">'.$contact_other.'
						</td>
					</tr>
					<br>
					<tr>
						<td width="50%">
							Email : 
						</td>
						<td width="50%">'.$email.'
						</td>
					</tr>
					<br>
					<tr>
						<td width="50%">
							Date of Birth : '.$dob.'
						</td>
						<td width="50%">
						Age: '.$age.'
						</td>
					</tr>
					<br>
					<tr>
						<td width="50%">
							Address :
						</td>
						<td width="50%">'.$address.'
						</td>
					</tr>
					<br>
					<br>
					<tr>
						<td width="50%">
							Proficiency in Cricket: 
						</td>
						<td width="50%">'.$roles.'
						</td>
					</tr>
					<br>
					<tr>
						<td width="100%">
							<b>I have carefully gone through all the terms & conditions and agree to abide by it strictly.</b>
						</td>		
					</tr>
					<br><br><br><br>
					<tr>
						<td width="50%">
							<b>Sig. of Parents : </b>
						</td>
						<td width="50%">
							<b>Sig. of Candidate :</b>
						</td>
					</tr>
					<br><br>
					<tr>
						<td width="100%">
							<b>Enclose: <ul><li>Four Passport size recent photographs.</li><br>
							<li> Birth Certificate </li></ul></b>
						</td>
					</tr>
					<br><br>
					<b>** Submission of form does not confirm Admission of the Candidate</b>
				</table>
				</div>
			</body>
		</html>';
		}
		$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($content, true, false, true, false, '');
		$obj_pdf->Output('output.pdf', 'I');


?>
