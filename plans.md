1. Use docker for all services
    List of needed containers :
    1. Just web server (done with nginx and php-fpm) (php building from ground because this is how it was in tutorial ¯\\_(ツ)_/¯(maybe will fix that later because of LONG time of building))
    2. Db server (MySql 5.7.22)
    3. Web server proxy (usefull for fast switching of server and servial instances with different branches) 
    4. Mail server (not needed using mailgun`s servers)
2. Transition to Google Cloud (or another cloud provider) (after making containers!!!!!!!!!!)
3. Make unitfied system of messages on site  
Thats all for now!
One-click actions for emails ? (https://developers.google.com/gmail/markup/reference/one-click-action)
Update log structure with https://www.rapid7.com/products/insightops/ 