<?php

if (defined('STDIN') == false) {
    echo("Not Running from CLI");
}

/**
 * set this to true to get debug messages
 */
const DEBUG = true;

const TRY_RUN = false;

require_once 'config.php';
require_once 'Actions.php';

$mysqli = new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
}

// select all dmoains and check if there path exists
$domains = Actions::getDomains($mysqli);
if(count($domains) > 0) {
    printDebug("Found: ".count($domains).' domain to check.');

    foreach($domains as $domain) {
        $domainPathExists = Actions::checkIfDomainPathExists($domain['domain']);
        if($domainPathExists == false) {
            $domainPath = Actions::createDomainPath($domain['domain']);
            printDebug("For domain: ".$domain['domain'].' path: '.$domainPath.' does not exist');
            executeCommand('mkdir -p ' . escapeshellarg($domainPath));
            executeCommand('chown -R ' . (int)Config::MAIL_UID.':'.(int)Config::MAIL_GID.' '.escapeshellarg($domainPath));
        }

        $mails = Actions::getEmails($mysqli,$domain['domain']);
        printDebug("Found: ".count($mails)." for domain: ".$domain['domain']);
        if(count($mails) > 0) {
            foreach($mails as $mail) {
                if($mail['DIR_EXISTS'] == false) {
                    printDebug("For mail: ".$mail['username'].' the directory: '.$mail['DIR'].' does not exist');
                    executeCommand(Config::MAIL_DIRMAKE_CMD.' '.escapeshellarg($mail['DIR']));
                    executeCommand('chown -R ' . (int)Config::MAIL_UID.':'.(int)Config::MAIL_GID.' '.escapeshellarg($mail['DIR']));
                }
            }
        }
    }
}

$mysqli->close();

/**
 * Tiny debug echo function
 * @param $message
 */
function printDebug($message) {
    if(DEBUG == true) {
        print($message."\n");
    }
}

function executeCommand($command) {
  if(TRY_RUN == true) {
      print("Try run: ".$command."\n");
  } else {
      shell_exec($command);
  }

}
