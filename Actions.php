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
            $mysqli->query("DELETE FROM mail_users WHERE email LIKE '%@" . mysqli_escape_string($mysqli, $_GET['domain']) . "'");
            $mysqli->query("DELETE FROM mail_virtual WHERE email LIKE '%@" . mysqli_escape_string($mysqli, $_GET['domain']) . "'");
            $mysqli->query("DELETE FROM panel_domains WHERE domain = '" . mysqli_escape_string($mysqli, $_GET['domain']) . "'");
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
                $stmt->bind_param('ssss', $email, $email, $_POST['password'], $maildir);
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

        if (isset($_GET['domain']) == true && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['rePassword'])) {
            if ($_POST['password'] == $_POST['rePassword']) {
                $stmt = $mysqli->prepare("UPDATE mail_users SET password_enc = ENCRYPT(?) WHERE email = ?");
                $stmt->bind_param('ss', $_POST['password'], $_POST['mail']);
                $stmt->execute();
            }
        }
        return Actions::DISPLAY_DOMAIN;
    }

    /**
     * Deletes an email
     * @param mysqli $mysqli
     */
    static function deleteEmail(mysqli $mysqli)
    {
        if (isset($_GET['domain']) && isset($_GET['mail'])) {
            $stmt = $mysqli->prepare('DELETE FROM mail_users WHERE email=?');
            $stmt->bind_param('s', $_GET['mail']);
            $stmt->execute();

            $stmt2 = $mysqli->prepare('DELETE FROM mail_virtual WHERE email=?');
            $stmt2->bind_param('s', $_GET['mail']);
            $stmt2->execute();
        }

        return Actions::DISPLAY_DOMAIN;
    }

    /**
     * Gets all dmoains in the database
     * @param mysqli $mysqli
     * @return array
     */
    static function getDomains(mysqli $mysqli) {
        $domains = array();
        $domainRes = $mysqli->query('SELECT domain FROM panel_domains WHERE isemaildomain=1 ORDER BY domain DESC');
        for ($row_no = $domainRes->num_rows - 1; $row_no >= 0; $row_no--) {
            $domainRes->data_seek($row_no);
            $row = $domainRes->fetch_assoc();
            $domains[] = $row;
        }

        return $domains;
    }

    /**
     * Gets all mails
     * @param mysqli $mysqli
     * @param $domain
     * @return array
     */
    static function getEmails(mysqli $mysqli, $domain) {
        $mails = array();
        $mailRes = $mysqli->query("SELECT username,homedir,maildir FROM mail_users WHERE username LIKE '%@".mysqli_escape_string($mysqli,$domain)."' ORDER BY username DESC");
        for ($row_no = $mailRes->num_rows - 1; $row_no >= 0; $row_no--) {
            $mailRes->data_seek($row_no);
            $row = $mailRes->fetch_assoc();
            $row['DIR_EXISTS'] = Actions::checkIfMailDirExists($row['homedir'],$row['maildir']);
            $row['DIR'] = Actions::createMailPath($row['homedir'],$row['maildir']);
            $mails[] = $row;
        }
        return $mails;
    }


    /**
     * Checks if the path of the domain exists or not
     * @param $domain
     * @return bool
     */
    static function checkIfDomainPathExists($domain)
    {
        $domainPath = Actions::createDomainPath($domain);
        return file_exists($domainPath) && is_dir($domainPath);
    }

    /**
     * Creates the path to the domain
     * @param $domain
     * @throws Exception
     * @return string
     */
    static function createDomainPath($domain)
    {
        if (empty($domain) == true) {
            throw new Exception("Domain cannot be empty !");
        }
        return Config::MAIL_ROOT_PATH . '/' . $domain;
    }

    /**
     * checks if the dir for the mail adress exists
     * @param $homedir
     * @param $maildir
     * @return bool
     */
    static function checkIfMailDirExists($homedir,$maildir) {
        $mailDirPath = Actions::createMailPath($homedir,$maildir);
        return file_exists($mailDirPath) && is_dir($mailDirPath);
    }

    /**
     * Creates the maildir path
     * @param $homedir
     * @param $maildir
     * @return string
     * @throws Exception
     */
    static function createMailPath($homedir,$maildir) {
        if (empty($homedir) == true || empty($maildir) == true) {
            throw new Exception("Homedir or maildir cannot be empty");
        }

        return $homedir.'/'.$maildir;
    }

}