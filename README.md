# Crypto Market Cap - An open source Cryptocurrency Market website.
<p>by Webberdoo.co.uk</p>

<p>Made with the Symfony 3 framework. And imports crypto currency data from the Coin Market Cap api</p>

<p>View <a href="http://webberdoo.co.uk/demo/cm/" target="_blank">Demo</a></p>

## Getting Started
1. clone or download and then cd into main folder 'crypto-market-cap-master'.
2. then install dependencies by entering 'composer install'.
3. go to crypto-market-cap-master > app > config > parameters.yml and add you database details in the relevant fields.
4. Change name of the folder if you like and upload folder to your web server.
5. visit http://YOURWEBTE.COM/FOLDER-NAME/install or http://YOURWEBTE.COM/install (depending on where you have uploaded the folder).
6. Click on the buttons to install database tables and admin detailsb, in order.
7. visit /admin (login details: admin/admin )
8. Import crypto currency data from coin market cap by going to the Currency section and click on import.
9. you are done

To add pages go to the Page section and to change your admin password go to the User section.

The script uses cron jobs to sync with the coin market cap api. Create a cron job in your cPanel (assuming you are using cPanel, if not create a cron job in whatever hosting
panel you are using) and enter the following command:

/opt/php71/bin/php -q /home/USERNAME/public_html/SCRIPT-FOLDER/bin/console webberdoo:crypto_command

Replace 'USERNAME' and 'SCRIPT-FOLDER' with your username and name of folder (if any) or remove 'SCRIPT-FOLDER' if you install in the root. You might have to change the first part of the command to php with your own php path.
Set the cron job to run every 6 minutes.

## Requirements
PHP 7.1 or higher
<br>1 Database
