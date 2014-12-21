<?php    
    include 'includes/funcs.php';
    include 'includes/theses.php';
    include 'includes/file.php';
    
     $css = Array();
	$css[0] = "bootstrap.min.css";
	$css[1] = "cerulean.min.css";
	$css[2] = "cosmo.min.css";
	$css[3] = "cyborg.min.css";
	$css[4] = "darkly.min.css";
	$css[5] = "flatly.min.css";
	$css[6] = "journal.min.css";
	$css[7] = "lumen.min.css";
	$css[8] = "paper.min.css";
	$css[9] = "readable.min.css";
	$css[10] = "sandstone.min.css";
	$css[11] = "simplex.min.css";
	$css[12] = "slate.min.css";
	$css[13] = "spacelab.min.css";
	$css[14] = "superhero.min.css";
	$css[15] = "united.min.css";
	$css[16] = "yeti.min.css";
	$css_id = 9;
	if(isset($_GET['css'])){
		$css_id = intval($_GET['css']);
		if($css_id < 0 || $css_id > 16){
			$css_id = 0;
		}
	}
    
    $theses = get_theses_array();

    $theses_count = sizeof($theses);

    $listid = '0';
    $ans = Array();
    $emph = Array();
    $answerstring = '';
    $warning = false;
    
    $hsg_array = load_var('data/lists.sav');
    if($hsg_array == null){
	$hsg_array['1ad4840c16828271436c6636054da62d']['name'] = 'Liste X';
      $hsg_array['1ad4840c16828271436c6636054da62d']['name_x'] = '<abbr title="Liste X">Liste X</abbr>';
      $hsg_array['ae93aa78de04952d385e541a15275081']['name'] = 'STIFT';
      $hsg_array['ae93aa78de04952d385e541a15275081']['name_x'] = '<abbr title="Kugelschreibär">STIFT</abbr>';
      $hsg_array['4fe2cc303fb2017b111361eebc386b84']['name'] = 'Liste Oben';
      $hsg_array['4fe2cc303fb2017b111361eebc386b84']['name_x'] = '<abbr title="Liste Oben">Liste Oben</abbr>';
      $hsg_array['b5caa1eb73da98608289d88ed26bd872']['name'] = 'TACKER';
      $hsg_array['b5caa1eb73da98608289d88ed26bd872']['name_x'] = '<abbr title="The ACKERdemikerliste">TACKER</abbr>';
      $hsg_array['21240209d7f115b04c84c55302df3234']['name'] = 'Vitamin B';
      $hsg_array['21240209d7f115b04c84c55302df3234']['name_x'] = '<abbr title="Vitamin B">Vitamin B</abbr>';
      $hsg_array['463e03d2ad30715b15015d7ca5151e31']['name'] = 'NEIN';
      $hsg_array['463e03d2ad30715b15015d7ca5151e31']['name_x'] = '<abbr title="Niemals nicht">NEIN</abbr>';
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
			$hsg_array[$listid]['comments'][$i] = substr($hsg_array[$listid]['comments'][$i], 0, 400);
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
    <!--<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <link href="css/<?php echo $css[$css_id];?>" rel="stylesheet" media="screen">
    
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
	
	<p class="pull-right"><button id='save' class="btn btn-primary">Alle Antworten Speichern</button></p>
	
	<p>Bitte wählt eure Antworten aus und tragt eure Begründungen in das vorgesehene Feld ein.<br>
	Begründungen werden bei 400 Zeichen abgeschnitten. Ja, das ist Absicht.<br>
	Mit den Pfeiltasten könnt ihr zwischen den einzelnen Thesen wechseln.<br>
	<b>Vergesst nicht, zwischendurch und am Ende zu speichern!</b></p>
	<p>Ihr habt bereits <span class="label label-primary" id="answered_questions_count">4</span> 
	von <span class="label label-primary" id="overall_questions_count">4</span> 
	Fragen beantwortet. <span class="label label-warning" id="unsaved_changes">Es gibt ungesicherte Änderungen. Bitte vor Verlassen speichern.</span></p>
	
  
		<?php print_pagination($theses_count); ?>
		
		<form id="thesesform" class="form" action="listenabfrage.php" method="post">
		
		<?php print_thesesbox($theses, true, $hsg_array[$listid]); ?>
		
		</form>
		
		<hr/>

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
		
	</div>
  </div>
  <script type="text/javascript">
  var resultArray;
  var activeThesis = 0;
  var answerstring = '<?php echo $answerstring; ?>';
  
  $(function(){
	$('.tt').tooltip();
	$('.explic').hide();
	$('#unsaved_changes').hide();
	
	thesesboxes = $('.singlethesis');	
	pagination = $('#navigation li');
	
	resultArray = getResultArray(answerstring, thesesboxes.length);
	
	setPaginationColors(resultArray);
	thesesboxes.hide();
	
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
	
	$('[id^=input-]').change(function(){$('#unsaved_changes').show();})
	
	updateStatistics();
	
	});
	
	
	$('.explanationbutton').click(function(event){
		event.preventDefault();
		$('.explic').toggle();
	});
	
	// left and right keys
	$(window).keypress(function(e){
		var code = e.which || e.keyCode;
		switch ( code )
		{
		case 37: //left
			prevThesis();
			break;
		case 39: //right
			nextThesis();
			break;
		default:
			break;
		}
	});
	
	function setThesis(selection){
		resultArray[activeThesis] = result2letter(selection, false);
		pagination.eq(activeThesis).removeClass('pagination-yes pagination-neutral pagination-no');
		pagination.eq(activeThesis).addClass(letter2paginationclass(selection));
		setClasses(resultArray[activeThesis]);
		updateStatistics();
		$('#unsaved_changes').show();
	}
	
	function updateStatistics(){
		answeredcount = 0;
		for(i = 0; i < resultArray.length; i++){
			if(resultArray[i] != 'd'){
				answeredcount++;
			}
		}
		$('#answered_questions_count').text(answeredcount);
		$('#overall_questions_count').text(resultArray.length);
	}
	
	function countChanges(){}
	
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
		thesesboxes.slideUp();
		pagination.removeClass('active');
		
		setClasses(resultArray[activeThesis]);
		
		thesesboxes.eq(number-1).slideDown();
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