function Singleton() {
	if (typeof Singleton.instance === 'object') {
		return Singleton.instance;
	}

	this.theses = null;
	this.lists = null;
	this.answers = null;
	this.activeThesis = 0;
	this.activeList = 0;

	Singleton.instance = this;
}

function deleteme(self) {
	$(self).parent().parent().hide(400);
	window.setTimeout(function () { $(self).parent().parent().remove(); }, 500);
}

function moveup(self) {
	$(self).parent().parent().hide(400);
	window.setTimeout(function () {
		$(self).parent().parent().insertBefore($(self).parent().parent().prev(".singlethesis"));
		$(self).parent().parent().show(400);
	}, 400);

}

function movedown(self) {
	$(self).parent().parent().hide(400);
	window.setTimeout(function () {
		$(self).parent().parent().insertAfter($(self).parent().parent().next(".singlethesis"));
		$(self).parent().parent().show(400);
	}, 400);
}

function readData() {
	Singleton.instance.theses = {};

	$('.input_thesis').each(function (index, value) {
		Singleton.instance.theses[index] = {};
		Singleton.instance.theses[index].l = $(value).val();
	});
	$('.input_thesis_short').each(function (index, value) {
		Singleton.instance.theses[index].s = $(value).val();
	});
	$('.input_explanation').each(function (index, value) {
		Singleton.instance.theses[index].x = $(value).val();
	});


	Singleton.instance.lists = {};

	$('.input_list').each(function (index, value) {
		Singleton.instance.lists[index] = {};
		Singleton.instance.lists[index].name = $(value).val();
	});
	$('.input_list_short').each(function (index, value) {
		Singleton.instance.lists[index].name_x = $(value).val();
	});

	if (Singleton.instance.answers == null) {
		Singleton.instance.answers = {};
	}

	// remove surplus list and/or thesis keys
	for (listkey in Object.keys(Singleton.instance.answers)) {
		if (!(listkey in Singleton.instance.lists)) {
			delete Singleton.instance.answers[listkey];
		} else {
			for (thesiskey in Object.keys(Singleton.instance.answers[listkey])) {
				if (!(thesiskey in Singleton.instance.theses)) {
					delete Singleton.instance.answers[listkey][thesiskey];
				}
			}
		}
	}

	// initialize missing list and/or thesis keys
	for (listkey in Object.keys(Singleton.instance.lists)) {
		if (!(listkey in Singleton.instance.answers)) {
			Singleton.instance.answers[listkey] = {};
		}
		for (thesiskey in Object.keys(Singleton.instance.theses)) {
			if (!(thesiskey in Singleton.instance.answers[listkey])) {
				Singleton.instance.answers[listkey][thesiskey] = {};
				Singleton.instance.answers[listkey][thesiskey].selection = "d";
				Singleton.instance.answers[listkey][thesiskey].statement = "";
			}
		}
	}
}

function generateTheses() {
	for (key in Object.keys(Singleton.instance.theses)) {
		generateThesis(Singleton.instance.theses[key].l, Singleton.instance.theses[key].s, Singleton.instance.theses[key].x);
	}
}

function generateLists() {
	for (key in Object.keys(Singleton.instance.lists)) {
		generateList(Singleton.instance.lists[key].name, Singleton.instance.lists[key].name_x);
	}
}

function generateEmptyThesis() {
	generateThesis("", "", "");
}

function generateThesis(name, shortname, explanation) {
	var thesisdiv = '<div class="singlethesis">' +
		'	<div class="form-group">' +
		'		<label>These</label>' +
		'		<input type="text" class="form-control input_thesis" placeholder="These" value="' + name + '">' +
		'	</div>' +
		'	<div class="form-group">' +
		'		<label>These (Kurzname)</label>' +
		'		<input type="text" class="form-control input_thesis_short" placeholder="These (Kurzname)" value="' + shortname + '">' +
		'	</div>' +
		'	<div class="form-group">' +
		'		<label>Erläuterung</label>' +
		'		<input type="text" class="form-control input_explanation" placeholder="Erläuterung" value="' + explanation + '">' +
		'	</div>' +
		'	<div class="form-group">' +
		'		<button type="button" class="btn btn-danger" onclick="deleteme(this)">Diese These löschen</button>' +
		'		<button type="button" class="btn btn-default" onclick="moveup(this)"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Diese These nach <strong>oben</strong> verschieben</button>' +
		'		<button type="button" class="btn btn-default" onclick="movedown(this)"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Diese These nach <strong>unten</strong> verschieben</button>' +
		'	</div>' +
		'</div>';

	$('#theses_list').append(thesisdiv);
}

