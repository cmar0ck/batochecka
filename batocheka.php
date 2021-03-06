<?php

//////////////////////////////////////////////////////
// CHECK IF NEW BATOCERA LINUX VERSION IS AVAILABLE //
//////////////////////////////////////////////////////

// Pre-Check: Save version to file if file doesn't exist, yet	
if (!file_exists('batocera_old.txt')) {
	$batocera_old = file_get_contents('https://batocera.org/upgrades/installs.txt');
	file_put_contents('batocera_old.txt', $batocera_old);
	sleep(1);
} 

// Compare versions
$batocera_new = file_get_contents('https://batocera.org/upgrades/installs.txt');

$batocera_old = file_get_contents('batocera_old.txt');

// Send mail if new version is available
if ($batocera_old != $batocera_new) {

	$receiver	= 'YOUREMAILADDRESSHERE';
	$subject 	= 'New Batocera version(s) available!';
	$message 	= $batocera_new;
	$headers 	= 'From: ' . $receiver . "\r\n" .
	    		'Reply-To: ' . $receiver . "\r\n" .
	    		'X-Mailer: PHP/' . phpversion();

	mail($receiver, $subject, $message, $headers);

	echo $subject;
} 
else {
	echo 'No new version(s) available (current version still '.$batocera_old.')';
}

// Update temp file
file_put_contents('batocera_old.txt', $batocera_new);

?>
