<h1 align="center">:zap: User Management Panel</h1>
<p>
</p>



* Original Panel: https://github.com/znixbtw/php-panel-v2
> Default login: `admin`:`admin` <br />
---

### Overview
<p align="center">
  <img src="https://i.imgur.com/VB2ial8.png" />
</p>

### Features
###### AUTH
* Login (Remember Login) (Screenshot: https://bit.ly/3OYBJqT)
* Register (Invite only / can be deactivated) (Screenshot: https://bit.ly/3NTukIN)
* Banned Page (Screenshot: https://bit.ly/39USjsR)
###### USER
Screenshot: https://bit.ly/3Bl5AX2
* Change password
* Activate multiple subscription´s with code (30/90 days)
* Activate Trail subscription´s with code (3 days)
* Download loader (Needs a sub)
* Set a Profile Picture
### SUPPORTER/ADMINISTRATOR PANEL
Screenshot: https://bit.ly/3cMWNTq / https://bit.ly/3QOaArN
* Disable Invite System (Admin only)
* Freeze all subscriptions (experimental) (Admin only)
* Gift user subscription (Admin only) (Screenshot: https://bit.ly/3nerQcQ) 
  * Input options:
    * `LT for Lifetime`
    * `T for a trail subscription (3 days)`
    * `- to remove a users subscription`
    * `Intager for custom amount in days`
* User-Ranges with buttons in User Table (Screenshot: https://bit.ly/3yxHiHD)
  * Input options:
	  * `1-10 10-20 20-30 30-40 40-50`
	  * `custom`
	  * `ALL`
* View a users last known IP address 
* Password Reset (Admin only)
* Set News
* Ban-Management panel (Admin only) (Screenshot: https://bit.ly/3Nk9jXf / https://bit.ly/3PAtCAR)
* Generate invite code
* Generate subscription code (Admin only)
* Ban/unban user (Admin only)
* Make user admin/non-admin 
* Make user supporter/non-supp 
* Reset HWID
* Set cheat detected/undetected/version/maintenance/non-maintenance  (Admin only)


###### API
###### Note: User pass and hwid has to be sent in base64 format.
* Sends user data in JSON format on call
	* Usage: `api.php?user={username}&pass={password}&hwid={hwid}&key={key}`
	* Example: `api.php?user=admin&pass=YWRtaW4=&hwid=aHdpZA==&key=dmyeXILqwHb4X5r1x7O2wUgsrP9yF1`

---


## Authors

👤 **anditv21**

* Website: [anditv.it](https://anditv.it)
* Github: [@anditv21](https://github.com/anditv21)

👤 **znixbtw**

* Website: [znix.me](https://znix.me)
* Github: [@znixbtw](https://github.com/znixbtw)

👤 **sxck1337**

* Github: [@sxck1337](https://github.com/sxck1337)

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

---

## 🤝 Contributing

Contributions, issues and feature requests are welcome!<br />Feel free to check [issues page](https://github.com/anditv21/znixv2-panel-edit-edit/issues). 

