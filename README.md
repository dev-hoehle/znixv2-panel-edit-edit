# User Management Panel



### Original Panels:
* Original Panel: https://github.com/znixbtw/php-panel-v2
* Panel Edit: DELETED

> Feature list: https://github.com/znixbtw/php-panel-v2/blob/main/README.md

> Default login: `admin`:`admin`

### Overview
<p align="center">
  <img src="https://i.imgur.com/VB2ial8.png" />
</p>



Changes

###### GENERAL
* Added banned page (Screenshot: https://bit.ly/39USjsR)
* Bug fixes
* some visual changes

###### AUTH
* Added remember Login

###### USER
* Activate multiple subscription´s with code (30/90 days)
* Activate Trail subscription´s with code (3 days)
###### ADMIN PANEL
* Cleaned up
* Added Gift user subscription (Screenshot: https://bit.ly/3nerQcQ)
  * Input options:
    * `LT for Lifetime`
    * `T for a trail subscription (3 days)`
    * `- to remove a users subscription`
    * `Intager for custom amount in days`
* View a users last known IP address 
* Password Reset
* Set News
* Added Ban-Management panel (Screenshot: https://bit.ly/3Nk9jXf / https://bit.ly/3Oxznis)

## Setup ##

- Download The Repository
- Upload all files to your PHP host of choice
- Then copy and paste db.sql into SQL import tab on phpmyadmin
- Change https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Database#L5#L8 to your database credentials
- Rename https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Database to Database.php
- Put your Loader in the main directory of the panel. (x.exe)
- Login with the default credentials
- Change the default password to a secure one
- Set https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Config.php#L8 to your Website name
- Set a website description in https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Config.php#L11
- Change https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Config.php#L26 to a secure API key
