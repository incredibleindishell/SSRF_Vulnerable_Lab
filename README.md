# Server-Side Request Forgery (SSRF) vulnerable Lab
This repository contain PHP codes which are vulnerable to Server-Side Request Forgery (SSRF) attack.

I would like to say Thank You to @albinowax, AKReddy, Vivek Sir (For being great personalities who always supported me), Andrew Sir - @vanderaj (for his encouraging words) and those researchers who contirubuted in DNS rebinding attack based research 

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/images/ssrf_lab.gif?raw=true)

Vulnerable codes are meant to demonstrate SSRF for below mentioned 5 scenarios:

<b> 1. Application code fetch and disply the content of the specified file</b>

In programming language, there are functions which can fetch the content of locally saved file. These functions may be capable of fetching the content from remote URLs as well local files (file_get_contents in PHP).

This functionality can be abused if application is not prepending any string to the user supplied data to fetch the content from a file i.e application is not prepeding and directory name or path to the user supplied data. 

In this case, application data fetching function process the schemes like "http://" or "file://". When user will specify the remote URL in place of file name like "http://localhost", data fetching function extract the data from the specified URL.

If application is prepending any data string (for example any directory name) to user data, in that case "http://" or "file://" scheme won't work and SSRF vulnerability exploitation is not possible.

<a href="https://github.com/incredibleindishell/SSRF_Vulnerable_lab/tree/master/file_content_fetch">Guide to Exploitation of Scenario 1</a>

<b> 2. Application provide interface to connect to Remote Host</b>

Web application has interface allow an user to specify the any IP with any port. Here application may have functionality like, it try to connect to service like "MySQL", "LDAP" etc.

Application expect user to specify the remote server hostname/IP, username and password in input fields. Application try to connect to the remote server over specified port. Here, application try to communicate to remote service listening on specific port. When vulnerable code has functionality to connect to server like MySQL and user specified the SMB port, vulnerable application will try to communicate to SMB servie using MySQL server service packets. Now, port is open, but services are not able to communicate due to difference in way of communication.

This behaviour can be exploited to perform internal network scanning not just to enumerate IPs but Ports as well on those live IPs.

<a href="https://github.com/incredibleindishell/SSRF_Vulnerable_lab/tree/master/Remote_host_connect_interface">Guide to Exploitation of Scenario 2</a>

<b> 3. Application has File Download Functionality</b>

In this case, an attacker can exploit this functionality to perform IP scanning inside the network where application server is hosted.
The function which performs the task of downloding file from server, can download file not just from local server but also from SMB path as well. This is something which can help an attacker to figureout the windows based machines in the network.

Web application hosted on Windows OS will process the SMB path as well if file download functionality is processing user input without prepending any data.

<a href="https://github.com/incredibleindishell/SSRF_Vulnerable_lab/tree/master/File_Download">Guide to Exploitation of Scenario 3</a>

<b> 4. Bypassing IP blacklisting using DNS Based Spoofing</b>

The script has funcionality which allow user to fetch data from remote URL. User need to specify the remote URL with any IP or domain name.

The script perform check if user has specified the input as "localhost", "Internal IPs" or "Reserved IPs". If domain/IP spcified by user is blacklisted, script will not fetch the content and stop processing. 

<a href="https://github.com/incredibleindishell/SSRF_Vulnerable_lab/tree/master/DNS-Spoofing-based-Bypass">Guide to Exploitation of Scenario 4</a>

<b> 5. Bypassing IP blacklisting using DNS Rebinding Technique</b>

Application has implemented black listing of not just internal and private range IPs but also rsolve the user supplied domain to its IP and again perform check if resolved is black listed or not.

In this case, DNS based spoofing trick will also not work to access the content hosted on internal/Reserved IP. Application code perform domain resolution to its IP and again perform black listed IP check for the resolved IP. 

<a href="https://github.com/incredibleindishell/SSRF_Vulnerable_lab/tree/master/DNS%20Rebinding%20based%20Bypass">Guide to Exploitation of Scenario 5</a>


Ofcourse,<br><b>--==[[ With Love From IndiShell ]]==--</b> <img src="https://web.archive.org/web/20140704135452/freesmileys.org/smileys/smiley-flag010.gif">



--==[[ Greetz To ]]==--

	Guru ji zero, Code breaker ICA, root_devil, google_warrior, INX_r0ot, Darkwolf indishell, Baba,
	Silent poison India, Magnum sniper, ethicalnoob Indishell, Reborn India, L0rd Crus4d3r, cool toad,
	Hackuin, Alicks, mike waals, cyber gladiator, Cyber Ace, Golden boy INDIA, d3, rafay baloch, nag256
	Ketan Singh, AR AR, saad abbasi, Minhal Mehdi, Raj bhai ji, Hacking queen, lovetherisk, D2, Bikash Dash and rest of the Team INDISHELL

--==[[Love to]]==--

	My Father, my Ex Teacher, cold fire hacker, Mannu, ViKi, Ashu bhai ji, Soldier Of God, Bhuppi, Gujjar PCP
	Mohit, Ffe, Shardhanand, Budhaoo, Jagriti, Hacker fantastic, Jennifer Arcuri, Thecolonial, Anurag Bhai Ji and Don(Deepika kaushik)

