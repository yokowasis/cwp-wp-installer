# Worpdress Installer, CWP Module
Centos Web Panel Custom Module For Installing Wordpress

##How to install 
Edit this file (if the file doesn't exist, create it)

    /usr/local/cwpsrv/htdocs/resources/client/include/3rdparty.php
    
add this line

    <li><a href="index.php?module=installer_wordpress"><span class="icon16 icomoon-icon-arrow-right-3"></span>Wordpress Installer</a></li>

Download `installer_wordpress.php`
Upload `installer_wordpress` the file in `/usr/local/cwpsrv/htdocs/resources/client/modules`

You can access the module from `Other` Menu in CWP Menu

I am open to suggestion, feel free to pull request if you think you can improve my code.