function generateEmptyList() {
	generateList("", "");
}

function generateList(name, shortname) {
	var listdiv = '<div class="singlelist">' +
		'	<div class="form-group">' +
		'		<label>Listenname</label>' +
		'		<input type="text" class="form-control input_list" placeholder="Listenname" value="' + name + '">' +
		'	</div>' +
		'	<div class="form-group">' +
		'		<label>Listenname (kurz)</label>' +
		'		<input type="text" class="form-control input_list_short" placeholder="Listenname (kurz)" value="' + shortname + '">' +
		'	</div>' +
		'	<div class="form-group">' +
		'		<button type="button" class="btn btn-danger" onclick="deleteme(this)">Diese Liste löschen</button>' +
		'		<button type="button" class="btn btn-default" onclick="moveup(this)"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Diese Liste nach <strong>oben</strong> verschieben</button>' +
		'		<button type="button" class="btn btn-default" onclick="movedown(this)"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Diese Liste nach <strong>unten</strong> verschieben</button>' +
		'	</div>' +
		'</div>';

	$('#lists_list').append(listdiv);
}

$(function () {
	var singleton = new Singleton();

	$.getJSON("config/data.json", function (data) {
		data.activeThesis = 0;
		data.activeList = 0;
		Singleton.instance = data;


		generateTheses();
		generateLists();
	});


	$('#btn_add_list').click(function () {
		generateEmptyList();
	});

	$('#btn_add_thesis').click(function () {
		generateEmptyThesis();
	});

	$('#theses_input').hide();
	$('#lists_input').hide();
	$('#data_input').hide();
	$('#encodeddata').hide();


	$('#btn_start_next').click(function () {
		$('#start').hide(500);
		$('#theses_input').show(500);
	});

	$('#btn_step_1_next').click(function () {
		$('#theses_input').hide(500);
		$('#lists_input').show(500);
	});

	$('#btn_step_2_next').click(function () {
		createStep3();
		$('#lists_input').hide(500);
		$('#data_input').show(500);
	});

	$('#btn_step_2_prev').click(function () {
		$('#theses_input').show(500);
		$('#lists_input').hide(500);
	});

	$('#btn_step_3_prev').click(function () {
		$('#lists_input').show(500);
		$('#data_input').hide(500);
	});

	$('#generate').click(function () {
		var copy = JSON.parse(JSON.stringify(Singleton.instance))
		delete copy.activeThesis;
		delete copy.activeList;
		var jsonstring = JSON.stringify(copy, null, '\t');
		$('#output_encodeddata').val(jsonstring);
		$('#data_input').hide(500);
		$('#encodeddata').show(500);
	});

});

