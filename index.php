<?php
    session_start();
    
    include 'includes/funcs.php';
    
    if(!isset($_SESSION['answers'])){
      $_SESSION['answers'] = Array(0,0,0,0,0,0);
      $_SESSION['theses']['l'] = Array(
      'Die UniCard muss so schnell wie möglich eingeführt werden!',
      'Der VeggieDay ist des Teufels.',
      'Vorwärts immerdar!',
      'Das mit der IT-Technik muss der AStA noch lernen',
      'Das NRW-Ticket ist eine tolle Einrichtung.',
      'Der radikale Links-AStA muss umgehend abgewählt werden.'
  );
      $_SESSION['theses']['s'] = Array(
      'UniCard',
      'VeggieDay',
      'Vorwärts',
      'IT-Technik',
      'NRW-Ticket',
      'Links-AStA'
   );
    }
    
    if(!isset($_POST['q_id'])){
      $q_id = -1;
    } else {
      $q_id = intval($_POST['q_id']) + 1;
    }
    
    // check if last answer was yes, neutral, no or skip
    if(isset($_POST['yes'])){
      $_SESSION['answers'][$q_id] = 1;
    }
    if(isset($_POST['neutral'])){
      $_SESSION['answers'][$q_id] = 2;
    }
    if(isset($_POST['no'])){
      $_SESSION['answers'][$q_id] = 3;
    }
    if(isset($_POST['skip'])){
      $_SESSION['answers'][$q_id] = 0;
    }
    
    if($q_id > 4){
      header("Location: multiplier.php");
    } else {

    

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>mahlowat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <div class="container top-buffer">
  
      <div class="pagination pagination-large">
        <ul>
           <?php 
            for($i = 1; $i < sizeof($_SESSION['answers'])+1; $i = $i + 1){
                  echo pagitem($i, $q_id+2);
            }
           ?>
        </ul>
    </div>
    
    <h1>These <?php echo $q_id+2; ?></h1>
    <form class="form-horizontal" action="index.php" method="post">
        <input type="hidden" name="q_id" value="<?php echo $q_id; ?>">
        <p class="statement">
            <?php echo $_SESSION['theses']['l'][$q_id+1]; ?>
        </p>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-success" name="yes"><i class="icon-thumbs-up"></i> Zustimmung</button>
                <button type="submit" class="btn btn-warning" name="neutral"><i class="bg-icon-circle"></i> Neutral</button>
                <button type="submit" class="btn btn-danger" name="no"><i class="icon-thumbs-down"></i> Ablehnung</button>

                <button type="submit" class="btn" name="skip"><i class="icon-share-alt"></i> Überspringen</button>
            </div>
        </div>
    </form>
    
    <div class="alert alert-info">
      <?php print_r($_SESSION['answers']); ?><br />
      
      <a href="killsession.php" title="Session neu starten">Session neu starten</a>
    </div>
    </div>
  </div>
  
  </body>
</html>
<?php } ?>