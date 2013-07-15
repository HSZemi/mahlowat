<?php

function int_to_answer($int){
      if($int == 0){
            return '-';
      }
      if($int == 1){
            return 'Zustimmung';
      }
      if($int == 2){
            return 'Neutral';
      }
      if($int == 3){
            return 'Ablehnung';
      }
    }
    
    function int_to_td($int){
      if($int == 0){
            return '<td><button class="btn btn-block disabled">-</button></td>';
      }
      if($int == 1){
            return '<td><button class="btn btn-success btn-block disabled"><i class="icon-thumbs-up"></i></button></td>';
      }
      if($int == 2){
            return '<td><button class="btn btn-warning btn-block disabled"><i class="bg-icon-circle"></i></button></td>';
      }
      if($int == 3){
            return '<td><button class="btn btn-danger btn-block disabled"><i class="icon-thumbs-down"></i></button></td>';
      }
    }
    
    function int_to_btnclass($int){
      if($int == 0){
            return '';
      }
      if($int == 1){
            return 'btn-success';
      }
      if($int == 2){
            return 'btn-warning';
      }
      if($int == 3){
            return 'btn-danger';
      }
    }
    
    function similarity_index($my, $hsg, $mul){
      $max = max(sizeof($my), sizeof($hsg));
      
      $pointvector = Array();
      /*  my = skip:                +0
       *  my != skip && hsg = skip: -1
       *  my = hsg:                 +2
       * |my - hsg| = 1:            -1
       * |my - hsg| = 2:            -2
       */
      for($i = 0; $i < $max; $i = $i + 1){
            $pointvector[$i] = 0;
            if($my[$i] == 0){continue;}
            elseif($my[$i] != 0 and $hsg[$i] == 0){$pointvector[$i] = -1;}
            elseif($my[$i] == $hsg[$i]){$pointvector[$i] = 2;}
            elseif(abs($my[$i] - $hsg[$i]) == 1){$pointvector[$i] = -1;}
            elseif(abs($my[$i] - $hsg[$i]) == 2){$pointvector[$i] = -2;}
            else {print 'my:'.$my[$i].', hsg:'.$hsg[$i].'<br />';}
      }
      
      $pointvector = vec_mul($pointvector, $mul);
      
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
            return '<li class="disabled"><a href="#">'.$i."</a></li>\n";
      }
    }
    
    function sort_hsgs($my, $hsg_array, $mul){
      $offset = 1/floatval(sizeof($hsg_array));
      
      for($i = 0; $i < sizeof($hsg_array); $i = $i + 1){
            $sorted[$i] = (similarity_index($my, $hsg_array[$i]['answers'], $mul)-($i*$offset));
            $temp[(string)(similarity_index($my, $hsg_array[$i]['answers'], $mul)-($i*$offset))] = $hsg_array[$i];
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