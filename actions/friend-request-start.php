<?php

include '../includes/include.php';

$id = $_POST['id'];
$viewer->friends();

if (in_array($id, $viewer->friends)) {
	echo "remove friend";
} else if(in_array($id, $viewer->pending)) {
	echo "cancel request";
} else if(in_array($id, $viewer->requests)){
	echo "accept request";
} else {
	echo "send request";
}

?>