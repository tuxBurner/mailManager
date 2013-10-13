<?php

if (defined('STDIN') == false) {
    echo("Not Running from CLI");
}


if (count($argv) == 1) {
    die("Please give a password to hash as parameter\n");
}

echo "Creating passwordhash for: ".$argv[1]."\n";
echo sha1($argv[1])."\n";