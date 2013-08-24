<?php
    include '../includes/file.php';
    
    $visits = get_visits('', 'visits.sav');
    
    $max_visitors = 0;
    foreach($visits as $value){
        if(sizeof($value) > $max_visitors){
            $max_visitors = sizeof($value);
        } 
    }
    
    $max_visits = 0;
    foreach($visits as $value){
		$count = 0;
		foreach($value as $key => $v){
			$count += $v;
		}
		if($count > $max_visits){
            $max_visits = $count;
        } 
    }
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>mahlowat - Statistik</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
  
  <div class="container top-buffer">
  
	<div class="well">
	<h1>Besucher</h1>
	<p>Von wie vielen IP-Adressen wurde der Mahlowat aufgerufen?</p>
  
     <table class="table table-bordered table-hover">
     <tr><th style="width: 200px;">Datum</th><th style="width:100px">Besucher</th><th style="width:640px;">&nbsp;</th></tr>
            <?php
                  foreach($visits as $day => $value){
				$dayvisitors = sizeof($value);
                        
                        if($max_visitors != 0){
					$day_percentage = intval( 100 *  $dayvisitors / $max_visitors);
				} else {
					$day_percentage = 0;
				}
				
				$dayvisitors == $max_visitors ? $class = "success" : $class = "";
      
				echo "<tr class='$class'>
				<td><b>$day</b></td><td>$dayvisitors</td>
				<td><div class='progress'><div class='bar' title='$dayvisitors' style='width: $day_percentage%;'></div></div>
				</td>
				</tr>";
                  }
            ?>

     </table>
     </div>
     
     <div class="well">
     <h1>Durchläufe</h1>
	<p>Wie oft wurde die Gewichtungs-Seite aufgerufen?</p>
     
     <table class="table table-bordered table-hover">
     <tr><th style="width: 200px;">Datum</th><th style="width:100px">Durchläufe</th><th style="width:640px;">&nbsp;</th></tr>
            <?php
                  foreach($visits as $day => $value){
				$dayvisits = 0;
				foreach($value as $key => $v){
					$dayvisits += $v;
				}
                        
                        if($max_visits != 0){
					$day_percentage2 = intval( 100 *  $dayvisits / $max_visits);
				} else {
					$day_percentage2 = 0;
				}
				
				$dayvisits == $max_visits ? $class = "success" : $class = "";
      
				echo "<tr class='$class'>
				<td><b>$day</b></td><td>$dayvisits</td>
				<td><div class='progress'><div class='bar' title='$dayvisits' style='width: $day_percentage2%;'></div></div>
				</td>
				</tr>";
                  }
            ?>

     </table>
     </div>
     
      
  </div>
  
  </body>
</html>