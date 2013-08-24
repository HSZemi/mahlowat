<?php
    session_start();
    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    
    
    if(!isset($_SESSION['theses'])){
      $_SESSION['theses'] = get_theses_array();
    } 
    
    $theses_count = sizeof($_SESSION['theses']['s']);
    
    if(!isset($_SESSION['answers'])){
      // initialize answers-array
      for($i = 0; $i < $theses_count; $i++){
          $_SESSION['answers'][$i] = 'skip';
      }
    }
    
    if(isset($_POST['q_id'])){
      $q_id = intval($_POST['q_id']) + 1;
    } elseif(isset($_GET['id'])){
      $q_id = intval($_GET['id']) - 1;
    } else {
      $q_id = 0;
    }
    
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
    

    
    if($q_id >= $theses_count){
      header("Location: multiplier.php");
    } else {

    

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>mahlowat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <div class="container mow-container top-buffer">
  
      <div class="pagination">
        <ul>
           <?php 
            for($i = 1; $i < ($theses_count+1); $i = $i + 1){
                  echo pagitem($i, $q_id+1);
            }
           ?>
        </ul>
    </div>
    
    <h1>These <?php echo $q_id+1; ?></h1>
    <form class="form-horizontal" action="mahlowat.php" method="post">
        <input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
        <p class="statement">
            <?php echo $_SESSION['theses']['l'][$q_id]; ?>
        </p>
            <div class="controls">
            <?php
                  $curr_ans = $_SESSION['answers'][$q_id];
                  $yes_class = "btn";
                  $neutral_class = "btn";
                  $no_class = "btn";
                  $skip_class = "btn";
                  if(!($curr_ans === 'skip')){
                        if($curr_ans == 1){$yes_class .= " btn-success";}
                        if($curr_ans == 0){$neutral_class .= " btn-warning";}
                        if($curr_ans == -1){$no_class .= " btn-danger";}
                  } else {
				$yes_class .= " btn-success";
				$neutral_class .= " btn-warning";
				$no_class .= " btn-danger";
                  }
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
  
  </body>
</html>
<?php } ?>