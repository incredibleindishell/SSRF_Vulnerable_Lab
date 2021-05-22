# Application provide interface to connect to Remote Host

<b>Exploitation Difficulty : Easy</b><br>
This is the simple level Server-Side Request Forgery (SSRF) vulnerability scenario. In such type of case, application will have interface which allow user to specify the remote hostname/IP.


<b>Issue observation and exploitation scenario</b><br>
Web application has interface allow an user to specify the any IP with any port. Here application may have functionality like, it try to connect to service like "MySQL", "LDAP" etc.

Application expect user to specify the remote server hostname/IP, username and password in  input fields. Application try to connect to the remote server over specified port.
Here, application try to communicate to remote service listening on specific port. 
When vulnerable code has functionality to connect to server like MySQL and user specified the SMB port, vulnerable application will try to communicate to SMB servie using MySQL server service packets.
Now, port is open, but services are not able to communicate due to difference in way of communication. 

This behaviour can be exploited to perform internal network scanning not just to enumerate IPs but Ports as well on those live IPs.

In this example, script try to connect to remote SQL server. 

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_1.png?raw=true)

Following 3 type of behavior will be obsered in this case whicn are following:

1)	If remote IP is not having port open, script shows error message "No connection could be made because the target machine actively refused it".
2)	If remote IP is having port open on it but SQL server is not listening on it, script shows error message "SQL server has gone away".
3)	If remote IP does not exist, script throws error message "A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond." 

<b>Case 1: IP is live and Port is open</b>

In this case, remote IP is up and port is open. So when application try to communicate to the service on the remote IP port, application script feels that Port is open but service is not responding. Due to this observation, application script trigger message such as "Service has gone down".

Specified the SMB port along local IP

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_2.png?raw=true)

Application vulnerable code response will print message "Service Gone" which indicate "SMB" port was open on local machine.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_3.png?raw=true)

<b>Case 2: IP is live and Port is Closed</b>

In this case, remote IP is up but port is closed. So when application try to communicate to the service on the remote IP port, application script keep trying to connect to the port, take much time and finally connection timeout happens. Due to this observation, application script print message like "Connection refused".

Specified the random port which is not open along local IP

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_4.png?raw=true)

Application vulnerable code response indicate that random port was not open on local machine.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_5.png?raw=true)

<b>Case 3: IP is not live </b>

In this case, remote IP itself is not live. So when application try to communicate to the service on the remote IP port, application script keep trying to  establish connection to remote IP, take more time  than case 2 and finally connection timeout happens. Due to this observation, application script print message like "Third party not responding" which indicate that IP is not live.

Specified the SMB port along remote IP which is not live on network

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_6.png?raw=true)

Application vulnerable code response indicate that Remote IP is not live.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/Remote_host_connect_interface/images/MySQL_Connect_7.png?raw=true)

./Thanks

