<?php
    session_start();
    
    include 'includes/funcs.php';
    
    if(!isset($_SESSION['answers'])){
      print("ERROR: NO SESSION ANSWERS FOUND!");
    } else {
      $ans = $_SESSION['answers'];
    }
    
    $mul = Array(1,1,1,1,1,1);
    if(isset($_POST['multiplier'])){
      $_SESSION['multiplier'] = $_POST['multiplier'];
    }
    
    if(isset($_SESSION['multiplier'])){
      for($i = 0; $i < sizeof($ans); $i = $i + 1){
            if(in_array('q'.$i, $_SESSION['multiplier'])){
                  $mul[$i] = 2;
            }
      }
    }
    
    $hsg_array[0]['name'] = 'GHG';
    $hsg_array[1]['name'] = 'RCDS';
    $hsg_array[2]['name'] = 'Jusos';
    $hsg_array[3]['name'] = 'LUST';
    $hsg_array[4]['name'] = 'Piraten';
    $hsg_array[5]['name'] = 'LHG';

    $hsg_array[0]['answers'] = Array(1,0,0,0,0,0);
    $hsg_array[1]['answers'] = Array(3,3,3,3,2,1);
    $hsg_array[2]['answers'] = Array(1,2,1,1,3,2);
    $hsg_array[3]['answers'] = Array(0,1,2,3,0,1);
    $hsg_array[4]['answers'] = Array(3,3,2,1,2,1);
    $hsg_array[5]['answers'] = Array(1,1,1,3,1,3);
    
    $hsg_array = sort_hsgs($ans, $hsg_array, $mul);
    
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>mahlowat - Ergebnis</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <div class="container top-buffer">
    
    <h1>Ergebnisse</h1>
    
    <table class="table table-bordered table-hover">
      <tr><th> </th><th>Deine Wahl</th>
      <?php 
      
      for($i = 0; $i < sizeof($hsg_array); $i = $i + 1){
            echo '<th>'.$hsg_array[$i]['name'].' ('.similarity_index($ans, $hsg_array[$i]['answers'], $mul).')</th>';   
      }
      echo "</tr>\n";
      
      for($i = 0; $i < sizeof($hsg_array); $i = $i + 1){
            $mul[$i]==2 ? $star = '<i class="icon-star"></i>' : $star = '';
            $mul[$i]==2 ? $tdcl = ' class="warning"' : $tdcl = '';
            echo '<tr'.$tdcl.'>';
            echo '<td><p class="text-center">'.$star.'</p></td>';
            echo '<td><a id="thesis'.$i.'" class="btn '.int_to_btnclass($ans[$i]).' btn-block" data-toggle="popover" data-placement="left" data-original-title="These '.($i+1).'" data-content="'.$_SESSION['theses']['l'][$i].'">'.$_SESSION['theses']['s'][$i].'</a></td>';
            for($hsg = 0; $hsg < sizeof($hsg_array); $hsg = $hsg + 1){
                  echo int_to_td($hsg_array[$hsg]['answers'][$i]);
            }
            echo "</tr>\n";
      }
      
      ?>     
     </table>
    
    <div class="alert alert-info">
      <?php print_r($_SESSION['answers']); ?><br />
      
      <a href="killsession.php" title="Session neu starten">Session neu starten</a>
    </div>
    </div>
  </div>
  
  <script type="text/javascript">
  <?php 
      
      for($i = 0; $i < 6; $i = $i + 1){
            echo "$('#thesis".$i."').popover();";
      }
      
  ?>
  </script>


  
  </body>
</html>