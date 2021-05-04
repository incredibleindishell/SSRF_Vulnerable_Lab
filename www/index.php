<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<STYLE>
BODY {
color: #ffffff;
background-color: #000000;
background-image: url(images/matrix2.gif);
background-repeat: repeat;
}

#title {
    font-size: 2em;
    padding-top: 5px;
	font-family: consolas, georgia, helvetica, times new roman, serif;
}


tr {
border-collapse: collapse;
}

td {
font-family: consolas, georgia, helvetica, times new roman, serif;
border-collapse: collapse;
}

table {
		margin-left:auto;
		margin-right:auto;
		BORDER: dashed 2px #333;
		BORDER-COLOR: #333333;
		BACKGROUND-COLOR: #191919;;
		color: #FFF;
}

A:link {
border: 1px;
	COLOR: red; TEXT-DECORATION: none
}
A:visited {
	COLOR: red; TEXT-DECORATION: none
}
A:hover {
	color: #97c3f5; TEXT-DECORATION: none
}
A:active {
	color: ; TEXT-DECORATION: none
}
</STYLE>

<script type="text/javascript">

    function lhook(id) {

       var e = document.getElementById(id);

       if(e.style.display == 'block')

          e.style.display = 'none';

       else

          e.style.display = 'block';

    }
</script>

		
<div id="title" align=center>--==[[ Welcome to the SSRF Vulnerable Lab ]]==--</div>
<br>
Exercises:
<br>
<table width="90%"><tr><td>
<b><font color=#ff9933 size="3">1. Application code fetch and disply the content of the specified file: -</font></b></td></tr>
<tr><td style="background-color: #343440;">
<div align=center>--== <a href="#" onclick="lhook('info1');" style="border:1px;background:black;">Show Misconfiguration Info</a> ==--
</div>

<div id="info1" style="display:none;">
In programming language, there are functions which can fetch the content of locally saved file. These functions may be capable of fetching the content from remote URLs as well local files (file_get_contents in PHP). 
<br><br>This functionality can be abused if application is not prepending any string to the user supplied data to fetch the content from a file i.e application is not prepeding and directory name or path to the user supplied data. In this case, application data fetching function process the schemes like "http://" or "file://". When user will specify the remote URL in place of file name like "http://localhost", data fetching function extract the data from the specified URL.
<br>If application is prepending any data string (for example any directory name) to user data, in that case "http://" or "file://" scheme won't work and SSRF vulnerability exploitation is not possible.</div></td></tr>
<tr><td>Link to Vulnerable Script - <a href="file_get_content.php" target="_blank">file_get_content.php</a></td></tr></table>
<br><br>
<table  width="90%" >
<tr><td>
<b><font color=#ff9933 size="3">2. Application provide interface to connect to Remote Host : -</font></b> </td></tr>
<tr><td style="background-color: #343440; ">
<div align=center>--== <a href="#" onclick="lhook('info2');" style="border:1px;background:black;">Show Misconfiguration Info</a> ==--
</div>

<div id="info2" style="display:none;">
Web application has interface allow an user to specify the any IP with any port. Here application may have functionality like, it try to connect to service like "MySQL", "LDAP" etc.
<br><br>
Application expect user to specify the remote server hostname/IP, username and password in input fields. Application try to connect to the remote server over specified port. Here, application try to communicate to remote service listening on specific port. When vulnerable code has functionality to connect to server like MySQL and user specified the SMB port, vulnerable application will try to communicate to SMB servie using MySQL server service packets. Now, port is open, but services are not able to communicate due to difference in way of communication.
<br><br>
This behaviour can be exploited to perform internal network scanning not just to enumerate IPs but Ports as well on those live IPs.
</div>
</td></tr>
<tr><td>
Link to Vulnerable Script - <a href="sql_connect.php" target="_blank">sql_connect.php</a></td></tr></table>
<br><br>
<table  width="90%">
<tr><td>
<b><font color=#ff9933 size="3">3. Application has File Download Functionality: -</font></b> </td></tr>
<tr><td style="background-color: #343440;"> 
<div align=center>--== <a href="#" onclick="lhook('info3');" style="border:1px;background:black;">Show Misconfiguration Info</a> ==--
</div>

<div id="info3" style="display:none;">
In this case, an attacker can exploit this functionality to perform IP scanning inside the network where application server is hosted.
<br>The function which performs the task of downloding file from server, can download file not just from local server but also from SMB path as well. This is something which can help an attacker to figureout the windows based machines in the network.
<br><br>
Web application hosted on Windows OS will process the SMB path as well if file download functionality is processing user input without prepending any data.</div></td></tr>
<tr><td>Link to Vulnerable Script - <a href="download.php" target="_blank">download.php</a>
</td></tr></table>  
<br><br>
<table width="90%"><tr><td>
<b><font color=#ff9933 size="3">4. Bypassing IP blacklisting using DNS Based Spoofing: -</font></b></td></tr>
<tr><td style="background-color: #343440;">
<div align=center>--== <a href="#" onclick="lhook('info4');" style="border:1px;background:black;">Show Misconfiguration Info</a> ==--
</div>

<div id="info4" style="display:none;">
The script has funcionality which allow user to fetch data from remote URL. User need to specify the remote URL with any IP or domain name.
<br><br>
This script perform check if user has specified the input as "localhost", "Internal IPs" or "Reserved IPs". If domain/IP spcified by user is blacklisted, script will not fetch the content and stop processing.
</div></td></tr>
<tr><td>Link to Vulnerable Script - <a href="dns-spoofing.php" target="_blank">dns-spoofing.php</a></td></tr></table>
<br><br>

<table width="90%"><tr><td>
<b><font color=#ff9933 size="3">5. Bypassing IP blacklisting using DNS Rebinding Technique: -</font></b></td></tr>
<tr><td style="background-color: #343440;">
<div align=center>--== <a href="#" onclick="lhook('info5');" style="border:1px;background:black;">Show Misconfiguration Info</a> ==--
</div>

<div id="info5" style="display:none;">
Application has implemented black listing of not just internal and private range IPs but also rsolve the user supplied domain to its IP and again perform check if resolved is black listed or not.<br> <br>
In this case, DNS based spoofing trick will also not work to access the content hosted on internal/Reserved IP. Application code perform domain resolution to its IP and again perform black listed IP check for the resolved IP.
</div></td></tr>
<tr><td>Link to Vulnerable Script - <a href="dns_rebinding.php" target="_blank">dns_rebinding.php</a></td></tr></table>


<br><br>
<table width="90%"><tr><td>
<b><font color=#ff9933 size="3">6. SSRF in HTML to PDF generator: -</font></b></td></tr>
<tr><td style="background-color: #343440;">
<div align=center>--== <a href="#" onclick="lhook('info6');" style="border:1px;background:black;">Show Misconfiguration Info</a> ==--
</div>


<div id="info6" style="display:none;">
This the scenario of the web app which is using HTML to PDF generator script and passing untrusted user supplied data to HTML file which is processed by HTML to PDF generator. 
An attacker can pass the HTML tags such as &#x3C;iframe&#x3E;, &#x3C;a&#x3E;, &#x3C;img&#x3E; or HTML forms to make request to internally hosted application. 	
</div></td></tr>
<tr><td>Link to Vulnerable Script 1 - <a href="pdf_ssrf_weasyprint.php" target="_blank">pdf_ssrf_weasyprint.php</a><br>Link to Vulnerable Script 2 - <a href="pdf_ssrf_wkhtmltopdf.php" target="_blank">pdf_ssrf_wkhtmltopdf.php</a></td></tr></table>
