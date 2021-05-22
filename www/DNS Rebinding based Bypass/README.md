# DNS Rebinding based Bypass 

Exploitation Difficulty : Medium
This is the advanced example of Server-Side Request Forgery (SSRF) attack exploitation. Application code has check for user input data and process if and only domain/IP is not black listed.
Attacker need to bypass this protection via DNS rebinding Attack. 

<h4><b>Issue observation and exploitation scenario</b></h4>
When application has implemented black listing of not just internal and private range IPs but also rsolve the user supplied domain to its IP and again perform check if resolved is black listed or not.

In this case, DNS based spoofing trick will also not work to access the content hosted on internal/Reserved IP. 
Application code perform domain resolution to its IP and again perform black listed IP check for the resolved IP.


<h4><b>Vulnerable Script exploitation</b></h4>
In this example, application has functionality to fetch and display the content of the remotly hosted file. Application has file "box.txt" hosted on internal URL "http://127.0.0.1/box.txt".

<h4><b>Web application default functionality</b></h4>
Application code allow a user to fetch the content of remotly hosted file from an IP or Domain. 

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_1.png?raw=true)

Application perform check if specified domain or IP is in blacklist or not. If Domain is not black listed, application fetch and serve the content of the remote URL.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_2.png?raw=true)

Application do not allow user to fetch the content from Internal/Reserved IP range. When user try to access the files hosted on internal IP, code perform check.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_3.png?raw=true)

Request will net get processed if user specified IP found in blacklist.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_4.png?raw=true)

Application do not relaying on IP based check. It also perform check to which IP user specified Domain name is pointing to.
In this case, Domain name "b0x.mannulinux.org" is pointing to IP "127.0.0.1"
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_5.png?raw=true)

User trying to access the content of the file hosted on URL "127.0.0.1/box.txt" by trying DNS based Spoofing trick and ask application to fetch the content from URL "b0x.mannulinux.org". As, "b0x.mannulinux.org" is pointing to "127.0.0.1", the URL "b0x.mannulinux.org/box.txt" pointing to "127.0.0.1/box.txt"
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_6.png?raw=true)

Application code resolved the user specified Domain name to the IP and blacked the processing because resolved IP is in blacklist. 
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_7.png?raw=true)


<h4><b>DNS Rebind Technique</b></h4>
DNS Rebinding technique is the one in which Web Browser or Web Server is tricked to make request to the already resolved Domain and this time DNS return different IP then the one which was provided previously.
In this attack technique, user bind a Sub-Domain to 2 different IPs or use malicious DNS server which is capable of changing the Domain IP address inbetween 2 different IPs. 

<b>Time To Live (TTL) for a DNS entry</b>

When user specify the web application sub-domain entry, user can specify the "TTL" value atleast 1 minute. This attribute instruct web server or browser that the resolved IP for the Domain will be valid of this time period only and need to make another DNS request when domain need to be accessed. 

Here, attacker will configure the both the IPs of Sub-Domain/Domain with "TTL" 1 minute. Now, DNS will server different-2 IP when web server is going to make request after difference of 1 minute due to the "TTL" and 2 IPs binded to it.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_13.png?raw=true)

This behavior will help in bypassing the security check in the code. Application code has 2 different code sections:
  1) Application first code section is meant for performing the check if IP/Domain is in blacklist or not. If IP or Domain IP resloved, is in blacklist, application will stop the further processing.
  
  2) Second code section is the one which come in action once security check has been passed by IP/Domain. This code section perform the further functionality. In this script, code is fetching the content from the specified URL.
  
 <h4><b>Attack Scenario outline</b></h4>
  
  -> Web application expect user to specify a Domain 
  
 -> User specify the domain which has 2 IPs binded to it in DNS server.
 
 -> Application process the user request and resolve the domain to Blocked IP (127.0.0.1 in this case) and prompt with error message.
 
 -> User keep try to trigger same HTTP request again and again. When TTL expire for the Domain IP, Web server will resolve the IP again.
 
 -> Now, web server will request DNS server to resolve the IP of the domain and this time DNS return different IP which is not blacklisted (8.8.8.8).
 
 -> Security check will get pass and application will continue the process to fetch the content from the specified URL.
 
 -> Data fetching functiona will resolve the IP of the Domain and get the blacklisted IP (127.0.0.1). As now, security check has been passed, application wont stop processing and will fetch the content from the blacklisted IP.
 
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS%20Rebinding%20based%20Bypass/images/DNS_Rebinding_Attack_12.png?raw=true) 

./thanks
