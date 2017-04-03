<?php


$coremessages = include BASE_PATH."/vendor/rnt-forest/core/messages/de.php";
$ovzmessages = include BASE_PATH."/vendor/rnt-forest/ovz/messages/de.php";

$messages = [

    // examples
    "hi"      => "Hallo",
    "bye"     => "Auf Wiedersehen",
    "hi-name" => "Hallo %name%",
    "song"    => "Dieser Song ist %song%",
    

];

$messages = array_merge($coremessages,$ovzmessages,$messages);
