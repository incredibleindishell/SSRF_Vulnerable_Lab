# SSRF in File Download Functionality 

<b>Diffeculty Level: Easy</b>

Web application has file download functionality which expect file name as user input. Application process the file name specified by the user and search it in the internal directory. Application fecth the content of the file and prompt user with file download message box.

<h4><b>Issue observation and exploitation scenario</b></h4>
 In this case, an attacker can exploit this functionality to perform IP scanning inside the network where application server is hosted. 

The function which performs the task of downloding file from server, can download file not just from local server but also from <b>SMB</b> path as well. This is something which can help an attacker to figureout the windows based machines in the network. 

Web application hosted on Windows OS will process the SMB path as well if file download functionality is processing user input without prepending any data.

There will be three possible observations in this case:
    
    1). Live IP with open SMB port
    2). IP is live but port is closed
    3). IP itself is not live

<b>Live IP with open SMB port</b> In this case, web application will try to access the default admin share "IPC$" via SMB and remote server will ask for credentials. As application triggered request without credendials, remote IP will stop processing the file download request and web application will return HTTP response in some specific time period. Note the HTTP response time.

<b>IP is live but port is not closed</b> In this case, web application will try to access the port of the IP. Here, IP is live but port is not open. Web application will try to establish connection to the closed port which result in rises of "Connection Refused" error message. For this situation, web application will return HTTP response in some specific time period. Note the HTTP response time. The response time period will be more than the time period from above case. 

<b>IP itself is not live</b> In this case, web application will try to establish communication to the IP which is not live. Here, IP itself is not live. Web application will try to establish communication to the IP which result in rises of "Host has failed to respond" error message. For this situation, web application will have take huge time to respond. This behavior will indicate that remote IP is not live

<b>How to figureout the time difference for different-2 test case</b>

To get the time difference for the case when IP is live with closed port, try with "Burp Collaborator" server. Collaborator server dont have SMB port open on it. But if application is hosted inside the network which is not allowing routing of SMB traffic outside the network, trick wont work. In this case, try to download "hosts" or "web.config" file from server and get internal IPs.

To get the time difference for the case when IP itself is not live, specify an IP which is not live at all. Note the HTTP response time period and use the observed time value to figureout the dead IPs in your result while perfoming the testing. 

<h4><b>Web application default functionality</b></h4>
Web application has file download functionality which allow user to download file from server. If file is not present, application prompt with error message that "File not found". 

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_1.png?raw=true)

Web browser prompt user with file donwload message box

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_2.png?raw=true)

Confirm whether application is prepending any data to user specified value or not because it is important to perform SSRF exploitation. If application is prepending any data to user input, application will not accept full path to the system internal file and user will not get any file download message box.

To confirm if application is not prepending any data to user input, try to download system file which will be there in Windows machine for sure. One such file is "hosts" inside the diectory "c:/windows/system32/drivers/etc/".

Specified the internal path to file "hosts" in inout field which is "c:/windows/system32/drivers/etc/hosts" and try to download.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_3.png?raw=true)

Application is processing user specified file path and not prepending any data to it.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_4.png?raw=true)

Now, we can go for the exploitation. An attacker can specify the SMB path to internal IP with "IPC$" admin share and random file name inside the share. 

The payload will be like this "\\\\Internal_IP\IPC$\box.txt". 
Specify the SMB path to an IP which has Windows OS runnning on it. In the environment, there was one Windows machine with SMB port open.

<b>Case 1: Live IP with Open SMB port</b>

IP of the machine which is hosted inside the network and has SMB port on it.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_8.png?raw=true)

Web application response time behavior for the case when IP is live and port 445 is open was osbeerved like this

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_9.png?raw=true)

<b>Case 2: IP is Live but port is closed</b>

In network, there may be IPs which are live but SMB port is not live. For those IPs, application response will be different as IP is live but SMB port is not open. Application keep trying to comunicate to the IP on port 445. Due to this process application HTTP response time will be different

There was an IP which is Live and running Linux OS with SMB port closed.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_10.png?raw=true)

Web application response time behavior for the case when IP is live and port 445 is cloased was observed like this

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_11.png?raw=true)


<b>Case 3: IP itself is not live</b>

In network, there may be IPs which are not live. For those IPs, application response will be different as IP is not live and application keep trying to comunicate to the IP. In this case application HTTP response will have huge difference then the one in which IP was live.

There was an IP which as not Live in the environment.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_6.png?raw=true)

Web application response time behavior for the case when IP is not live was observed like this

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/File_Download/images/file_download_7.png?raw=true)

./Thanks
