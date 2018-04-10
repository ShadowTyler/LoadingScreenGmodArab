#################################
#                               #
#            README             #
#                               #
#################################

[Requirements]
- Webhosting with FTP access.
- Webhosting with PHP 5+.
- Webhosting with allow_url_fopen enabled.

[Installation]
1. Extract & Upload the files to your desired webhost through a FTP client like FileZilla.

2. Configure your server.cfg file
    - Add: sv_loadingurl "http://your-website-goes-here.com/BinLoad/?steamid=%s"

3. Go to: http://your-website-goes-here.com/BinLoad/login.php
    - Login with the default password: admin
    - Change your password and configure your loading screen to your liking.

4. Restart your server and try to join your server and enjoy your new loading screen.


[Issues with saving?]
- Set your file permissions for all files in the settings/ folder to: 655


[Support]
If you need any support you can add me to Discord: Bin4ry#2388