function createStep3() {
	readData();

	makeListSelect(Singleton.instance.lists);
	makePagination(Object.keys(Singleton.instance.theses).length);
	makeThesesBox();


	$('.tt').tooltip();
	$('.explic').hide();

	thesesboxes = $('.thesis');


	setPaginationColors();
	thesesboxes.hide();

	$('.explanationbutton').click(function (event) {
		event.preventDefault();
		$('.explic').toggle();
	});


	loadList(Singleton.instance.activeList);
	loadThesis(Singleton.instance.activeThesis + 1);

	$('[id^=input-]').change(function () {
		saveInput();
	})

	updateStatistics();

	// left and right keys
	$(window).keypress(function (e) {
		var code = e.which || e.keyCode;
		switch (code) {
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
}

function saveInput() {
	for (key in Object.keys(Singleton.instance.answers[Singleton.instance.activeList])) {
		Singleton.instance.answers[Singleton.instance.activeList][key].statement = $('#input-' + key).val();
	}
}


function setThesis(selection) {
	pagination = $('#navigation li');
	Singleton.instance.answers[Singleton.instance.activeList][Singleton.instance.activeThesis].selection = selection;
	pagination.eq(Singleton.instance.activeThesis).removeClass('pagination-yes pagination-neutral pagination-no');
	pagination.eq(Singleton.instance.activeThesis).addClass(letter2paginationclass(selection));
	setClasses(selection);
	updateStatistics();
}

function updateStatistics() {
	answeredcount = 0;
	for (i = 0; i < Object.keys(Singleton.instance.answers[Singleton.instance.activeList]).length; i++) {
		if (Singleton.instance.answers[Singleton.instance.activeList][i].selection != 'd') {
			answeredcount++;
		}
	}
	$('#answered_questions_count').text(answeredcount);
	$('#overall_questions_count').text(Object.keys(Singleton.instance.answers[Singleton.instance.activeList]).length);
}

function nextThesis() {
	loadThesis(Singleton.instance.activeThesis + 2);
}

function prevThesis() {
	loadThesis(Singleton.instance.activeThesis);
}

function loadThesis(number) {
	thesesboxes = $('.thesis');
	pagination = $('#navigation li');
	if (number > thesesboxes.length) {
		number = 1;
	}
	if (number < 1) {
		number = thesesboxes.length;
	}
	Singleton.instance.activeThesis = number - 1;
	thesesboxes.slideUp();
	pagination.removeClass('active');

	setClasses(Singleton.instance.answers[Singleton.instance.activeList][Singleton.instance.activeThesis].selection);

	thesesboxes.eq(number - 1).slideDown();
	pagination.eq(number - 1).addClass('active');

}

function letter2paginationclass(letter) {
	switch (letter) {
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

function setClasses(code) {
	switch (code) {
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

function setPaginationColors() {
	answers = Singleton.instance.answers;
	pagination = $('#navigation li');
	pagination.removeClass("pagination-yes pagination-neutral pagination-no");
	for (i = 0; i < Object.keys(answers[Singleton.instance.activeList]).length; i++) {
		pagination.eq(i).addClass(letter2paginationclass(answers[Singleton.instance.activeList][i]));
	}
}

function makeListSelect(lists) {
	str = '<ul class="nav nav-tabs">';

	for (var i = 0; i < (Object.keys(lists).length); i = i + 1) {
		str += "<li class='nav-item listselector'><a class='nav-link' href='#' onclick='loadList(" + i + ")'>" + lists[i].name_x + "</a></li>";
	}
	str += '</ul>';
	$('#listselect').html(str);
}

function loadList(id) {
	$('.listselector a').removeClass('active');
	$('.listselector:eq(' + id + ') a').addClass('active');
	Singleton.instance.activeList = id;
	var answers = Singleton.instance.answers;
	for (i = 0; i < Object.keys(answers[Singleton.instance.activeList]).length; i++) {
		$('#input-' + i).val(answers[Singleton.instance.activeList][i].statement);
	}
	setPaginationColors();
	updateStatistics();
	setClasses(answers[Singleton.instance.activeList][Singleton.instance.activeThesis].selection);
}

function makePagination(theses_count) {
	str = '<ul id="navigation" class="pagination pagination-sm">';
	for (var i = 1; i < (theses_count + 1); i = i + 1) {
		str += "<li class='page-item'><a class='page-link' href='#" + i + "' onclick='loadThesis(" + i + ")'>" + i + "</a></li>";
	}
	str += '</ul>';
	$('#pagination').html(str);
}

function makeThesesBox() {
	var theses = Singleton.instance.theses;
	var lists = Singleton.instance.lists;
	for (q_id = 0; q_id < Object.keys(theses).length; q_id++) {
		str = "<div id='thesis" + q_id + "' class='thesis'>";
		str += "<h1>These " + (q_id + 1) + "</h1>";
		str += "<div class='well well-large statement'>";
		str += "<p style='margin-bottom: 0px;' class='lead'>";

		str += theses[q_id].l;

		str += "</p>";
		if (theses[q_id].x != "") {
			str += "<button class='btn btn-link explanationbutton'>Erklärung</button>\n";
			str += "<div class='explic'>" + theses[q_id].x + "</div>";
		}

		str += "</div>";

		str += "<div class='row'>";
		str += "<div class='col-xs-12 col-sm-12 col-md-8 col-md-offset-2'>";
		str += "<textarea id='input-" + q_id + "' name='comments[" + q_id + "]' class='form-control' rows='3' placeholder='Hier die Begründung eingeben...'></textarea>";
		str += "</div>";
		str += "</div>";

		str += "</div>";
		$('#thesesbox').append(str);
	}
}