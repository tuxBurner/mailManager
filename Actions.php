<?php

class Actions
{

    const SELECT_DOMAIN = 'selectDomain';

    const LOGIN = 'login';

    const DISPLAY_DOMAIN = 'displayDomain';

    const PASSWORD = 'passwordMailAddr';

    /**
     * Logins a user
     * @return string
     */
    static function loginUser()
    {
        if (isset($_POST['userName']) == true && isset($_POST['password']) == true) {
            if (array_key_exists($_POST['userName'], Config::$USERS) == true) {
                if (Config::$USERS[$_POST['userName']] == sha1($_POST['password'])) {
                    $_SESSION['user'] = $_POST['userName'];
                    return Actions::SELECT_DOMAIN;
                }
            }
        }

        return Actions::LOGIN;
    }

    /**
     * Adds a domain
     * @param mysqli $mysqli
     * @return string
     */
    static function addDomain(mysqli $mysqli)
    {
        if (isset($_POST['domainName']) == true) {
            $query = $mysqli->prepare('INSERT INTO panel_domains (domain,isemaildomain) VALUES (?,1)');
            $query->bind_param('s', $_POST['domainName']);
            $query->execute();
        }


        /*$domainPath = Config::MAIL_ROOT_PATH .'/'.$_POST['domainName'];
        safe_exec('mkdir -p ' . escapeshellarg($domainPath));
        safe_exec('chown -R ' . (int)Config::MAIL_UID.':'.(int)Config::MAIL_GID.' '.$domainPath);*/


        $_GET['domain'] = $_POST['domainName'];
        return Actions::DISPLAY_DOMAIN;
    }

    /**
     * Adds a domain
     * @param mysqli $mysqli
     * @return string
     */
    static function deleteDomain(mysqli $mysqli)
    {
        if (isset($_GET['domain']) == true) {
            $mysqli->query("DELETE FROM mail_users WHERE email LIKE '%@".mysqli_escape_string($mysqli,$_GET['domain'])."'");
            $mysqli->query("DELETE FROM mail_virtual WHERE email LIKE '%@".mysqli_escape_string($mysqli,$_GET['domain'])."'");
            $mysqli->query("DELETE FROM panel_domains WHERE domain = '".mysqli_escape_string($mysqli,$_GET['domain'])."'");
        }
        return Actions::SELECT_DOMAIN;
    }

    /**
     * Adds a email
     * @param mysqli $mysqli
     * @return string
     */
    static function addEmail(mysqli $mysqli)
    {
        if (isset($_GET['domain']) == true && isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
            if ($_POST['password'] == $_POST['rePassword']) {
                $email = $_POST['userName'] . '@' . $_GET['domain'];
                $maildir = $_GET['domain'] . '/' . $email . '/';
                $stmt = $mysqli->prepare("INSERT INTO mail_users (email,username,password_enc,uid,gid,homedir,maildir) VALUES (?,?,ENCRYPT(?)," . Config::MAIL_UID . "," . Config::MAIL_GID . ",'" . Config::MAIL_ROOT_PATH . "',?)");
                $email = $_POST['userName'] . '@' . $_GET['domain'];
                $stmt->bind_param('ssss', $email,$email,$_POST['password'],$maildir);
                $stmt->execute();

                $stmt2 = $mysqli->prepare('INSERT INTO mail_virtual (email,destination) VALUES (?,?)');
                $stmt2->bind_param('ss', $email, $email);
                $stmt2->execute();
            }
        }
        return Actions::DISPLAY_DOMAIN;
    }

    /**
     * Adds a email
     * @param mysqli $mysqli
     * @return string
     */
    static function changePassword(mysqli $mysqli)
    {

        if (isset($_GET['domain']) == true  && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
            if ($_POST['password'] == $_POST['rePassword']) {
                $stmt = $mysqli->prepare("UPDATE mail_users SET password_enc = ENCRYPT(?) WHERE email = ?");
                $stmt->bind_param('ss', $_POST['password'],$_POST['mail']);
                $stmt->execute();
            }
        }
        return Actions::DISPLAY_DOMAIN;
    }

    /**
     * Deletes an email
     * @param mysqli $mysqli
     */
    static function deleteEmail(mysqli $mysqli) {
        if(isset($_GET['domain']) && isset($_GET['mail'])) {
            $stmt = $mysqli->prepare('DELETE FROM mail_users WHERE email=?');
            $stmt->bind_param('s',$_GET['mail']);
            $stmt->execute();

            $stmt2 = $mysqli->prepare('DELETE FROM mail_virtual WHERE email=?');
            $stmt2->bind_param('s',$_GET['mail']);
            $stmt2->execute();
        }

        return Actions::DISPLAY_DOMAIN;
    }

}