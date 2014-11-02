<?php    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    
    
    
    $theses = get_theses_array();

    $theses_count = sizeof($theses['s']);
    
    $ans = Array();
    $emph = Array();
    $answerstring = '';
    $warning = false;
    
    if(!isset($_GET['ans'])){
      $warning = true;
      for($i = 0; $i < $theses_count; $i++){
          $ans[$i] = 'skip';
          $emph[$i] = 1;
      }
    } else {
		$answerstring = $_GET['ans'];
		$retval = result_from_string($answerstring, $theses_count);
		$ans = $retval[0];
		$emph = $retval[1];
    }
    
    
?>
<!DOCTYPE html>
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
	<div id="warning" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Hoppla...</h4>
				</div>
				<div class="modal-body">
					<p><strong>Anscheinend hast du keine Fragen beantwortet.</strong><br />
                  Entweder hast du diese Seite direkt aufgerufen, oder du hast die Thesen noch nicht bearbeitet.</p> 
                  <p>Falls letzteres zutrifft, möchten wir dir empfehlen, dies nun zu tun.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
					<a href="mahlowat.php" class="btn btn-primary">Thesen bearbeiten</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
      
      <script type="text/javascript">
      $(document).ready(function() {
            setTimeout(function(){
                  $('#warning').modal('show');
            }, 500);
      });
      </script>
     <?php } ?>
  
  <div class="container mow-container" style="margin-top: 20px;">
      <img src="img/mahlowat_logo.png" title="Mahlowat Logo" class="pull-right" onclick="changeText()"/>
	<p id="spruch" class="pull-right"></p>
	
      <div class="bottom-buffer top-buffer">
    
    <h1>Ergebnisse</h1>
      <table class="table table-bordered">
            <tr><th style="width: 320px;">Deine Wahl</th><th>Doppelt gewichten</th>
            <?php 
            
      
            
            for($i = 0; $i < sizeof($ans); $i = $i + 1){
                  ($emph[$i] == 2) ? $active = "btn-info active" : $active = "btn-default";
                  ($emph[$i] == 2) ? $multbutton = "These wird doppelt gewichtet" : $multbutton = "These doppelt gewichten";
                  $btnclass = code_to_btnclass($ans[$i]);
                  $labelclass = code_to_labelclass($ans[$i]);
                  echo "<tr>";
                  echo "<td><a id='thesis$i' class='btn $btnclass btn-block' onclick='toggleNext(this)'>".$theses['s'][$i]."</a></td>
                  <td><button id='thesis$i-multiply' class='btn btn-block weight $active' data-toggle='button'>$multbutton</button></td>";
                  echo "</tr>\n";
                  echo "<tr class='multheseslong'><td class='mtl' colspan='2'><!--<span class='label $labelclass'>These ".($i+1).": ".$theses['s'][$i]."</span><br>--> ".$theses['l'][$i]."</td></tr>";
            }
            
            ?>     
      </table>
      <button id="commit" class="btn btn-primary">Neu Auswerten</button>
    
    <div class="text-right">
    <hr />
      <small>Du kannst die Befragung 
      <a href="index.php" title="Von vorn beginnen">neu starten</a>
      oder deine
      <a href="mahlowat.php" title="Antworten ändern">Antworten ändern</a>.<br />
      Außerdem haben wir auch eine <a href="faq.php?from=multiplier.php" title="FAQ">FAQ-Seite</a>.
      </small>
    </div>
    </div>
  </div>
  
  <script type="text/javascript">
  var answerstr = "<?php echo $answerstring;?>";
  var thesescount = $('.weight').length;
  var resultArray = getResultArray(answerstr, thesescount);
  
  $('#commit').click(function(){
	multipliers = $('.weight');
	for(i = 0; i < multipliers.length; i++){
		if(multipliers.eq(i).hasClass('btn-info')){
			resultArray[i] = result2letter(resultArray[i], true);
		} else {
			resultArray[i] = result2letter(resultArray[i], false);
		}
	}
	gotoResultPage(resultArray);
  });
  $('.multheseslong').hide();
  $('.tt').tooltip();
  
  $('.weight').click(function(){
		$(this).toggleClass('btn-default');
		$(this).toggleClass('btn-info');
		if($(this).text() == 'These doppelt gewichten'){
			$(this).text('These wird doppelt gewichtet');
		} else {
			$(this).text('These doppelt gewichten');
		}
	});
  
  function toggleNext(caller){
	$(caller).parent().parent().next().toggle();
  }
  
  function gotoResultPage(result){
		target = "result.php?ans=";
		
		for(i = 0; i < result.length; i++){
			target += result[i];
		}
		jQuery.get("count.php");
		window.location.href = target;
	}
	
	function getResultArray(answerstring, count){
		arr = [];
		if(answerstring.length != count){
			for(i = 0; i < count; i++){
				arr[i] = 'd'; //no selection
			}
		} else {
			items = answerstring.split("");
			for(i = 0; i < items.length; i++){
				if(items[i] <= 'f' && items[i] >= 'a'){
					arr[i] = items[i];
				} else {
					arr[i] = 'd';
				}
			}
		}
		return arr;
	}
	
	function result2letter(letterIn, multiply){
		if(multiply){
			if(letterIn == 'a'){
				return 'e'
			} else if(letterIn == 'b'){
				return 'f';
			} else if(letterIn == 'c'){
				return 'g';
			} else if(letterIn == 'd'){
				return 'h';
			} else {
				return letterIn;
			}
		} else {
			if(letterIn == 'e'){
				return 'a';
			} else if(letterIn == 'f'){
				return 'b';
			} else if(letterIn == 'g'){
				return 'c';
			} else if(letterIn == 'h'){
				return 'd';
			} else {
				return letterIn;
			}
		} 
	}
  </script>


  
  </body>
</html>