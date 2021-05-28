# slimframework4
Simple examples to avoid the issue regarding routes in subfolders

While migrating the TestLink (https://github.com/TestLinkOpenSourceTRMS) REST API implementation   
from Slim (https://www.slimframework.com/) version 2 to version 4, I've faced issues due to
choosen the folder structure.

Theoretically I've had sorted out the issue and create some documentation [here](https://fmancardi.wordpress.com/2020/03/15/testlink-slim4-experiences/)  
thinking that it was clear enough.  
But ... I was wrong.  

Meanwhile I've moved my development environment from Mac, to Fedora 32 using Bitnami, the to Windows 10, always back and forth.
When trying to test an improvement to the REST API using Bitnami on Windows, issues remerged.  
The search for a solution started again (and I've forgot my own documentation!!!).  
Someone said that issue does not exist on Linux then I said ' why do not give a try to WSL2? '  
After reading and reading again links here and there, use lot of hours in frustrating failures, I've finally found [this](https://akrabat.com/running-slim-4-in-a-subdirectory/).

I do not like this documents where the only thing you find is information that has been copied AS IS from other references  
then I'll try to avoid this approach.

I'm going to put here some simple and silly examples, hoping it will be of help. 

# examples structure

| folder        |            | 
| ------------- |-------------| 
| /myapp        | the classic Hello World example (copied from Slim site) |
| /one/myapp    | Hello World in subdir |
| /two/one/myapp    | Hello World in two level subdir      |
| /three/two/one/myapp | Hello World in three lesubdir      |

in each myapp folder you will find:  
.htaccess  
index.php  

I've done all tests using apache on Ubuntu 20.04 LTS on WSL2

# Testing with Sublime Text Editor and/or Visual Studio Code  
Using a REST Client add-on / package for these popular editors was the simplest way to use.  
I used RESTer with Sublime Text.  
Test are really silly  

| folder        |            | 
| ------------- |-------------| 
| /myapp        | GET http://\<YOUR IP>/myapp |
| /one/myapp    | GET http://\<YOUR IP>/one/myapp |
| /two/one/myapp    | GET http://\<YOUR IP>/two/one/myapp      |
| /three/two/one/myapp | GET http://\<YOUR IP>/three/two/one/myapp      |

Server version: Apache/2.4.41 (Ubuntu)
Server built:   2020-08-12T19:46:17

# TestLink example

|         |            | 
| ------------- |-------------| 
| server        |  Ubuntu 20.04 on WSL2 |
| webserver    | Apache/2.4.41 (Ubuntu) built: 2020-08-12T19:46:17|
| installation folder    | /var/www/html/tl      |

## .htaccess example  
RewriteEngine On  
**RewriteBase /tl/lib/api/rest/v3**  
RewriteCond %{REQUEST_FILENAME} !-f  
RewriteRule ^ index.php [QSA,L]  

## index.php excerpt  
...  
require 'RestApi.class.php';

$app = AppFactory::create();  
**$basePath = "/tl/lib/api/rest/v3";**  
**$app->setBasePath($basePath);**  
$app->restApi = new RestApi();  
...

# References
https://akrabat.com/running-slim-4-in-a-subdirectory/  
https://fmancardi.wordpress.com/2020/03/15/testlink-slim4-experiences/  
https://www.slimframework.com/docs/v4/start/web-servers.html#run-from-a-sub-directory  






