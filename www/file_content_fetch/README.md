#   Application code fetch and disply the content of the specified file (file_get_contents.php)

<b>Exploitation Difficulty : Easy</b><br>
This is the simple example of Server-Side Request Forgery (SSRF) attack exploitation. Application code do not has any check for user input data and process it.

<b>Issue observation and exploitation scenario</b><br>In programming language, there are functions which can fetch the content of locally saved file. These functions may be capable of fetching the content from remote URLs as well (file_get_contents in PHP).
This technique works if application is not prepending any string to the user supplied data to fetch the content from a file i.e 
application is not prepeding and directory name or path to the user supplied data. 
In this case, application data fetching function process the schemes like "http://" or "file://". 
When user will specify the remote URL in place of file name like "http://localhost", data fetching function extract the data from the specified URL.

If application is prepending any data string (for example any directory name) to user data, in that case "http://" or "file://" scheme won't 
work and SSRF vulnerability exploitation is not possible.


<b>Vulnerable Script exploitation</b><br>
In this example, application has functionality to fetch and display the content of the file. 
Application has file "local.txt" hosted in the same directory where SSRF vulnerable code is hosted.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/file_content_fetch/images/file1.png?raw=true)

When user try to read the content of file saved on server, vulnerable code just check if file exist on server or not and display the content if file is present on server.

Application is displaying the content of the file "local.txt"
![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/file_content_fetch/images/file2.png?raw=true)

Vulnerable code allow user to use "file://" scheme as well. For example, user can read file like "/etc/passwd" (Linux server) or "c:/windows/system32/drivers/etc/hosts" (in Windows server).

Accessing Windows machine "host" entry file

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/file_content_fetch/images/file3.png?raw=true)

Vulnerable code allowed user to access the content of "host" file

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/file_content_fetch/images/file4.png?raw=true)


<h4><b>Accessing the internal server URLs</b></h4>

An attacker can exploit the vulnerable code not just to read the local file but can access the web application hosted on internal environment (in this case "localhost")

User specified the URL "http://localhost/box.txt" which point to the file "box.txt" hosted on the local server.

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/file_content_fetch/images/file5.png?raw=true)

Vulnerable code allowed user to access the HTTP content of the URL "http://localhost/box.txt"

![](https://github.com/incredibleindishell/SSRF_Vulnerable_lab/blob/master/www/file_content_fetch/images/file6.png?raw=true)

./Thanks
