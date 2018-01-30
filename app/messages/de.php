<?php


$coremessages = include BASE_PATH."/vendor/rnt-forest/core/messages/de.php";
$lxdmessages = include BASE_PATH."/vendor/rnt-forest/lxd/messages/de.php";

$messages = [

    // examples
    "hi"      => "Hallo",
    "bye"     => "Auf Wiedersehen",
    "hi-name" => "Hallo %name%",
    "song"    => "Dieser Song ist %song%",
    

];

$messages = array_merge($coremessages,$lxdmessages,$messages);
