<?php
$command = $_GET['command'];

shell_exec("/usr/bin/python3 ./roomba_pub_cleandock.py $command");

$reply="CLEAN";
if ($command == "start") :
	$reply="DOCK";
else :
	$reply="CLEAN";
endif;

echo $reply;

?>