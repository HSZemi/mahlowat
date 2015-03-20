<?php

function count_equal_answers($list, $votes){
	$len = max(sizeof($list), sizeof($votes));
	$count = 0;
	
	for($i = 0; $i < $len; $i++){
		if($list[$i] == $votes[$i] and !('skip' === $my[$i])){
			$count++;
		}
	}
	
	return $count;
}

function count_contrary_answers($list, $votes){
	$len = max(sizeof($list), sizeof($votes));
	$count = 0;
	
	for($i = 0; $i < $len; $i++){
		if(($list[$i] == 1 and $votes[$i] == -1) or ($list[$i] == -1 and $votes[$i] == 1)){
			$count++;
		}
	}
	
	return $count;
}

function count_relevant_answers($votes){
	$count = 0;
	for($i = 0; $i < sizeof($votes); $i++){
		if(!('skip' === $my[$i])){
			$count++;
		}
	}
	
	return $count;
}

function count_achievable_points($answers){
	$count = 0;
	for($i = 0; $i < sizeof($answers); $i++){
		if(!(char_to_value($answers[$i]) === 'skip')){
			$count += 2 * char_to_multiply($answers[$i]);
		}
	}
	return $count;
}

function count_list_points($list, $answers){
	return calculate_points($list, $answers);
}


function result_from_string($str, $numberoftheses){
	$answers = Array();
	$multiplier = Array();
	$err = false;
	if(strlen($str) != $numberoftheses){
	$err = true;
	} else {
	$items = str_split($str);
	for($i = 0; $i < sizeof($items); $i++){
		$answers[$i] = ($items[$i]);
		$multiplier[$i] = char_to_multiply($items[$i]);
		
		if($answers[$i] === 'error' or $multiplier[$i] == 0){
			$err = true;
		}
	}
	}
	if($err){
	for($i = 0; $i < $numberoftheses; $i++){
		$answers[$i] = 'skip';
		$multiplier[$i] = 1;
	}
	}
	
	$retval[0] = $answers;
	$retval[1] = $multiplier;
	
	return $retval;
}

function char_to_value($char){
	switch($char){
		case 'a':
		case 'e':
			return 1;
		case 'b':
		case 'f':
			return 0;
		case 'c':
		case 'g':
			return -1;
		case 'd':
		case 'h':
			return 'skip';
		default:
			return 'error';
	}
}

function char_to_multiply($char){
	switch($char){
		case 'a':
		case 'b':
		case 'c':
		case 'd':
			return 1;
		case 'e':
		case 'f':
		case 'g':
		case 'h':
			return 2;
		default:
			return 0;
	}
}


    
function calculate_points($list, $answers){
	$max = max(sizeof($answers), sizeof($list));
	
	$pointvector = Array();
	/*  my = skip:                skip / skip
	*  my != skip && list = skip: +0 / +0
	* |my - list| = 0:            +2 / +4
	* |my - list| = 1:            +1 / +2
	* |my - list| = 2:            +0 / +0
	*/
	for($i = 0; $i < $max; $i = $i + 1){
		$pointvector[$i] = 0;
		$value = char_to_value($list[$i]['selection']);
		
		if(char_to_value($answers[$i]) === 'skip'){
			continue;
		} elseif(!('skip' === char_to_value($answers[$i])) and $value === 'skip'){
			$pointvector[$i] = 0;
		} else { 
			$pointvector[$i] = 2-abs(char_to_value($answers[$i])-$value);
		}
	}
	
	$multiply = Array();
	for($i = 0; $i < sizeof($answers); $i++){
		$multiply[$i] = char_to_multiply($answers[$i]);
	}
	
	$pointvector = vec_mul($pointvector, $multiply);
	
	return vectorsum($pointvector);
	
}
    
function vectorsum($vec){
	$sum = 0;
	for($i = 0; $i < sizeof($vec); $i = $i + 1){
		$sum = $sum + $vec[$i];
	}
	return $sum;
}
    
function vec_mul($a, $b){
	if(sizeof($a) != sizeof($b)){
		echo 'vector dimensions do not match|'.sizeof($a).'|'.sizeof($b).'<br />';
	} else {
		for($i = 0; $i < sizeof($a); $i = $i + 1){
			$a[$i] = $a[$i] * $b[$i];
		}
		return $a;
	}
}
    
    
    
function sort_lists_by_points($data, $answers){
	$offset = 1/floatval(sizeof($data['lists']));
	
	$sorted = Array();
	$temp_answers = Array();
	$temp_names = Array();
	for($i = 0; $i < sizeof($data['answers']); $i = $i + 1){
		$sorted[$i] = (calculate_points($data['answers'][$i], $answers)-($i*$offset));
		$temp_answers[(string)(calculate_points($data['answers'][$i], $answers)-($i*$offset))] = $data['answers'][$i];
		$temp_names[(string)(calculate_points($data['answers'][$i], $answers)-($i*$offset))] = $data['lists'][$i];
	}
	
	sort($sorted);
	
	$sorted_answers = Array();
	$sorted_names = Array();
	for($i = 0; $i < sizeof($sorted); $i = $i + 1){
		$sorted_answers[$i] = $temp_answers[(string)$sorted[$i]];
		$sorted_names[$i] = $temp_names[(string)$sorted[$i]];
	}
	
	$sorted_answers = rev_arr($sorted_answers);
	$sorted_names = rev_arr($sorted_names);
	
	for($i = 0; $i < sizeof($data['answers']); $i = $i + 1){
		$data['answers'][$i] = $sorted_answers[$i];
		$data['lists'][$i] = $sorted_names[$i];
	}
	
	return $data;
}
    
function rev_arr($arr){
	$len = sizeof($arr);
	for($i = 0; $i < (($len / 2)); $i = $i + 1){
		$temp = $arr[$i];
		$arr[$i] = $arr[$len - 1 - $i];
		$arr[$len - 1 - $i] = $temp;
	}
	return $arr;
}

?>