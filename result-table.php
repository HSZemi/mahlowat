<?php
    session_start();
    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    include 'includes/hsg.php';
    
    $warning = false;
    if(!isset($_SESSION['answers'])){
      $warning = true;
      $_SESSION['answers'] = Array('skip','skip','skip','skip','skip','skip');
    }
    $ans = $_SESSION['answers'];

    if(!isset($_SESSION['theses'])){
      $_SESSION['theses'] = get_theses_array();
    } 
    
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
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
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
                  <a href="index.php" class="btn btn-primary">Thesen bearbeiten</a>
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
  
  <div class="container top-buffer">
    
    <h1>Ergebnisse</h1>
    
    <div class="pagination">
        <ul>
            <li class=""><a href="result-bars.php">Balken</a></li>
            <li class="active"><a href="result-table.php">Detail</a></li>
        </ul>
    </div>
    
    
    <table class="table table-bordered table-hover">
      <tr><th> </th><th>Deine Wahl</th>
      <?php 
      
      
      for($i = 0; $i < sizeof($hsg_array); $i = $i + 1){
            echo '<th>'.$hsg_array[$i]['name'].' ('.similarity_index($ans, $hsg_array[$i]['answers'], $emph).')</th>';   
      }
      echo "</tr>\n";
      
      for($i = 0; $i < sizeof($hsg_array); $i = $i + 1){
            $emph[$i]==2 ? $star = '<i class="icon-star" title="Doppelte Gewichtung"></i>' : $star = '';
            $emph[$i]==2 ? $tdcl = ' class="warning"' : $tdcl = '';
            echo '<tr'.$tdcl.'>';
            echo '<td><p class="text-center">'.$star.'</p></td>';
            echo '<td><a id="thesis'.$i.'" class="btn '.code_to_btnclass($ans[$i]).' btn-block" data-toggle="popover" data-placement="left" data-original-title="These '.($i+1).'" data-content="'.$_SESSION['theses']['l'][$i].'">'.$_SESSION['theses']['s'][$i].'</a></td>';
            for($hsg = 0; $hsg < sizeof($hsg_array); $hsg = $hsg + 1){
                  echo hsg_get_td($hsg_array[$hsg], $i);
            }
            echo "</tr>\n";
      }
      
      ?>
     </table>
    
    <div class="text-right">
    <hr />
      <small>Du kannst die Befragung 
      <a href="killsession.php" title="Von vorn beginnen">neu starten</a>,
      deine 
      <a href="index.php" title="Antworten ändern">Antworten ändern</a>
      oder die 
      <a href="multiplier.php" title="Gewichtung ändern">Gewichtung anpassen</a>.<br />
      Außerdem haben wir auch eine <a href="faq.php?from=result-table.php" title="FAQ">FAQ-Seite</a>.
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
      $('.hsganswer').tooltip();
  </script>


  
  </body>
</html>