<?php

// Extends to class Database
// Only Protected methods
// Only interats with 'Users/Cheat/Invites' tables

// ** Every block should be wrapped in Session::isAdmin(); check **

require_once SITE_ROOT . '/app/core/Database.php';

class Admin extends Database
{
    // Get array of all users
    // - includes hashed passwords too.
    protected function UserArray()
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT * FROM `users` ORDER BY uid ASC');
            $this->statement->execute();

            $result = $this->statement->fetchAll();
            return $result;
        }
    }

    protected function updatenews($news)
    {
        if (Session::isAdmin()) {
            $this->prepare('UPDATE `cheat` SET `news` = ? ');
            $this->statement->execute([$news]);
        }
    }
    protected function pwreset($hashedPassword, $username)
    {
        if (Session::isAdmin()) {
            $this->prepare(
                'UPDATE `users` SET `password` = ? WHERE `username` = ?'
            );
            $this->statement->execute([$hashedPassword, $username]);
            return true;
        }
    }

    protected function subgift($name, $sub, $time)
    {
        if (Session::isAdmin()) {
            if ($sub <= 0) {
                if ($time === 'LT') {
                    $time = '9000';
                }
                if ($time === 'T') {
                    $time = '3';
                }
                if ($time === '-') {
                    return false;
                }

                $date = new DateTime(); // Get current date
                $days = 'P' . $time . 'D';
                $date->add(new DateInterval($days)); // Adds custom days
                $subTime = $date->format('Y-m-d'); // Format Year-Month-Day

                $this->prepare(
                    'UPDATE `users` SET `sub` = ? WHERE  `username` = ?'
                );
                $this->statement->execute([$subTime, $name]);
            } else {
                if ($time === '-') {
                    $this->prepare(
                        'UPDATE `users` SET `sub` = NULL WHERE  `username` = ?'
                    );
                    $this->statement->execute([$name]);
                } else {
                    if ($time === 'LT') {
                        $time = '9000';
                    }
                    if ($time === 'T') {
                        $time = '3';
                    }

                    $this->prepare(
                        'SELECT `sub` FROM `users` WHERE `username` = ?'
                    );
                    $this->statement->execute([$name]);
                    $date = $this->statement->fetch();
                    $date1 = date_create($date->sub);
                    $days = 'P' . $time . 'D';
                    $date1->add(new DateInterval($days));
                    $subTime = $date1->format('Y-m-d'); // Format Year-Month-Day

                    $this->prepare(
                        'UPDATE `users` SET `sub` = ? WHERE  `username` = ?'
                    );
                    $this->statement->execute([$subTime, $name]);
                }
            }
        }
    }

    protected function checksubbyun($name)
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT `sub` FROM `users` where `username` = ?');
            $this->statement->execute([$name]);
            $result = $this->statement->fetch();

            return $result->sub;
        }
    }

    // Get array of all invite codes
    protected function invCodeArray()
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT * FROM `invites`');
            $this->statement->execute();

            $result = $this->statement->fetchAll();
            return $result;
        }
    }

    // Create invite code
    protected function invCodeGen($code, $createdBy)
    {
        if (Session::isAdmin()) {
            $this->prepare(
                'INSERT INTO `invites` (`code`, `createdBy`) VALUES (?, ?)'
            );
            $this->statement->execute([$code, $createdBy]);
        }
    }

    // Get array of all subscription codes
    protected function subCodeArray()
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT * FROM `subscription`');
            $this->statement->execute();

            $result = $this->statement->fetchAll();
            return $result;
        }
    }

    // Create subscription code
    protected function subCodeGen($code, $createdBy)
    {
        if (Session::isAdmin()) {
            $this->prepare(
                'INSERT INTO `subscription` (`code`, `createdBy`) VALUES (?, ?)'
            );
            $this->statement->execute([$code, $createdBy]);
        }
    }

    // Resets HWID
    protected function HWID($uid)
    {
        if (Session::isAdmin()) {
            $this->prepare('UPDATE `users` SET `hwid` = NULL WHERE `uid` = ?');
            $this->statement->execute([$uid]);
        }
    }

    // Set user ban / unban
    protected function banned($uid)
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT `banned` FROM `users` WHERE `uid` = ?');
            $this->statement->execute([$uid]);
            $result = $this->statement->fetch();

            if ((int) $result->banned === 0) {
                $this->prepare(
                    'UPDATE `users` SET `banned` = 1 WHERE `uid` = ?'
                );
                $this->statement->execute([$uid]);
            } else {
                $this->prepare(
                    'UPDATE `users` SET `banned` = 0 WHERE `uid` = ?'
                );
                $this->statement->execute([$uid]);
            }
        }
    }

    // Set user admin / non admin
    protected function administrator($uid)
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT `admin` FROM `users` WHERE `uid` = ?');
            $this->statement->execute([$uid]);
            $result = $this->statement->fetch();

            if ((int) $result->admin === 0) {
                $this->prepare(
                    'UPDATE `users` SET `admin` = 1 WHERE `uid` = ?'
                );
                $this->statement->execute([$uid]);
            } else {
                $this->prepare(
                    'UPDATE `users` SET `admin` = 0 WHERE `uid` = ?'
                );
                $this->statement->execute([$uid]);
            }
        }
    }

    //
    protected function cheatStatus()
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT `status` FROM `cheat`');
            $this->statement->execute();
            $result = $this->statement->fetch();

            if ((int) $result->status === 0) {
                $this->prepare('UPDATE `cheat` SET `status` = 1');
                $this->statement->execute();
            } else {
                $this->prepare('UPDATE `cheat` SET `status` = 0');
                $this->statement->execute();
            }
        }
    }

    //
    protected function cheatMaint()
    {
        if (Session::isAdmin()) {
            $this->prepare('SELECT `maintenance` FROM `cheat`');
            $this->statement->execute();
            $result = $this->statement->fetch();

            if ((int) $result->maintenance === 0) {
                $this->prepare('UPDATE `cheat` SET `maintenance` = 1');
                $this->statement->execute();
            } else {
                $this->prepare('UPDATE `cheat` SET `maintenance` = 0');
                $this->statement->execute();
            }
        }
    }

    //
    protected function cheatVersion($ver)
    {
        if (Session::isAdmin()) {
            $this->prepare('UPDATE `cheat` SET `version` = ?');
            $this->statement->execute([$ver]);
        }
    }
}
