<?php
/*This code is copied from 33c3ctf CTF*/
function get_contents($url) {
	$disallowed_cidrs = [ "127.0.0.1/24", "169.254.0.0/16", "0.0.0.0/8" ];
	$url_parts = parse_url($url);

		if (!array_key_exists("host", $url_parts)) { die("<p><h3 style=color:red>There was no host in your url!</h3></p>"); }
	echo '<table width="40%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.6;"> 
			  <tr><td align=center style="padding: 10px;" >Domain: - '.$host = $url_parts["host"].'';

		if (filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$ip = $host;
		} else {
			$ip = dns_get_record($host, DNS_A);
			if (count($ip) > 0) {
				$ip = $ip[0]["ip"];
				echo "<br>Resolved to IP: - {$ip}<br>";
				
			} else {
				die("<br>Your host couldn't be resolved man...</h3></p>");
			}
		}

		foreach ($disallowed_cidrs as $cidr) {
			if (in_cidr($cidr, $ip)) {
				die("<br>That IP is a blacklisted cidr ({$cidr})!</h3></p>"); // Stop processing if domain reolved to private/reserved IP
			}
		}
				
		
		echo "<br>Domain IP is not private, Here goes the data fetched from remote URL<br> </td></tr></table>";
		echo "<br><textarea rows=10 cols=50>".file_get_contents($url)."</textarea>";
	
}

function in_cidr($cidr, $ip) {
	list($prefix, $mask) = explode("/", $cidr);

	return 0 === (((ip2long($ip) ^ ip2long($prefix)) >> $mask) << $mask);
}


echo '
<title>--==[[ DNS Rebinding Attack ]]==--</title>
<link href="all.css" rel="stylesheet" type="text/css" />

<table width="100%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.7;border:0px;" >
			
       <td width="100%" align=center valign="top" rowspan="1">
	    <font  color=#ff9933  size="-2"> 
        ##################################################</font><font color=white size="-2">###################################################</font><font color=green size="-2">##################################################</font><br>
           <font color=#ff9933 size=5 face="comic sans ms"><b>--==[[ DNS Rebinding </font><font color=white size=5 face="comic sans ms"><b>  SSRF </font><font color=green size=5 face="comic sans ms"><b> Vulnerable Code ]]==--</font><br>
		   <font color=#ff9933 size=5 face="comic sans ms"><b>--==[[</b> With Love</font><font color=white size=5 face="comic sans ms"><b> From  Team </font><font color=green size=5 face="comic sans ms">IndiShell <b>]]==--</font>
		   <div class="hedr"> 
        <td height="10" align="left" class="td1"></td></tr><tr><td 
        width="100%" align="center" valign="top" rowspan="1">
		 <font  color=#ff9933  size="1"> 
        ##################################################</font><font color=white size="1">###################################################</font><font color=green size="1">##################################################</font>
        <font 
         color="red" face="comic sans ms"size="1"><br><font color=white >
        --==[[Greetz to]]==--</font><br> <font color=#ff9933>Zero cool, code breaker ica, root_devil, google_warrior, INX_r0ot, Darkwolf indishell, Baba, Silent poison India, Magnum sniper, ethicalnoob Indishell, Local root indishell, Irfninja indishell<br>Reborn India, L0rd Crus4d3r, cool toad, Hackuin, Alicks, Gujjar PCP, Bikash, Dinelson Amine, Th3 D3str0yer, SKSking, rad paul, Godzila, mike waals, zoo zoo, cyber warrior, shafoon, Rehan manzoor<br>cyber gladiator,7he Cre4t0r, Cyber Ace, Golden boy INDIA, Ketan Singh, Yash, Aneesh Dogra, AR AR, saad abbasi, hero, Minhal Mehdi, Raj bhai ji, Hacking queen and rest of TEAM INDISHELL<br>
<font color=white>--==[[Love to]]==--</font><br># My Father, my Ex Teacher, cold fire hacker, Mannu, ViKi, Ashu bhai ji, Soldier Of God, Bhuppi, Gujjar PCP,
Mohit, Ffe, Ashish, Shardhanand, Budhaoo, Jagriti, Salty, Hacker fantastic, Jennifer Arcuri and Don(Deepika kaushik)<br>
       </font>
        </font>
         
        <font  color=#ff9933  size="1"> 
        ##################################################</font><font color=white size="1">###################################################</font><font color=green size="1">##################################################</font>
           </table>
       </table> 

'; 

echo '<div id="left"><div class="main"><table align=center  cellspacing="0" cellpadding="0" style="border-collapse: collapse;border:0px;">
		<tr>
		<form method=post action="'.$_SERVER['SCRIPT_NAME'].'">
		<td align=right style="padding:0px; border:0px; margin:0px;">
				<input type=submit name=home value="Home" class="side-pan">
		</td>
		<td  align=right style="padding:0px; border:0px; margin:0px;" >
				<input type=submit name=load value="Load Remote File" class="side-pan">
		</td>
		</form></tr></table></div></div>
				<div id="right"></div><div align=center>';	

	if(isset($_POST['load']))
{
	
	echo '
   <table width="40%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.6;">
   <tr><td align=center style="padding: 10px;" >
	<form method=post action="'.$_SERVER['SCRIPT_NAME'].'">Specify the Remote file URL: <input type=text style="width:250px;" name=file value=http://remote_server/file.txt><br><br><input type=submit name=read value="load file"></form>

   </td></tr></table>
   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="margin:10px 2px 10px;opacity: 0.6;" >';

}  

if(isset($_POST['read']))
{


$file=strtolower($_POST['file']);
			
if(strstr($file, 'localhost') == false && preg_match('/(^https*:\/\/[^:\/]+)/', $file)==true)
  {
  
	get_contents($file);
  
  }
  elseif(strstr(strtolower($file), 'localhost') == true && preg_match('/(^https*:\/\/[^:\/]+)/', $file)==true) 
	{
		echo '
		<table width="30%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.6;">
						   <tr><td align=center style="padding: 10px;" >
							Dear Nigga, Trying to access Localhost o_0 ? 

						   </td></tr></table>
						   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="margin:10px 2px 10px;opacity: 0.6;" >';
	}

}

?>
