# DNS Based Spoofing (dns-spoofing.php)
  
The script has funcionality which allow user to fetch data from remote URL. User need to specify the remote URL with any IP or domain name.
  
  ![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%201.png?raw=true)
  
This script perform check if user has specified the input as "localhost", "Internal IPs" or "Reserved IPs". If domain/IP spcified by user is blacklisted, script will not fetch the content and stop processing.

<h4><b>Fetching data from remote domain</b></h4>

In below example, user spcified the remote application URL as "https://www.google.com" and script fetched the data from the URL.

 ![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%202.png?raw=true)
 
 <h4><b>Script behavior when user try to access blacklisted IP</b></h4>
  
  We have a file "box.txt" hosted on local server where script is hosted and URL is "http://127.0.0.1/box.txt"
  
  ![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%203.png?raw=true)
 
  Now, when a user try to access the file "box.txt" by specifying the URL to local IP, script perform check and block it.
  
  ![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%204.png?raw=true)
 
 Or when user try to access reserved IPs, script will block them too.
 
 ![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%205.png?raw=true)
 
 In this case, malicious user can use "DNS Based spoofing" to bind internal IP with a domain name. In DNS server, malicious user need to point the domain name to the IP which is blacklisted.
 
 For example, in this case user is trying to access the internal IP "127.0.0.1" and reserved IP "169.254.169.254". I created 2 enteries for the these 2 IPs and pointed the domain name "b0x.mannulinux.org", "gcp.mannulinux.org" to "internal IP" and "reserved IP" respectively.
 
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%206.png?raw=true)
 
In above example, nslookup command is showing that domain "box.mannulinux.org" is pointing to IP "127.0.0.1". 

Now, attacker can trick script to access locally hosted file "box.txt" by specifying the URL like "http://b0x.mannulinux.org/box.txt".
When script will perform check, domain "box.mannulinux.org" is not part of blacklist and will proceed for fetching content of the file "box.txt" from from domain "b0x.mannulinux.org".

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/DNS-Spoofing-based-Bypass/images/dns%20spoofing%207.png?raw=true)
 
This is how an attacker can bypass the weakly implemented Domain/IP blacklisting.

./Thanks 
