<?php
    include 'includes/file.php';
	add_visit(crypt($_SERVER['REMOTE_ADDR'], get_salt('./data/salt.sav')), './data/visits.sav');
	echo "s";
?>