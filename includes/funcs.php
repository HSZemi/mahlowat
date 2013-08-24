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
      return similarity_index($votes, $hsg, $emph);
}

function html_hsg_bar($hsg, $votes, $emph, $class){
      $hsg_name = $hsg['name'];
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
            return "<td><a class='btn btn-block disabled hsganswer' $popover>-</a></td>";
      }
      if($vote == 1){
            return "<td><button class='btn btn-success btn-block disabled hsganswer' $popover><i class='icon-thumbs-up'></i></button></td>";
      }
      if($vote == 0){
            return "<td><button class='btn btn-warning btn-block disabled hsganswer' $popover><i class='bg-icon-circle'></i></button></td>";
      }
      if($vote == -1){
            return "<td><button class='btn btn-danger btn-block disabled hsganswer' $popover><i class='icon-thumbs-down'></i></button></td>";
      }
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
    
    function similarity_index($my, $hsg, $emph){
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
    
    function vec_mul2($a, $b){
      if(sizeof($a) != sizeof($b)){
            echo 'vector2 dimensions do not match|'.sizeof($a).'|'.sizeof($b).'<br />';
      } else {
            $sum = 0;
            for($i = 0; $i < sizeof($a); $i = $i + 1){
                  $sum += $a[$i] * $b[$i];
            }
            return $sum;
      }
    }
    
    function vec_abs($a){
      $sum = 0;
      for($i = 0; $i < sizeof($a); $i++){
            $sum += ($a[$i] * $a[$i]);
      }
      
      return sqrt($sum);
    }
    
    function cosalpha($a, $b){
      if(vec_abs($a) * vec_abs($b) == 0){
            return 0;
      } else {
            return vec_mul2($a, $b) / (vec_abs($a) * vec_abs($b));
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
            $sorted[$i] = (similarity_index($my, $hsg_array[$i]['answers'], $emph)-($i*$offset));
            $temp[(string)(similarity_index($my, $hsg_array[$i]['answers'], $emph)-($i*$offset))] = $hsg_array[$i];
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
    

?>