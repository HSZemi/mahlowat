<?php
    session_start();
    
    include 'includes/funcs.php';
    
    if(!isset($_SESSION['answers'])){
      print("ERROR: NO SESSION ANSWERS FOUND!");
    } else {
      $ans = $_SESSION['answers'];
    }
    
    
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
    <form action="result.php" method="post">
      <table class="table table-bordered">
            <tr><th>Deine Wahl</th><th>Doppelt gewichten</th>
            <?php 
            
      
            
            for($i = 0; $i < sizeof($ans); $i = $i + 1){
                  echo '<tr>';
                  echo '<td><a id="thesis'.$i.'" class="btn '.int_to_btnclass($ans[$i]).' btn-block" data-toggle="popover" data-placement="left" data-original-title="These '.($i+1).'" data-content="'.$_SESSION['theses']['l'][$i].'">'.$_SESSION['theses']['s'][$i].'</a></td>
                  <td><input type="checkbox" name="multiplier[]" value="q'.$i.'"></td>';
                  echo "</tr>\n";
            }
            
            ?>     
      </table>
      <button class="btn btn-primary" type="submit">Zur Auswertung</button>
    </form>
    
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