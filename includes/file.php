<?php

function add_visit($id, $file, $nocount=false, $ans=''){
	$visits = get_visits($id, $file);
	if($visits != null){
		if($nocount){
			$visits['nocount'] = $visits['nocount'] + 1;
		} else {
			$date = date('Ymd');
			
			if(!isset($visits[$date][$id])){
				$visits[$date][$id] = 1;
			} else {
				$visits[$date][$id] = $visits[$date][$id] + 1;
			}
			$visits['ans'][$id][] = $ans;
		}
		set_visits($visits, $file);
	} else {
		echo '<!-- ERROR konnte Besuche nicht zählen -->';
	}
}

function get_visits($id, $file){
	if(!file_exists($file)){
		$visits[date('Ymd')][$id] = 0;
		$visits['nocount'] = 0;
		$visits['ans'] = Array();
		return $visits;
	}
	if(is_readable($file)){
	
		$handle = fopen($file, 'r');
		$contents = fread($handle, filesize($file));
		fclose($handle);
		
		$visits = unserialize($contents);
		return $visits;
	} else {
		echo "<!-- ERROR $file kann nicht gelesen werden! -->";
		return null;
	}
}

function set_visits($visits, $file){
	if(is_writable($file) or (is_writable(dirname($file)) and !file_exists($file))){
	
		$handle = fopen($file, 'w');
		if (!fwrite($handle, serialize($visits))) {
			echo "<!-- ERROR Kann in die Datei $file nicht schreiben -->";
		}
		fclose($handle);
		
	} else {
		echo "<!-- ERROR $file nicht beschreibbar! -->";
	}
}

function get_salt($hashfile){
	// a) file does not exist yet
	if(!file_exists($hashfile)){
		if(is_writable(dirname($hashfile))){
	
		$hash[0] = date('Ymd');
		$hash[1] = mt_rand();
			
		$handle = fopen($hashfile, 'w');
		if (!fwrite($handle, serialize($hash))) {
			echo "<!-- ERROR Kann in die Datei $hashfile nicht schreiben -->";
		}
		fclose($handle);
		
		} else {
			echo "<!-- ERROR Kann Datei $hashfile nicht erstellen! -->";
		}
	}
	
	if(is_readable($hashfile)){
	
		$handle = fopen($hashfile, 'r');
		$contents = fread($handle, filesize($hashfile));
		fclose($handle);
		
		$hash = unserialize($contents);
		
		// b) hash is not of today
		if($hash[0] != date('Ymd')){
			$hash[0] = date('Ymd');
			$hash[1] = mt_rand();
			
			$handle = fopen($hashfile, 'w');
			if (!fwrite($handle, serialize($hash))) {
				echo "<!-- ERROR Kann in die Datei $hashfile nicht schreiben -->";
			}
			fclose($handle);
		}
		return $hash[1];
	} else {
		echo "<!-- ERROR $hashfile kann nicht gelesen werden! -->";
		return 1;
	}
	
}

function load_var($file){
	if(!file_exists($file)){
		return null;
	}
	if(is_readable($file)){
	
		$handle = fopen($file, 'r');
		$contents = fread($handle, filesize($file));
		fclose($handle);
		
		$var = unserialize($contents);
		return $var;
	} else {
		echo "<!-- ERROR $file kann nicht gelesen werden! -->";
		return null;
	}
}

function save_var($file, $var){
	if(is_writable($file) or (is_writable(dirname($file)) and !file_exists($file))){
	
		$handle = fopen($file, 'w');
		if (!fwrite($handle, serialize($var))) {
			echo "<!-- ERROR Kann in die Datei $file nicht schreiben -->";
		}
		fclose($handle);
		
	} else {
		echo "<!-- ERROR $file nicht beschreibbar! -->";
	}
}
    

?>