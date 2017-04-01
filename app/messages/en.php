<?php

$coremessages = include BASE_PATH."/vendor/rnt-forest/core/messages/en.php";
$ovzmessages = include BASE_PATH."/vendor/rnt-forest/ovz/messages/en.php";

$messages = [

    // examples
    "hi"      => "Hello",
    "bye"     => "Good Bye",
    "hi-name" => "Hello %name%",
    "song"    => "This song is %song%",

];

$messages = array_merge($coremessages,$ovzmessages,$messages);
