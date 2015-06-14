<?php

function print_result_detail_table($answers, $data){
	$theses_count = sizeof($data['theses']);
	for($i = 0; $i < sizeof($data['lists']); $i = $i + 1){
		$classname = string_to_css_classname($data['lists'][$i]['name']);
		echo "<th class='hidden-xs hidden-sm list-$classname'>{$data['lists'][$i]['name_x']} (".calculate_points($data['answers'][$i], $answers).")</th>";   
	}
	echo "</tr>\n";
	
	for($i = 0; $i < $theses_count; $i = $i + 1){
		char_to_multiply($answers[$i])==2 ? $star = '<span class="glyphicon glyphicon-star" title="Doppelte Gewichtung"></span>' : $star = '';
		char_to_multiply($answers[$i])==2 ? $tdcl = ' class="warning"' : $tdcl = '';
		$labelclass = code_to_labelclass(char_to_value($answers[$i]));
		echo "<tr$tdcl>\n";
		echo '<td><p class="text-center">'.$star.'</p></td>';
		echo '<td><a id="thesis'.$i.'" class="btn '.code_to_btnclass(char_to_value($answers[$i])).' btn-block" onclick="toggleNext(this)">'.$data['theses'][$i]['s'].'</a></td>';
		for($listid = 0; $listid < sizeof($data['lists']); $listid = $listid + 1){
			echo get_list_result_td($data, $listid, $i);
		}
		echo "</tr>\n";
		
		// Statements
		echo "<tr class='multheseslong'><td class='mtl'></td><td class='mtl' colspan='".(sizeof($data['lists'])+1)."'><!--<span class='label $labelclass'>These ".($i+1).": ".$data['theses'][$i]['s']."</span><br>--> <p class='well'>".$data['theses'][$i]['l']."</p>";
		for($listid = 0; $listid < sizeof($data['lists']); $listid = $listid + 1){
			echo get_list_statement($data, $listid ,$i);
		}
		echo "</td></tr>\n";
	}
}

function print_list_result_bar($data, $listindex, $answers, $class){
	$list_name = $data['lists'][$listindex]['name_x'];
	$list_points = calculate_points($data['answers'][$listindex], $answers);
	$ach_points = count_achievable_points($answers);
	if($ach_points != 0){
		$list_percentage = intval( 100 *  $list_points / $ach_points);
	} else {
		$list_percentage = 0;
	}
	
	echo "<tr class='$class'>
	<td><b>$list_name</b></td><td>$list_points von $ach_points</td>
	<td><div class='progress'>
		<div class='progress-bar' role='progressbar' aria-valuenow='$list_points' aria-valuemin='0' aria-valuemax='$ach_points' style='width: $list_percentage%;'>
			$list_percentage %
		</div>
	</div></td>
	</tr>";
     
}

/* unused
function print_list_result_bar_tricolore($list, $votes, $emph, $class){
      $list_name = $list['name'];
      $list_percentage_equal = intval( 100 * count_equal_answers($list['answers'], $votes) / count_relevant_answers($votes));
      $list_percentage_contrary = intval( 100 * count_contrary_answers($list['answers'], $votes) / count_relevant_answers($votes));
      $list_percentage_medium = 100 - $list_percentage_equal - $list_percentage_contrary;
      
     echo "<tr class='$class'>
     <td><b>$list_name</b></td><td>$list_percentage_equal %</td>
     <td><div class='progress'>
      <div class='bar bar-success' style='width: $list_percentage_equal%;'></div>
      <div class='bar bar-warning' style='width: $list_percentage_medium%;'></div>
      <div class='bar bar-danger' style='width: $list_percentage_contrary%;'></div>  
      </div>
     </td>
     </tr>";
}*/

function get_list_result_td($data, $listid, $thesisid){
	$vote = char_to_value($data['answers'][$listid][$thesisid]['selection']);
	$listclass = "list-".string_to_css_classname($data['lists'][$listid]['name']);
	
	if($vote === 'skip'){
		return "<td class='hidden-xs hidden-sm $listclass'><a class='btn btn-default btn-block disabled listanswer' >-</a></td>\n";
	}
	if($vote == 1){
		return "<td class='hidden-xs hidden-sm $listclass'><a class='btn btn-success btn-block disabled listanswer' ><span class='glyphicon glyphicon-thumbs-up'></span></a></td>\n";
	}
	if($vote == 0){
		return "<td class='hidden-xs hidden-sm $listclass'><a class='btn btn-warning btn-block disabled listanswer' ><span class='glyphicon glyphicon-tree-deciduous'></span></a></td>\n";
	}
	if($vote == -1){
		return "<td class='hidden-xs hidden-sm $listclass'><a class='btn btn-danger btn-block disabled listanswer' ><span class='glyphicon glyphicon-thumbs-down'></i></a></td>\n";
	}
}

    
function get_list_statement($data, $listid, $thesisid){
	$vote  = char_to_value($data['answers'][$listid][$thesisid]['selection']);
	$etext = $data['answers'][$listid][$thesisid]['statement'];
	$name  = $data['lists'][$listid]['name'];
	$listclass = "list-".str_replace(' ','',$data['lists'][$listid]['name']);
	$prefix = "";
	
	if($vote === 'skip'){
		$prefix = "<span class='label label-default'>$name</span>\n";
	}
	elseif($vote == 1){
		$prefix = "<span class='label label-success'>$name</span>\n";
	}
	elseif($vote == 0){
		$prefix = "<span class='label label-warning'>$name</span>\n";
		}
	elseif($vote == -1){
		$prefix = "<span class='label label-danger'>$name</span>\n";
	}
	
	return "<div class='$listclass'>
	$prefix 
	<p>$etext</p>
	</div>\n\n";
}

function code_to_btnclass($int){
	if($int === 'skip'){
		return 'btn-default';
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
    
function pagitem($i, $curr){
	if($i == $curr){
		return '<li class="active"><a href="#">'.$i."</a></li>\n";
	} else {
		return '<li class=""><a href="mahlowat.php?id='.$i.'">'.$i."</a></li>\n";
	}
}

function print_pagination($theses_count){
	echo '<ul id="navigation" class="pagination pagination-sm">';
	for($i = 1; $i < ($theses_count+1); $i = $i + 1){
		echo "<li><a href='#$i' onclick='loadThesis($i)'>$i</a></li>";
	}
	echo '</ul>';
}

function print_thesesbox($theses, $form=false, $list=null){
	echo '<div id="thesesbox">';
	
	for($q_id = 0; $q_id < count($theses); $q_id++){
		echo "<div id='thesis$q_id' class='singlethesis'>";
		echo "<h1>These ".($q_id+1)."</h1>

		<div class='well well-large statement'>
		<p style='margin-bottom: 0px;' class='lead'>";
		
		echo $theses[$q_id]['l'];
		echo "</p>";
		if($theses[$q_id]['x'] != ''){
			echo "<button class='btn btn-link explanationbutton'>Erklärung</button>\n";
			echo "<div class='explic'>".$theses[$q_id]['x']."</div>";
		}
		echo "</div>";
		
		if($form){
			$input = $list['comments'][$q_id];
			echo "<div class='row'>
			<div class='col-xs-12 col-sm-12 col-md-8 col-md-offset-2'>
				<textarea id='input-$q_id' name='comments[$q_id]' class='form-control' rows='3' placeholder='Hier die Begründung eingeben...'>$input</textarea>
			</div>
			</div>";
		}
		
		echo "</div>";
	}
	echo '</div>';
}

?>