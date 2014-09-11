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

	<div id="savemodal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Statistik</h4>
				</div>
				<div class="modal-body">
					Erlaubst du, dass dein Aufruf für die Statistik gezählt wird?<br>
					<small>Falls du Nein auswählst, bist du lediglich als Logeintrag auf dem Server verewigt.</small>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="callResult(false)" style="width: 100px;"><span class="glyphicon glyphicon-remove"></span> Nein</button>
					<button type="button" class="btn btn-primary" onclick="callResult(true)" style="width: 100px;"><span class="glyphicon glyphicon-ok"></span> Ja</button>
				</div>
			</div>
		</div>
	</div>
  
  <div class="container" style="margin-top: 20px;">
	<img src="img/mahlowat_logo.png" title="Mahlowat Logo" class="pull-right" onclick="changeText('mahlowat')"/>
	<p id="spruch" class="pull-right"></p>
	<div class="bottom-buffer top-buffer">
  
		<?php print_pagination($theses_count); ?>
		
		<?php print_thesesbox($theses); ?>

		<p class='text-center'><button id="weight" type="button" class="btn btn-default" data-toggle="button">These doppelt gewichten</button></p>

			<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-2 col-md-offset-2">
				<button id='yes' type='submit' class='btn btn-success btn-block' name='yes' onclick="nextThesis('a')"><span class="glyphicon glyphicon-thumbs-up"></span> Zustimmung</button>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 ">
				<button id='neutral' type='submit' class='btn btn-warning btn-block' name='neutral' onclick="nextThesis('b')"><span class="glyphicon glyphicon-tree-deciduous"></span> Neutral</button>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2">
				<button id='no' type='submit' class='btn btn-danger btn-block' name='no' onclick="nextThesis('c')"><span class="glyphicon glyphicon-thumbs-down"></span> Ablehnung</button>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2">
				<button id='skip' type='submit' class='btn btn-default btn-block' name='skip' onclick="nextThesis('d')"><span class="glyphicon glyphicon-share-alt"></span> Überspringen</button>
			</div>
			</div>
		
		
		<div class="text-right">
			<hr />
			<small>Du kannst die Befragung 
			<a href="index.php" title="Von vorn beginnen">neu starten</a>
			oder den Rest der Thesen 
			<a href="#" title="Auswertung anzeigen" onclick="gotoResultPage(resultArray)">überspringen</a>.<br />
			Außerdem haben wir auch eine <a href="#" onclick="gotoFAQPage(resultArray)" title="FAQ">FAQ-Seite</a>.
			</small>
		
		</div>
	</div>
  </div>
  <script type="text/javascript">
  var resultArray;
  var activeThesis = 0;
  var answerstring = '<?php echo $answerstring; ?>';
  
  $(function(){
	$('.tt').tooltip();
	$('.explic').hide();
	$('#weight').click(function(){
		$('#weight').toggleClass('btn-default');
		$('#weight').toggleClass('btn-info');
		if($('#weight').text() == 'These doppelt gewichten'){
			$('#weight').text('These wird doppelt gewichtet');
		} else {
			$('#weight').text('These doppelt gewichten');
		}
	});
	$('.explanationbutton').click(function(){
		$('.explic').toggle();
	})
	
	thesesboxes = $('.singlethesis');	
	pagination = $('#navigation li');
	
	resultArray = getResultArray(answerstring, thesesboxes.length);
	
	setPaginationColors(resultArray);
	
	// Remove the # from the hash, as different browsers may or may not include it
	var hash = location.hash.replace('#','');
	
	if(hash != '' && jQuery.isNumeric(hash)){
		// Show the hash if it's set
		loadThesis(hash);
	} else {
		loadThesis(activeThesis+1);
	}
	
	});
	
	function gotoResultPage(result){
		target = "result-bars.php?ans=";
		
		for(i = 0; i < result.length; i++){
			target += result[i];
		}
		$('#savemodal').modal('show');
		
	}
	function gotoFAQPage(result){
		target = "faq.php?from=mahlowat.php?ans=";
		
		for(i = 0; i < result.length; i++){
			target += result[i];
		}
		window.location.href = target;
	}
	
	function callResult(count){
		if(count){
			jQuery.get("count.php",function( data ) {
				window.location.href = target;
			});
		} else {
			window.location.href = target;
		}
	}
	
	function nextThesis(selection){
		multiply = false;
		if($('#weight').hasClass('active')){
			multiply = true;
		}
		resultArray[activeThesis] = result2letter(selection, multiply);
		pagination.eq(activeThesis).removeClass('pagination-yes pagination-neutral pagination-no');
		pagination.eq(activeThesis).addClass(letter2paginationclass(selection));
		if(activeThesis+1 < thesesboxes.length){
			loadThesis(activeThesis+2);
		} else {
			// call result page
			gotoResultPage(resultArray);
		}
	}
	
	function loadThesis(number){
		if(number > thesesboxes.length){
			number = 1;
		}
		activeThesis = number-1;
		thesesboxes.hide();
		pagination.removeClass('active');
		
		setClasses(resultArray[activeThesis]);
		
		thesesboxes.eq(number-1).show();
		pagination.eq(number-1).addClass('active');
		location.hash = number;

	}
	
	function letter2paginationclass(letter){
		switch(letter){
			case 'a':
				return 'pagination-yes';
				break;
			case 'b':
				return 'pagination-neutral';
				break;
			case 'c':
				return 'pagination-no';
				break;
			case 'd':
				return '';
				break;
			
		}
	}
	
	function setClasses(code){
		$('.explic').hide();
		if(code < 'e'){
			$('#weight').removeClass('btn-info');
			$('#weight').addClass('btn-default');
			$('#weight').removeClass('active');
			$('#weight').text('These doppelt gewichten');
		} else {
			$('#weight').addClass('btn-info');
			$('#weight').removeClass('btn-default');
			$('#weight').addClass('active');
			$('#weight').text('These wird doppelt gewichtet');
		}
		switch (code){
			case 'a':
			case 'e':
				$('#yes').addClass('btn-success');
				$('#neutral').removeClass('btn-warning');
				$('#no').removeClass('btn-danger');
				break;
			case 'b':
			case 'f':
				$('#yes').removeClass('btn-success');
				$('#neutral').addClass('btn-warning');
				$('#no').removeClass('btn-danger');
				break;
			case 'c':
			case 'g':
				$('#yes').removeClass('btn-success');
				$('#neutral').removeClass('btn-warning');
				$('#no').addClass('btn-danger');
				break;
			case 'd':
			case 'h':
				$('#yes').addClass('btn-success');
				$('#neutral').addClass('btn-warning');
				$('#no').addClass('btn-danger');
				break;
		}
	}
	
	function result2letter(selection, multiply){
		if(multiply == false){
			return selection;
		} else if(selection == 'a'){
			return 'e';
		} else if(selection == 'b'){
			return 'f';
		} else if(selection == 'c'){
			return 'g';
		} else if(selection == 'd'){
			return 'h';
		}
	}
	
	function getResultArray(answerstr, count){
		arr = [];
		if(answerstr.length != count){
			for(i = 0; i < count; i++){
				arr[i] = 'd'; //no selection
			}
		} else {
			items = answerstr.split("");
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
	
	function setPaginationColors(array){
		for(i = 0; i < array.length; i++){
			pagination.eq(i).addClass(letter2paginationclass(array[i]));
		}
	}
	
	
  </script>
  </body>
</html>