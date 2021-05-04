<?php
/*Coded by Jagriti aka Incredible at indishell Lab*/
session_start();
set_time_limit(0);


 $head = '
<html>
<head>
</script>
<title>--==[[MySQL Connect]]==--</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<STYLE>
body {
background-image: url("http://2.bp.blogspot.com/_pIX0Yrfc96k/TGbCp67f8rI/AAAAAAAADpc/ZYotXRwkT2M/s1600/ind43v.jpg");
background-position: center center;
background-repeat: no-repeat;
background-size: 1000px 500px;
background-color: #000000;
background-attachment: fixed;
font-family: Tahoma;
}
tr {
BORDER: dashed 2px #333;
color: #FFF;
}
td {
BORDER: dashed 2px #333;
color: #FFF;

}

table {
BORDER: dashed 0px #333;
BORDER-COLOR: #333333;
BACKGROUND-COLOR: Black;
color: #FFF;
border-collapse: collapse;
padding: 10px;
}
input {
border : solid 3px ;
border-color : #333;
BACKGROUND-COLOR: white;
font: 11pt Verdana;
color: #333;
}
select {
BORDER-RIGHT:  Black 1px solid;
BORDER-TOP:    #DF0000 1px solid;
BORDER-LEFT:   #DF0000 1px solid;
BORDER-BOTTOM: Black 1px solid;
BORDER-color: #FFF;
BACKGROUND-COLOR: Black;
font: 8pt Verdana;
color: Red;
}
submit {
BORDER:  buttonhighlight 2px outset;
BACKGROUND-COLOR: Black;
width: 30%;
color: #FFF;
}
textarea {
border : dashed 2px #333;
BACKGROUND-COLOR: Black;
font: Fixedsys bold;
color: #999;
}
BODY {
SCROLLBAR-FACE-COLOR: Black; SCROLLBAR-HIGHLIGHT-color: #FFF; SCROLLBAR-SHADOW-color: #FFF; SCROLLBAR-3DLIGHT-color: #FFF; SCROLLBAR-ARROW-COLOR: Black; SCROLLBAR-TRACK-color: #FFF; SCROLLBAR-DARKSHADOW-color: #FFF
margin: 1px;
color: Red;
background-color: Black;
}



</STYLE>
'; ?>
<html>
<head>
<?php 
echo $head ;
echo '

<table width="100%" cellspacing="0" cellpadding="0" class="tb1" >


       <td width="100%" align=center valign="top" rowspan="1">
           <font color=#ff9933 size=5 face="comic sans ms"><b>--==[[ MySQL </font><font color=white size=5 face="comic sans ms"><b> connect </font><font color=green size=5 face="comic sans ms"><b>By IndiShell]]==--</font> <div class="hedr"> 

        <td height="10" align="left" class="td1"></td></tr><tr><td 
        width="100%" align="center" valign="top" rowspan="1"><font 
        color="red" face="comic sans ms"size="1">
        <font  color=#ff9933> 
        ##################################################</font><font color=white>###################################################</font><font color=green>##################################################</font><br><font  color=#ff9933 face="comic sans ms">
        <font 
         color="red" face="comic sans ms"size="1"><br><font color=white >
        --==[[Greetz to]]==--</font><br> <font color=#ff9933>Zero cool, code breaker ica, root_devil, google_warrior, INX_r0ot, Darkwolf indishell, Baba, Silent poison India, Magnum sniper, ethicalnoob Indishell, Local root indishell, Irfninja indishell<br>Reborn India, L0rd Crus4d3r, cool toad, Hackuin, Alicks, Gujjar PCP, Bikash, Dinelson Amine, Th3 D3str0yer, SKSking, rad paul, Godzila, mike waals, zoo zoo, cyber warrior, shafoon, Rehan manzoor<br>cyber gladiator,7he Cre4t0r, Cyber Ace, Golden boy INDIA, Ketan Singh, Yash, Aneesh Dogra, AR AR, saad abbasi, hero, Minhal Mehdi, Raj bhai ji, Hacking queen and rest of TEAM INDISHELL<br>
<font color=white>--==[[Love to]]==--</font><br># My Father, my Ex Teacher, cold fire hacker, Mannu, ViKi, Ashu bhai ji, Soldier Of God, Bhuppi, Gujjar PCP,
Mohit, Ffe, Ashish, Shardhanand, Budhaoo, Jagriti, Salty, Hacker fantastic, Jennifer Arcuri and Don(Deepika kaushik)<br>
       </font>
        </font>
         
        <font  color=#ff9933> 
        ##################################################</font><font color=white>###################################################</font><font color=green>##################################################</font>
           </table>
       </table> 

'; 

?>
<body bgcolor=black><div align=center><br>
<font color=white size=3 style="comic sans ms">
<table width=30% >
<form method=post>
<tr ><td width=50% align=right style="padding: 10px;"> <font color=#ff9933>Remote Host IP: </td><td width=50% align=center> <font color=#ff9933><input type=text name=host value="127.0.0.1"></td></tr>
<tr><td width=50% align=right> <font color=#ff9933>Username: </td><td width=50% align=center> <font color=#ff9933><input type=text name=uname value=root></td></tr>
<tr><td width=50% align=right> <font color=#ff9933>Password: </td><td width=50% align=center> <font color=#ff9933><input type=text name=pass value=admin123></td></tr>


</table>
<br>
<input type=submit name=sbmt value="Chal Billu, Ghuma de soda >:D<">
</form>
<br><br>


<?php
set_time_limit(0);

error_reporting(0);
if(isset($_POST['sbmt']))
{

$host=trim($_POST['host']);
$uname=trim($_POST['uname']);
$pass=trim($_POST['pass']);



$r=mysqli_connect($host,$uname,$pass);

if (mysqli_connect_errno())
  {
  echo  mysqli_connect_error();
  }



}

echo "<br>";
?>

<style type="text/css">#cot_tl_fixed{background-color:black;position:fixed;bottom:0px;font-Asize:50px;left:0px;padding:3px 0;clip:_top:expression(document.documentElement.scrollTop+document.documentElement.clientHeight-this.clientHeight);_left:expression(document.documentElement.scrollLeft + document.documentElement.clientWidth - offsetWidth);}</style>
<span style="color: white;">
<div id="cot_tl_fixed"><marquee>Coded By:- 1046 @ IndiShell Lab</marquee></div></span>

