<?php    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    include 'includes/file.php';
    
    $theses = get_theses_array();

    $theses_count = sizeof($theses['s']);

    $listid = '0';
    $ans = Array();
    $emph = Array();
    $answerstring = '';
    $warning = false;
    
    $hsg_array = load_var('data/lists.sav');
    if($hsg_array == null){
	$hsg_array['897316929176464ebc9ad085f31e7284']['name'] = 'GHG';
      $hsg_array['897316929176464ebc9ad085f31e7284']['name_x'] = '<abbr title="Grüne Hochschulgruppe - campus:grün">GHG</abbr>';
      $hsg_array['b026324c6904b2a9cb4b88d6d61c81d1']['name'] = 'RCDS';
      $hsg_array['b026324c6904b2a9cb4b88d6d61c81d1']['name_x'] = '<abbr title="Ring Christlich-Demokratischer Studenten (RCDS) &amp; Unabhängige">RCDS</abbr>';
      $hsg_array['6d7fce9fee471194aa8b5b6e47267f03']['name'] = 'Juso-HSG';
      $hsg_array['6d7fce9fee471194aa8b5b6e47267f03']['name_x'] = '<abbr title="Juso-Hochschulgruppe">Juso-HSG</abbr>';
      $hsg_array['48a24b70a0b376535542b996af517398']['name'] = 'LHG';
      $hsg_array['48a24b70a0b376535542b996af517398']['name_x'] = '<abbr title="Liberale Hochschulgruppe an der Uni Bonn (LHG)">LHG</abbr>';
      $hsg_array['1dcca23355272056f04fe8bf20edfce0']['name'] = 'LUST';
      $hsg_array['1dcca23355272056f04fe8bf20edfce0']['name_x'] = '<abbr title="Liste Undogmatischer StudentInnen (LUST)">LUST</abbr>';
      $hsg_array['9ae0ea9e3c9c6e1b9b6252c8395efdc1']['name'] = 'Piraten';
      $hsg_array['9ae0ea9e3c9c6e1b9b6252c8395efdc1']['name_x'] = '<abbr title="Piraten-Hochschulgruppe Bonn">Piraten</abbr>';
    }
    
    if(isset($_GET['listid']) and array_key_exists($_GET['listid'], $hsg_array)){
	$listid = $_GET['listid'];
	
	if(!array_key_exists('answers', $hsg_array[$listid])){
		for($i=0; $i<$theses_count; $i++){
			$hsg_array[$listid]['answers'][i] = 0;
		}
	}
	if(!array_key_exists('comments', $hsg_array[$listid])){
		for($i=0; $i<$theses_count; $i++){
			$hsg_array[$listid]['comments'][i] = '';
		}
	}
	
	if(isset($_POST['comments'])){
		$comments = $_POST['comments'];
		$hsg_array[$listid]['comments'] = $comments;
		for($i=0; $i<sizeof($hsg_array[$listid]['comments']); $i++){
			$hsg_array[$listid]['comments'][$i] = htmlspecialchars($hsg_array[$listid]['comments'][$i]);
		}
	}
	if(isset($_GET['ans'])){
		$answerstring = $_GET['ans'];
		$retval = result_from_string($answerstring, $theses_count);
		$ans = $retval[0];
		$hsg_array[$listid]['answers'] = $ans;
	}
	save_var('data/lists.sav', $hsg_array);
	
	$mult = Array();
	for($i=0; $i<$theses_count; $i++){
		$mult[] = 1;
	}
	
	$answerstring = result_to_string($hsg_array[$listid]['answers'], $mult);
	
    } else {
	echo "error";
	die();
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mahlowat: Listenabfrage</title>
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
  
  <div class="container" style="margin-top: 20px;">
	<img src="img/mahlowat_logo.png" title="Mahlowat Logo" class="pull-right" onclick="changeText('mahlowat')"/>
	<p id="spruch" class="pull-right"></p>
	<div class="bottom-buffer top-buffer">
	
	<h4>Herzlich willkommen zur Listenabfrage!</h4>
	<p><b>Hallo <?php echo $hsg_array[$listid]['name'];?>!</b></p>
	<p>Bitte wählt eure Antworten aus und tragt eure Begründungen in das vorgesehene Feld ein.<br>
	Mit den Pfeiltasten könnt ihr zwischen den einzelnen Thesen wechseln.<br>
	<b>Vergesst nicht, zwischendurch und am Ende zu speichern!</b></p>
  
		<?php print_pagination($theses_count); ?>
		
		<form id="thesesform" class="form" action="listenabfrage.php" method="post">
		
		<?php print_thesesbox($theses, true, $hsg_array[$listid]); ?>
		
		</form>

			<div class="row">
			<div class="col-xs-6 col-xs-offset-3 col-sm-2 col-md-1 col-md-offset-1">
				<button id='prev' type='submit' class='btn btn-default btn-block' name='prev' onclick="prevThesis()"><span class="glyphicon glyphicon-chevron-left"></span></button>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2">
				<button id='yes' type='submit' class='btn btn-success btn-block' name='yes' onclick="setThesis('a')"><span class="glyphicon glyphicon-thumbs-up"></span> Zustimmung</button>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2 ">
				<button id='neutral' type='submit' class='btn btn-warning btn-block' name='neutral' onclick="setThesis('b')"><span class="glyphicon glyphicon-tree-deciduous"></span> Neutral</button>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2">
				<button id='no' type='submit' class='btn btn-danger btn-block' name='no' onclick="setThesis('c')"><span class="glyphicon glyphicon-thumbs-down"></span> Ablehnung</button>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2">
				<button id='skip' type='submit' class='btn btn-default btn-block' name='skip' onclick="setThesis('d')"><span class="glyphicon glyphicon-share-alt"></span> Überspringen</button>
			</div>
			<div class="col-xs-6 col-xs-offset-3 col-sm-2 col-sm-offset-0 col-md-1">
				<button id='next' type='submit' class='btn btn-default btn-block' name='next' onclick="nextThesis()"><span class="glyphicon glyphicon-chevron-right"></span></button>
			</div>
			</div>
			<hr>
		<p class="text-center"><button id='save' class="btn btn-primary">Antworten Speichern</button></p>
	</div>
  </div>
  <script type="text/javascript">
  var resultArray;
  var activeThesis = 0;
  var answerstring = '<?php echo $answerstring; ?>';
  
  $(function(){
	$('.tt').tooltip();
	$('.explic').hide();
	
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
	
	$('#save').click(function(){
		target = "listenabfrage.php?listid=<?php echo $listid;?>&ans=";
		
		for(i = 0; i < resultArray.length; i++){
			target += resultArray[i];
		}
		target += "#"+(activeThesis+1);
		$("#thesesform").attr("action", target);
		$("#thesesform").submit();
	});
	
	});
	
	
	function etoggle(){
		$(this).prev
		$('.explic').toggle();
	}
	
	function setThesis(selection){
		resultArray[activeThesis] = result2letter(selection, false);
		pagination.eq(activeThesis).removeClass('pagination-yes pagination-neutral pagination-no');
		pagination.eq(activeThesis).addClass(letter2paginationclass(selection));
		setClasses(resultArray[activeThesis]);
	}
	
	function nextThesis(){
		loadThesis(activeThesis+2);
	}
	
	function prevThesis(){
		loadThesis(activeThesis);
	}
	
	function loadThesis(number){
		if(number > thesesboxes.length){
			number = 1;
		}
		if(number < 1){
			number = thesesboxes.length;
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