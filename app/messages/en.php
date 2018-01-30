<?php

$coremessages = include BASE_PATH."/vendor/rnt-forest/core/messages/en.php";
$lxdmessages = include BASE_PATH."/vendor/rnt-forest/lxd/messages/en.php";

$messages = [

    // examples
    "hi"      => "Hello",
    "bye"     => "Good Bye",
    "hi-name" => "Hello %name%",
    "song"    => "This song is %song%",


];

$messages = array_merge($coremessages,$lxdmessages,$messages);
