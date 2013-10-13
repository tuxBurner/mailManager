<?php
session_start();

require_once 'config.php';
if (isset(Config::$USERS) == false || count(Config::$USERS) == 0) {
    die('Need to configure users');
}

$mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

require_once 'Actions.php';

require_once 'Smarty-3.1.15/libs/Smarty.class.php';

if (isset($_SESSION['user']) == false) {
    $_GET['action'] = 'login';
}

if(isset($_GET['domain']) == true) {
    // check if domain exists
    $countStmt = $mysqli->query("SELECT count(*) FROM panel_domains WHERE domain='" . mysqli_escape_string($mysqli, $_GET['domain']) . "'");
    $countStmt->data_seek(0);
    $row = $countStmt->fetch_row();
    if($row[0] != 1) {
        die('Domain: '.$_GET['domain'].' does not exist');
    }
}

if (isset($_REQUEST['doAction']) == true) {


    if($_REQUEST['doAction'] != 'login' && $_REQUEST['doAction'] != 'logout' && isset($_SESSION['user']) == false) {
        die('Only login can be done without user login :)');
    }

    switch ($_REQUEST['doAction']) {
        case 'login':
            $_GET['action'] = Actions::loginUser();
            break;
        case 'addDomain' :
            $_GET['action'] = Actions::addDomain($mysqli);
            break;
        case 'deleteDomain' :
            $_GET['action'] = Actions::deleteDomain($mysqli);
            break;
        case 'deleteMailAddr' :
            $_GET['action'] = Actions::deleteEmail($mysqli);
            break;
        case 'changePassword' :
            $_GET['action'] = Actions::changePassword($mysqli);
            break;
        case 'addMail' :
            $_GET['action'] = Actions::addEmail($mysqli);
            break;
        case 'logout':
            unset($_SESSION['user']);
            break;
    }
}

// check if an action is set
if (isset($_GET['action']) == false) {
    if (isset($_SESSION['user']) == false) {
        $_GET['action'] = Actions::LOGIN;
    } else {
        if(isset($_GET['domain']) == true) {
            $_GET['action'] = Actions::DISPLAY_DOMAIN;
        } else {
          $_GET['action'] = Actions::SELECT_DOMAIN;
        }
    }
}


$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');

$content = '';

switch ($_GET['action']) {
    case Actions::SELECT_DOMAIN:
        $domains = array();
        $domainRes = $mysqli->query('SELECT domain FROM panel_domains WHERE isemaildomain=1 ORDER BY domain DESC');
        for ($row_no = $domainRes->num_rows - 1; $row_no >= 0; $row_no--) {
            $domainRes->data_seek($row_no);
            $row = $domainRes->fetch_assoc();
            $domains[] = $row;
        }
        $smarty->assign('DOMAINS', $domains);
        $content = $smarty->fetch('selectDomain.tpl');
        break;
    case Actions::DISPLAY_DOMAIN:
        $mails = array();
        //$query = mysqli_escape_string($mysqli,);
        $mailRes = $mysqli->query("SELECT username,homedir,maildir FROM mail_users WHERE username LIKE '%@".mysqli_escape_string($mysqli,$_GET['domain'])."' ORDER BY username DESC");
        for ($row_no = $mailRes->num_rows - 1; $row_no >= 0; $row_no--) {
            $mailRes->data_seek($row_no);
            $row = $mailRes->fetch_assoc();
            $mails[] = $row;
        }
        $smarty->assign('MAILS', $mails);
        $content = $smarty->fetch('displayDomain.tpl');
        break;
    case Actions::PASSWORD:
        $content = $smarty->fetch('changePassword.tpl');
        break;
    default:
        $content = $smarty->fetch('login.tpl');
}

$smarty->assign('CONTENT', $content);
$smarty->display('main.tpl');

$mysqli->close();