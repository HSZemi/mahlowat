<?php
    session_start();
    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    //include 'includes/spruch.php';
    
    if(isset($_GET['new'])){
      if(intval($_GET['new']) == 42){
        session_destroy();
        session_start();
      }
    }
    
    

    $theses = get_theses_array();

    
    $theses_count = sizeof($theses['s']);
    
    if(!isset($_SESSION['answers'])){
      // initialize answers-array
      for($i = 0; $i < $theses_count; $i++){
          $_SESSION['answers'][$i] = 'skip';
      }
    }
    
    if(!isset($_SESSION['multiplier'])){
	$_SESSION['multiplier'] = Array();
    }
    
    if(isset($_POST['q_id'])){
      $q_id = intval($_POST['q_id']) + 1;
    } elseif(isset($_GET['id'])){
      $q_id = intval($_GET['id']) - 1;
    } else {
      $q_id = 0;
    }
    
    // check if q_id is valid
    if(isset($_SESSION['answers'][$q_id-1])){
      // check if last answer was yes, neutral, no or skip
	if(isset($_POST['yes'])){
		$_SESSION['answers'][$q_id-1] = 1;
	}
	if(isset($_POST['neutral'])){
		$_SESSION['answers'][$q_id-1] = 0;
	}
	if(isset($_POST['no'])){
		$_SESSION['answers'][$q_id-1] = -1;
	}
	if(isset($_POST['skip'])){
		$_SESSION['answers'][$q_id-1] = 'skip';
	}
    }
    
    if(isset($_POST['multiply'])){
        if(!in_array($_POST['multiply'], $_SESSION['multiplier'])){
            $_SESSION['multiplier'][] = $_POST['multiply'];
        }
    } else { // delete from $_SESSION['multiplier']
        if(in_array('q'.($q_id-1), $_SESSION['multiplier'])){
            $pos=array_search('q'.($q_id-1),$_SESSION['multiplier']);
            unset($_SESSION['multiplier'][$pos]);
        }
    }
    

    
    if($q_id >= $theses_count){
      header("Location: multiplier.php");
      die();
    } else {
    
        $ans = $_SESSION['answers'];
        
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
    <title>Mahlowat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/mahlowat.js"></script>
  
  <div class="container mow-container" style="margin-top: 20px;">
      <img src="img/mahlowat_logo.png" title="Mahlowat Logo" class="pull-right" onclick="changeText('mahlowat')"/>
	<p id="spruch" class="pull-right"></p>
      <div class="bottom-buffer top-buffer">
  
      <?php print_pagination($q_id+1, $theses_count); ?>

    
    <h1>These <?php echo $q_id+1; ?></h1>
    
        <div class="well well-large statement">
        <p style="margin-bottom: 0px;" class="lead"><b>
            <?php 
			if($q_id < 0){
				echo "Es gibt keine These mit der ID ".($q_id+1).". Entweder ist ein Fehler aufgetreten, oder du spielst herum.";
			} else {
				echo $theses['l'][$q_id];
			}
		?>
        </b></p>
        <?php 
		if($theses['x'][$q_id] != ''){
			echo "<button class='btn btn-link' onclick='etoggle()'>Erklärung</button>\n";
			echo "<div class='explic'>".$theses['x'][$q_id]."</div>";
		}
        ?>
        </div>
            <form class="form-horizontal" action="mahlowat.php" method="post">
        <input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
            <div class="controls">
            <?php
                  if($q_id < 0){
				$curr_ans = 'skip';
			}else{
				$curr_ans = $_SESSION['answers'][$q_id];
			}
                  $yes_class = "btn";
                  $neutral_class = "btn";
                  $no_class = "btn";
                  $skip_class = "btn btn-link";
                  if(!($curr_ans === 'skip')){
                        if($curr_ans == 1){$yes_class .= " btn-success";}
                        if($curr_ans == 0){$neutral_class .= " btn-warning";}
                        if($curr_ans == -1){$no_class .= " btn-danger";}
                  } else {
				$yes_class .= " btn-success";
				$neutral_class .= " btn-warning";
				$no_class .= " btn-danger";
                  }
                  ($emph[$q_id] == 2) ? $checked = "checked='checked'" : $checked = "";
                  echo "<p class='text-center'><label><input type='checkbox' $checked name='multiply' value='q$q_id'> <small>These doppelt gewichten</small></label></p>";
                  echo "<button type='submit' class='$yes_class' name='yes'><i class='icon-thumbs-up'></i> Zustimmung</button>
                  <button type='submit' class='$neutral_class' name='neutral'><i class='bg-icon-circle'></i> Neutral</button>
                  <button type='submit' class='$no_class' name='no'><i class='icon-thumbs-down'></i> Ablehnung</button>
                 <button type='submit' class='$skip_class' name='skip'><i class='icon-share-alt'></i> Überspringen</button>";
            ?>
            </div>
    </form>
    
    <div class="text-right">
    <hr />
      <small>Du kannst die Befragung 
      <a href="killsession.php" title="Von vorn beginnen">neu starten</a>
      oder den Rest der Thesen 
      <a href="multiplier.php" title="Gewichtung ändern">überspringen</a>.<br />
      Außerdem haben wir auch eine <a href="faq.php?from=mahlowat.php?id=<?php echo $q_id+1; ?>" title="FAQ">FAQ-Seite</a>.
      </small>
      
    </div>
    </div>
  </div>
  <script type="text/javascript">
  $('.tt').tooltip();
  $('.explic').hide();
  function etoggle(){
	$('.explic').toggle();
  }
  </script>
  </body>
</html>
<?php } ?>