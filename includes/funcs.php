<?php

function count_equal_answers($hsg, $votes){
      $len = max(sizeof($hsg), sizeof($votes));
      $count = 0;
      
      for($i = 0; $i < $len; $i++){
            if($hsg[$i] == $votes[$i] and !('skip' === $my[$i])){
                  $count++;
            }
      }
      
      return $count;
}

function count_contrary_answers($hsg, $votes){
      $len = max(sizeof($hsg), sizeof($votes));
      $count = 0;
      
      for($i = 0; $i < $len; $i++){
            if(($hsg[$i] == 1 and $votes[$i] == -1) or ($hsg[$i] == -1 and $votes[$i] == 1)){
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

function count_achievable_points($my, $emph){
      $count = 0;
      for($i = 0; $i < sizeof($my); $i++){
            if(!($my[$i] === 'skip')){
                  $count += 2 * $emph[$i];
            }
      }
      return $count;
}

function count_party_points($hsg, $votes, $emph){
      return calculate_points($votes, $hsg, $emph);
}

function html_hsg_bar($hsg, $votes, $emph, $class){
      $hsg_name = $hsg['name_x'];
      $party_points = count_party_points($hsg['answers'], $votes, $emph);
      $ach_points = count_achievable_points($votes, $emph);
      if($ach_points != 0){
            $hsg_percentage = intval( 100 *  $party_points / $ach_points);
      } else {
            $hsg_percentage = 0;
      }
      
     echo "<tr class='$class'>
     <td><b>$hsg_name</b></td><td>$party_points von $ach_points</td>
     <td><div class='progress'><div class='bar' title='$hsg_percentage %' style='width: $hsg_percentage%;'></div></div>
     </td>
     </tr>";
}

/* unused
function html_hsg_bar_tricolore($hsg, $votes, $emph, $class){
      $hsg_name = $hsg['name'];
      $hsg_percentage_equal = intval( 100 * count_equal_answers($hsg['answers'], $votes) / count_relevant_answers($votes));
      $hsg_percentage_contrary = intval( 100 * count_contrary_answers($hsg['answers'], $votes) / count_relevant_answers($votes));
      $hsg_percentage_medium = 100 - $hsg_percentage_equal - $hsg_percentage_contrary;
      
     echo "<tr class='$class'>
     <td><b>$hsg_name</b></td><td>$hsg_percentage_equal %</td>
     <td><div class='progress'>
      <div class='bar bar-success' style='width: $hsg_percentage_equal%;'></div>
      <div class='bar bar-warning' style='width: $hsg_percentage_medium%;'></div>
      <div class='bar bar-danger' style='width: $hsg_percentage_contrary%;'></div>  
      </div>
     </td>
     </tr>";
}*/

function result_from_string($str, $numberoftheses){
	$answers = Array();
	$multiplier = Array();
	$err = false;
	if(strlen($str) != $numberoftheses){
		$err = true;
	} else {
		$items = str_split($str);
		for($i = 0; $i < sizeof($items); $i++){
			if($items[$i] === 'a' ){
				$answers[$i] = 1;
				$multiplier[$i] = 1;
			}
			elseif($items[$i] === 'b'){
				$answers[$i] = 0;
				$multiplier[$i] = 1;
			}
			elseif($items[$i] === 'c'){
				$answers[$i] = -1;
				$multiplier[$i] = 1;
			}
			elseif($items[$i] === 'd'){
				$answers[$i] = 'skip';
				$multiplier[$i] = 1;
			}
			elseif($items[$i] === 'e' ){
				$answers[$i] = 1;
				$multiplier[$i] = 2;
			}
			elseif($items[$i] === 'f'){
				$answers[$i] = 0;
				$multiplier[$i] = 2;
			}
			elseif($items[$i] === 'g'){
				$answers[$i] = -1;
				$multiplier[$i] = 2;
			}
			elseif($items[$i] === 'h'){
				$answers[$i] = 'skip';
				$multiplier[$i] = 2;
			}
			else{
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

function result_to_string($answers, $multiplier){
	$resstring = '';
	$err = false;
	for($i = 0; $i < sizeof($answers); $i++){
		if($answers[$i] === 'skip' && $multiplier[$i] == 1){
			$resstring .= 'd';
		}
		elseif($answers[$i] == 1 && $multiplier[$i] == 1){
			$resstring .= 'a';
		}
		elseif($answers[$i] == 0 && $multiplier[$i] == 1){
			$resstring .= 'b';
		}
		elseif($answers[$i] == -1 && $multiplier[$i] == 1){
			$resstring .= 'c';
		}
		elseif($answers[$i] === 'skip' && $multiplier[$i] == 2){
			$resstring .= 'h';
		}
		elseif($answers[$i] == 1 && $multiplier[$i] == 2){
			$resstring .= 'e';
		}
		elseif($answers[$i] == 0 && $multiplier[$i] == 2){
			$resstring .= 'f';
		}
		elseif($answers[$i] == -1 && $multiplier[$i] == 2){
			$resstring .= 'g';
		}
		else{
			$err = true;
		}
	}
	
	if($err){
		return '==error==';
	}
	
	return $resstring;
}

function code_to_answer($code){
      if($code === 'skip'){
            return '-';
      }
      if($code == 1){
            return 'Zustimmung';
      }
      if($code == 0){
            return 'Neutral';
      }
      if($code == -1){
            return 'Ablehnung';
      }
    }
    

    function hsg_get_td($hsg, $i){
      $vote = $hsg['answers'][$i];
      $popover = 'data-toggle="tooltip" data-placement="top" data-original-title="'.$hsg['comments'][$i].'"';
      
      if($vote === 'skip'){
            return "<td><a class='btn btn-block disabled hsganswer' $popover>-</a></td>\n";
      }
      if($vote == 1){
            return "<td><a class='btn btn-success btn-block disabled hsganswer' $popover><i class='icon-thumbs-up'></i></a></td>\n";
      }
      if($vote == 0){
            return "<td><a class='btn btn-warning btn-block disabled hsganswer' $popover><i class='bg-icon-circle'></i></a></td>\n";
      }
      if($vote == -1){
            return "<td><a class='btn btn-danger btn-block disabled hsganswer' $popover><i class='icon-thumbs-down'></i></a></td>\n";
      }
    }
    
    function hsg_get_explanation($hsg, $i){
      $vote  = $hsg['answers'][$i];
      $etext = $hsg['comments'][$i];
      $name  = $hsg['name'];
      $prefix = "";
      
      if($vote === 'skip'){
            $prefix = "<span class='label'>$name</span>\n";
      }
      elseif($vote == 1){
            $prefix = "<span class='label label-success'>$name</span>\n";
      }
      elseif($vote == 0){
            $prefix = "<span class='label label-warning'>$name</span>\n";
      }
      elseif($vote == -1){
            $prefix = "<span class='label label-important'>$name</span>\n";
      }
      
      return $prefix . "<p>$etext</p>\n\n";
    }
    
    function code_to_btnclass($int){
      if($int === 'skip'){
            return '';
      }
      if($int == 1){
            return 'btn-success';
      }
      if($int == 0){
            return 'btn-warning';
      }
      if($int == -1){
            return 'btn-danger';
      }
    }
    
    function code_to_labelclass($int){
      if($int === 'skip'){
            return '';
      }
      if($int == 1){
            return 'label-success';
      }
      if($int == 0){
            return 'label-warning';
      }
      if($int == -1){
            return 'label-important';
      }
    }
    
    function calculate_points($my, $hsg, $emph){
      $max = max(sizeof($my), sizeof($hsg));
      
      $pointvector = Array();
      /*  my = skip:                skip / skip
       *  my != skip && hsg = skip: +0 / +0
       * |my - hsg| = 0:            +2 / +4
       * |my - hsg| = 1:            +1 / +2
       * |my - hsg| = 2:            +0 / +0
       */
      for($i = 0; $i < $max; $i = $i + 1){
            $pointvector[$i] = 0;
            if($my[$i] === 'skip'){continue;}
            elseif(!('skip' === $my[$i]) and $hsg[$i] === 'skip'){$pointvector[$i] = 0;}
            else{ $pointvector[$i] = 2-abs($my[$i]-$hsg[$i]);}
      }
      
      $pointvector = vec_mul($pointvector, $emph);
      
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
    
    function pagitem($i, $curr){
      if($i == $curr){
            return '<li class="active"><a href="#">'.$i."</a></li>\n";
      } else {
            return '<li class=""><a href="mahlowat.php?id='.$i.'">'.$i."</a></li>\n";
      }
    }
    
    function sort_hsgs($my, $hsg_array, $emph){
      $offset = 1/floatval(sizeof($hsg_array));
      
      for($i = 0; $i < sizeof($hsg_array); $i = $i + 1){
            $sorted[$i] = (calculate_points($my, $hsg_array[$i]['answers'], $emph)-($i*$offset));
            $temp[(string)(calculate_points($my, $hsg_array[$i]['answers'], $emph)-($i*$offset))] = $hsg_array[$i];
      }
      
      sort($sorted);

      for($i = 0; $i < sizeof($sorted); $i = $i + 1){
            $sorted[$i] = $temp[(string)$sorted[$i]];
      }
      
      $sorted = rev_arr($sorted);
      
      return $sorted;
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
    
    function print_pagination($curr_id, $theses_count){
	echo '<div class="pagination"><small>';
	echo '<ul>';
	for($i = 1; $i < ($theses_count+1); $i = $i + 1){
		echo pagitem($i, $curr_id);
	}
	echo '</ul>';
	echo '</small></div>';
    }
    

?>