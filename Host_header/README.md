


<h3>1. Install NGINX web server in Ubuntu machine:</h3>

      apt-get install nginx

<h3>2. Replace the content of below mentioned file with this <a href="https://raw.githubusercontent.com/incredibleindishell/SSRF_Vulnerable_Lab/master/Host_header/default">NGINX web server Default file</a>:</h3>


      /etc/nginx/site-available/default

<img src="https://github.com/incredibleindishell/SSRF_Vulnerable_Lab/raw/master/Host_header/images/Nginx_config.png"/>

<h3>3. Reload NGINX web server using below mentioned command:</h3>

      service nginx reload

<h3>4. Server-side request forgery exploitation:</h3>

In Burp suite, send request to repeater tab and click `Send` button:

<img src="https://raw.githubusercontent.com/incredibleindishell/SSRF_Vulnerable_Lab/master/Host_header/images/actual_request.png" />

Now, when we change the value of `Host` header with some other hostname/IP (192.168.56.104 in this case), web proxy server makes HTTP request to that host and returns HTTP response from that host: 

<img src="https://raw.githubusercontent.com/incredibleindishell/SSRF_Vulnerable_Lab/master/Host_header/images/SSRF.png" />
