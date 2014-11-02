<?php
    include 'includes/file.php';
	if(isset($_GET['false'])){
		add_visit(crypt($_SERVER['REMOTE_ADDR'], get_salt('./data/salt.sav')), './data/visits.sav', true);
		echo "n";
	} elseif(isset($_GET['ans'])) {
		add_visit(crypt($_SERVER['REMOTE_ADDR'], get_salt('./data/salt.sav')), './data/visits.sav', false, $_GET['ans']);
		echo "s";
	}
?>