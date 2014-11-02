<?php

include '../includes/file.php';

$hsg_array_s = load_var('lists.sav');
$hsg_array = Array();
if($hsg_array_s != null){
	header("Content-Type: text/plain");
	header("Content-Disposition: attachment; filename=hsg.php");
	
	$keys = array_keys($hsg_array_s);
	for($i=0; $i<sizeof($keys); $i++){
		$hsg_array[$i] = $hsg_array_s[$keys[$i]];
		for($c=0; $c<sizeof($hsg_array[$i]['comments']); $c++){
			if($hsg_array[$i]['comments'][$c] === ''){
				$hsg_array[$i]['comments'][$c] = "Zu dieser These hat die Liste {\$hsg_array[$i]['name']} keine Begründung angegeben.";
			}
		}
	}
	
	echo '<?php
	
function get_hsg_array(){
';
	for($i=0; $i<sizeof($hsg_array); $i++){
		echo "	\$hsg_array[$i]['name'] = '{$hsg_array[$i]['name']}';
	\$hsg_array[$i]['name_x'] = '{$hsg_array[$i]['name_x']}';
";
		if(isset($hsg_array[$i]['answers'])){
			echo "	\$hsg_array[$i]['answers'] = Array(";
			echo "{$hsg_array[$i]['answers'][0]}";
			for($a=1;$a<sizeof($hsg_array[$i]['answers']);$a++){
				echo ','.$hsg_array[$i]['answers'][$a];
			}
			echo ");
	";
		}
		if(isset($hsg_array[$i]['comments'])){
			echo "\$hsg_array[$i]['comments'] = Array(
	";
			echo "	\"{$hsg_array[$i]['comments'][0]}\"";
			for($c=1; $c<sizeof($hsg_array[$i]['comments']);$c++){
				echo ",
			
		\"{$hsg_array[$i]['comments'][$c]}\"";
			}
			echo ");
";
		}
		echo "

";
	}
	
	echo "	return \$hsg_array;
	
}

?>";
	
}
?>