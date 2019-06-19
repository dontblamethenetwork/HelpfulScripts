<?php 
	$usernames = file('usernames.txt');
	$passwords = file('passwords.txt');
	$file = 'encodedcreds.txt';

	// Breakout each line into its own variable
	foreach ($usernames as $line_num => $line) {

		// convert any special characters into HTML entities
		$creds = htmlspecialchars($line);
		$creds = trim(preg_replace('/\s+/', ' ', $creds));

		// Now we'll split each line of the password file up.
		foreach ($passwords as  $passwords_single) {

			// convert any special characters into HTML entities
			$pass = htmlspecialchars($passwords_single);
			$pass = trim(preg_replace('/\s+/', ' ', $pass));
	
			// add credential and password into a single variable seperated by a colon.
			$combined_user_pass = $creds.':'.$pass;
	
			// base64 encode the entire output, and add a new line at the end
			$encode = base64_encode($combined_user_pass)."\n";
	
			// add the output to a file.
			file_put_contents($file, $encode, FILE_APPEND | LOCK_EX);
		}
	}

// Just so you know where to direct it.
echo 'Check '.$file.' for encoded outputs.';
?>

