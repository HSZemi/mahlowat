<?php
    session_start();
    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    include 'includes/file.php';
    
    
    
    $theses = get_theses_array();
    
    $theses_count = sizeof($theses['s']);
    
    $warning = false;
    if(!isset($_SESSION['answers'])){
      $warning = true;
      for($i = 0; $i < $theses_count; $i++){
          $_SESSION['answers'][$i] = 'skip';
      }
    }
    $ans = $_SESSION['answers'];
    
    
    /*if(isset($_POST['multiplier'])){
      $_SESSION['multiplier'] = $_POST['multiplier'];
    } */
    
    $emph = array();
    for($i = 0; $i < sizeof($ans); $i = $i + 1){
                  $emph[$i]   = 1;
    }
    if(isset($_SESSION['multiplier'])){
      for($i = 0; $i < sizeof($ans); $i = $i + 1){
            if(in_array('q'.$i, $_SESSION['multiplier'])){
                  $emph[$i]   = 2;
            }
      }
    }
    
    
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Mahlowat - Ergebnis</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/mahlowat-m.js"></script>
  
    <?php if($warning){ ?>
      <div id="warning" class="modal hide fade">
            <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h3>Hoppla...</h3>
            </div>
            <div class="modal-body">
                  <p><strong>Anscheinend hast du keine Fragen beantwortet.</strong><br />
                  Entweder musst du auf dieser Seite Cookies zulassen, oder du hast die Thesen wirklich noch nicht bearbeitet.</p> 
                  <p>Falls letzteres zutrifft, möchten wir dir empfehlen, dies nun zu tun.</p>
            </div>
            <div class="modal-footer">
                  <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Schließen</button>
                  <a href="mahlowat.php" class="btn btn-primary">Thesen bearbeiten</a>
            </div>
      </div>
      
      <script type="text/javascript">
      $(document).ready(function() {
            setTimeout(function(){
                  $('#warning').modal('show');
            }, 1000);
      });
      </script>
     <?php } else {
		add_visit(crypt($_SERVER['REMOTE_ADDR'], get_salt('./data/salt.sav')), './data/visits.sav');
     } ?>
  
  <div class="container mow-container" style="margin-top: 20px;">
      <img src="img/mahlowat_logo.png" title="Mahlowat Logo" class="pull-right" onclick="changeText()"/>
	<p id="spruch" class="pull-right"></p>
	
      <div class="bottom-buffer top-buffer">
    
    <h1>Ergebnisse</h1>
    <form action="result-bars.php" method="post">
      <table class="table table-bordered">
            <tr><th style="width: 320px;">Deine Wahl</th><th>Doppelt gewichten</th>
            <?php 
            
      
            
            for($i = 0; $i < sizeof($ans); $i = $i + 1){
                  ($emph[$i] == 2) ? $checked = "checked='checked'" : $checked = "";
                  $btnclass = code_to_btnclass($ans[$i]);
                  $labelclass = code_to_labelclass($ans[$i]);
                  echo "<tr>";
                  echo "<td><a id='thesis$i' class='btn $btnclass btn-block' onclick='toggleNext(this)'>".$theses['s'][$i]."</a></td>
                  <td><input type='checkbox' $checked name='multiplier[]' value='q$i'></td>";
                  echo "</tr>\n";
                  echo "<tr class='multheseslong'><td class='mtl' colspan='2'><!--<span class='label $labelclass'>These ".($i+1).": ".$theses['s'][$i]."</span><br>--> ".$theses['l'][$i]."</td></tr>";
            }
            
            ?>     
      </table>
      <button class="btn btn-primary" type="submit">Zur Auswertung</button>
    </form>
    
    <div class="text-right">
    <hr />
      <small>Du kannst die Befragung 
      <a href="killsession.php" title="Von vorn beginnen">neu starten</a>
      oder deine
      <a href="mahlowat.php" title="Antworten ändern">Antworten ändern</a>.<br />
      Außerdem haben wir auch eine <a href="faq.php?from=multiplier.php" title="FAQ">FAQ-Seite</a>.
      </small>
    </div>
    </div>
  </div>
  
  <script type="text/javascript">
  <?php 
      
      for($i = 0; $i < sizeof($ans); $i++){
            echo "$('#thesis".$i."').popover();\n";
      }
      
  ?>
  
  $('.multheseslong').hide();
  $('.tt').tooltip();
  
  function toggleNext(caller){
	$(caller).parent().parent().next().toggle();
  }
  </script>


  
  </body>
</html>