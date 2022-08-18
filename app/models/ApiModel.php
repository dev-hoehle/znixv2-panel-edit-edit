<?php

// Extends to class Database
// Only Protected methods
// * Interats with all tables *

require_once SITE_ROOT . '/app/core/Database.php';

class API extends Database
{
    protected function userAPI($username, $password, $hwid)
    {

        // fetch username
        $this->prepare('SELECT * FROM `users` WHERE `username` = ?');
        $this->statement->execute([$username]);
        $row = $this->statement->fetch();

        // If username is correct
        if ($row) {
            $hashedPassword = $row->password;

            // If password is correct
            if (password_verify($password, $hashedPassword)) {
                if ($row->hwid === null) {
                    $this->prepare(
                        'UPDATE `users` SET `hwid` = ? WHERE `username` = ?'
                    );
                    $this->statement->execute([$hwid, $username]);
                }

                $uid = $row->uid;
                $path = IMG_DIR . $uid;
                if (@getimagesize($path . ".png")) {
                    $avatarurl = IMG_URL . $uid. ".png";
                } elseif (@getimagesize($path . ".jpg")) {
                    $avatarurl = IMG_URL . $uid . ".jpg";
                } elseif (@getimagesize($path . ".gif")) {
                    $avatarurl = IMG_URL . $uid . ".gif";
                } else {
                    $avatarurl = SITE_URL . SUB_DIR ."/assets/img/avatars/Portrait_Placeholder.png";
                }

                $response = [
                    'status' => 'success',
                    'uid' => $row->uid,
                    'username' => $row->username,
                    'hwid' => $row->hwid,
                    'admin' => $row->admin,
                    'supp' => $row->supp,
                    'sub' => $row->sub,
                    'banned' => $row->banned,
                    'invitedBy' => $row->invitedBy,
                    'createdAt' => $row->createdAt,
                    'avatarurl' => $avatarurl,
                ];
            } else {
                // Wrong pass, user exists
                $response = [
                    'status' => 'failed',
                    'error' => 'Invalid password',
                ];
            }
        } else {
            // Wrong username, user doesnt exists
            $response = ['status' => 'failed', 'error' => 'Invalid username'];
        }

        return $response;
    }
}
