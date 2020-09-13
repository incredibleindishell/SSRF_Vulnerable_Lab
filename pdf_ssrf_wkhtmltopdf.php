<?php 
include('head2.php');

		echo '<div id="left"><div class="main"><table align=center  cellspacing="0" cellpadding="0" style="border-collapse: collapse;border:0px;">
		<tr>
		<form method=post action="index.php">
		<td align=right style="padding:0px; border:0px; margin:0px;">
				<input type=submit name=home value="Home" class="side-pan">
		</td>
		
				</form></tr></table></div></div>
				<div id="right"></div><div align=center>';	
				
				
echo '
		<table width="35%" style=" border:0px;background-color: #191919; opacity: 0.9; padding: 20px;" >
			<form method=post>
		<tr><td align=center  colspan="2"> 	Member Info  </td></tr>
       <tr>
	   <td align=right>Handle: </td><td><input type=text name=handle> </td>
	   </tr>
		
		<tr><td align=center  colspan="2"> <input type=submit name=insert value="Generate >:D<">  </td></tr>
       </table> 
	   <br><br>
	   
'; 				

if(isset($_POST['insert']))
{				


$data=$_POST['handle'];

$html='<html><STYLE>
body {
	font-family: Tahoma;
}

div#right {
    margin-left: 20%;
    height: 50px;
	color: white;
    font-size: 20px;
    font-family: Georgia, serif;
	}
.main div {
  float: left;
  clear: none; 
	}

tr {
BORDER: solid 1px #333;
color: black;
}
td {
BORDER: dashed 0px ;
}
table {
BORDER: solid 2px #333;
BORDER-COLOR: #333333;

}
</STYLE>        
 <thead>
 <div id="left"><div class="main"><table align=center  cellspacing="0" cellpadding="0" style="border-collapse: collapse;border:2px;">
  <tr>
   <th colspan="3">Invoice #123456789</th>
   <th>14 January 2025
  </tr>
  <tr>
   <td colspan="2">
    <strong>Pay to:</strong><br>
    Acme Billing Co.<br>
    123 Main St.<br>
    Cityville, NA 12345
   </td>
   <td colspan="2">
    <strong>Customer:</strong><br>
    '.$data.'<br>
    321 Willow Way<br>
    Southeast Northwestershire, MA 54321
   </td>
  </tr>
 </thead>
 <tbody>
  <tr>
   <th>Name / Description</th>
   <th>Qty.</th>
   <th>@</th>
   <th>Cost</th>
  </tr>
  <tr>
   <td>Paperclips</td>
   <td>1000</td>
   <td>0.01</td>
   <td>10.00</td>
  </tr>
  <tr>
   <td>Staples (box)</td>
   <td>100</td>
   <td>1.00</td>
   <td>100.00</td>
  </tr>
 </tbody>
 <tfoot>
  <tr>
   <th colspan="3">Subtotal</th>
   <td> 110.00</td>
  </tr>
  <tr>
   <th colspan="2">Tax</th>
   <td> 8% </td>
   <td>8.80</td>
  </tr>
  <tr>
   <th colspan="3">Grand Total</th>
   <td>Rs. 118.80</td>
  </tr>
 </tfoot>
</table>
';

$tost='test';

$all=fopen('sample.html','w');
fwrite($all,$html);


//$path_pdf_converter='C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe'; remove the comment if you want to use it on Windows machine
//passthru('"'.$path_pdf_converter.'" -T 0 -R 0 -B 0 -L 0 --orientation Portrait --page-size A4 sample.html output4.pdf'); remove the comment if you want to use it on Windows machine
 passthru('xvfb-run wkhtmltopdf -T 0 -R 0 -B 0 -L 0 --orientation Portrait --page-size A4 --quiet sample.html output4.pdf 2>&1'); //comment this line if you want to use code on Windows
 
 
 echo '<table width="35%" style=" border:0px;background-color: #191919; opacity: 0.6; padding: 20px;" >
			<form method=post>
		<tr><td align=center  colspan="2">Hello '.htmlentities($data).', please download the generated PDF. Click <a href="output4.pdf">Here</a></td></tr></table>';
}

?>


