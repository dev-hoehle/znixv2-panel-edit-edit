# User Management Panel



### Original Panels:
* Original Panel: https://github.com/znixbtw/php-panel-v2
* Original Panel Edit: https://github.com/sxck1337/znixv2-panel-edit



> Default login: `admin`:`admin`

### Overview
<p align="center">
  <img src="https://i.imgur.com/VB2ial8.png" />
</p>



Changes
###### AUTH
* Added remember Login

###### USER
* Activate multiple subscription´s with code (30/90 days)
* Activate Trail subscription´s with code (3 days)
###### ADMIN PANEL
* Cleaned up
* Added Gift user subscription
  * Input options:
    * `LT for Lifetime`
    * `T for a trail subscription (3 days)`
    * `- to remove a users subscription`
    * `Intager for custom amount in days`
* View a users last known IP address
* Password Reset
* Set News

## Setup ##

- Download The Repository
- Upload all files to your PHP host of choice
- Then copy and paste db.sql into SQL import tab on phpmyadmin
- Change https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Database#L5#L8 to your database credentials
- Rename https://github.com/anditv21/znixv2-panel-edit-edit/blob/main/app/core/Database to Database.php
