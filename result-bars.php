<?php
    session_start();
    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    include 'includes/hsg.php';

    $warning = false;
    
    if(!isset($_SESSION['theses'])){
      $_SESSION['theses'] = get_theses_array();
    } 
    
    $theses_count = sizeof($_SESSION['theses']['s']);
    
    if(!isset($_SESSION['answers'])){
      $warning = true;
      for($i = 0; $i < $theses_count; $i++){
          $_SESSION['answers'][$i] = 'skip';
      }
    }
    $ans = $_SESSION['answers'];

    
    
    if(isset($_POST['multiplier'])){
      $_SESSION['multiplier'] = $_POST['multiplier'];
    } 
    
    $emph = array();
    for($i = 0; $i < sizeof($ans); $i = $i + 1){
                  $emph[$i]   = 1;
    }
    if(isset($_SESSION['multiplier'])){
      for($i = 0; $i < sizeof($ans); $i = $i + 1){
            if(in_array('q'.$i, $_SESSION['multiplier'])){
                  $emph[$i]   = 2;
            } else {
                  $emph[$i]   = 1;
            }
      }
    }
    
    $hsg_array = get_hsg_array();
    $hsg_array = sort_hsgs($ans, $hsg_array, $emph);
    
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>mahlowat - Ergebnis</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <div class="container top-buffer">
    
    <h1>Ergebnisse</h1>
    
    <div class="pagination">
        <ul>
            <li class="active"><a href="result-bars.php">Balken</a></li>
            <li class=""><a href="result-table.php">Detail</a></li>
        </ul>
    </div>
    
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
     <?php } ?>
     
     <table class="table table-bordered table-hover">
     <tr><th style="width: 200px;">Partei</th><th style="width:100px">Punkte</th><th style="width:640px;"> </th></tr>
            <?php
                  $top = calculate_points($ans, $hsg_array[0]['answers'], $emph);
                  for($i = 0; $i < sizeof($hsg_array); $i++){
                        (calculate_points($ans, $hsg_array[$i]['answers'], $emph) == $top) ? $class = "success" : $class = "";
                        html_hsg_bar($hsg_array[$i], $ans, $emph, $class);
                        echo "\n";
                  }
            ?>

     </table>
    
    <div class="text-right">
    <hr />
      <small>Du kannst die Befragung 
      <a href="killsession.php" title="Von vorn beginnen">neu starten</a>,
      deine 
      <a href="mahlowat.php" title="Antworten ändern">Antworten ändern</a>
      oder die 
      <a href="multiplier.php" title="Gewichtung ändern">Gewichtung anpassen</a>.<br />
      Außerdem haben wir auch eine <a href="faq.php?from=result-bars.php" title="FAQ">FAQ-Seite</a>.
      </small>
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