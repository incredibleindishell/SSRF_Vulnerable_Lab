<?php

/*coded by Manish Kishan Tanwar @ indishell Lab*/

echo '
<title>--==[[ SSRF using XXE Vulnerability ]]==--</title>
<link href="all.css" rel="stylesheet" type="text/css" />
<STYLE>
.side-pan2 {
   margin: 0;
   border:0px;
   
   width:300px;
   padding: 5px 23px;
   margin:0px;
   -webkit-border-radius: 0px;
   -moz-border-radius: 0px;
   border-radius: 0px;
   border-bottom: 1px solid black;
   color: white;
   font-size: 20px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: left;
   align:left;
   }
</STYLE>

'; 


echo '
<table width="100%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.7;border:0px;" >
			
       <td width="100%" align=center valign="top" rowspan="1">
	   <font color=#ff9933 size="-2"> 
        ##########################################</font><font color=white size="-2">#############################################</font><font color=green size="-2">#############################################</font><br>
           <font color=#ff9933 size=5 face="comic sans ms"><b>--==[[ XXE based </font><font color=white size=5 face="comic sans ms"><b>  SSRF Vuln</font><font color=green size=5 face="comic sans ms"><b>erable Code ]]==--</font><br>
		   <font color=#ff9933 size=5 face="comic sans ms"><b>--==[[</b> With Love</font><font color=white size=5 face="comic sans ms"><b> From  Team </font><font color=green size=5 face="comic sans ms">IndiShell<b>]]==--</font>
		   <div class="hedr"> 
        <td height="10" align="left" class="td1"></td></tr><tr><td 
        width="100%" align="center" valign="top" rowspan="1">
		<font color=#ff9933 size="-2"> 
        ##########################################</font><font color=white size="-2">#############################################</font><font color=green size="-2">#############################################</font><br>
		<font 
        color="red" face="comic sans ms"size="1">
        
						
          
       </table> 
'; 

echo '<div id="left"><div class="main"><table align=center  cellspacing="0" cellpadding="0" style="border-collapse: collapse;border:0px;">
		<tr>
		<form method=post action="'.$_SERVER['SCRIPT_NAME'].'">
		
		<td align=right style="padding:0px; border:0px; margin:0px;" >
				<input type=submit name=load value="XML document reader" class="side-pan2">
		</td>
		</form></tr></table></div></div>
				<div id="right"></div><div align=center>';	


if(isset($_POST['load']))
	{
	
	echo '<table width="30%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.6;">
			<tr><td align=center style="padding: 10px;" >
			<form enctype="multipart/form-data"  method="post" style="align:center">
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
			Upload xml file below:
			<br>
			<br>
			<input type="file" name="file" />
			<br>
			<br>
            <input type="submit" name="upload" value="upload" /></td>
            </tr>
		   </table>
		  </form>';

}

if(isset($_POST['upload']))
{

$xmlfile    = $_FILES['file']['tmp_name'];
libxml_disable_entity_loader (false);

$crew= simplexml_load_file($xmlfile, 'SimpleXMLElement', LIBXML_NOENT) or die("Cannot create XML object");


$crewList  = '<h2 align="center">White Beard Pirate crew members</h2>';
$crewList .= '<table border="1" align="center" cellspacing="3" cellpadding="0" class="tb1" style="opacity: 0.8;">
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Title</th>
                  <th>Devil Fruit</th>
				  <th>Power</th>
                </tr>';

    $serial = 1;

    foreach ($crew as $bookinfo):

        $title  =  $bookinfo->title;
        $name =  $bookinfo->name;
        $fruit  =  $bookinfo->fruit;
    
        $power   =  $bookinfo->power;
    
        $crewList .= "<tr>
                        <td>".$serial."</td>
                        <td>".$title."</td>
                        <td>".$name."</td>
                        <td>".$fruit."</td>
                        <td>".$power."</td>
                    </tr>";

        $serial++;

    endforeach;

    $crewList .= '</table>';

    echo $crewList;

	}
?>
