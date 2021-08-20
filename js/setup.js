const SETUP_FILE = 'config/setup.json';

function Singleton() {
	if (typeof Singleton.instance === 'object') {
		return Singleton.instance;
	}

	this.languages = [];
	this.branding = {};
	this.statistics = {
		checkpoints: {},
		groups: []
	};

	Singleton.instance = this;
}

function deleteme(self) {
	var btnContainer = $(self).parent().parent();
	btnContainer.hide(400);
	window.setTimeout(function () { btnContainer.remove(); }, 500);
}

function moveup(self) {
	var btnContainer = $(self).parent().parent().parent();
	btnContainer.hide(400);
	window.setTimeout(function () {
		btnContainer.insertBefore(btnContainer.prev(".listcard"));
		btnContainer.show(400);
	}, 400);

}

function movedown(self) {
	var btnContainer = $(self).parent().parent().parent();
	btnContainer.hide(400);
	window.setTimeout(function () {
		btnContainer.insertAfter(btnContainer.next(".listcard"));
		btnContainer.show(400);
	}, 400);
}

function readData() {
	/* languages */
	Singleton.instance.languages = [];

	$('.input_language').each((index, input) => {
		var newSize = Singleton.instance.languages.push({});
		Singleton.instance.languages[newSize-1].name = $(input).val();
	});
	$('.input_language_flag').each(function (index, input) {
		Singleton.instance.languages[index].flag = $(input).val();
	});
	$('.input_language_url').each(function (index, input) {
		Singleton.instance.languages[index].url = $(input).val();
	});

	/* branding */
	Singleton.instance.branding = {}
	Singleton.instance.branding.logo = $('#input_branding_logo').val() || '';
	Singleton.instance.branding.appendix = $('#input_branding_appendix').val() || '';
	Singleton.instance.branding.url = $('#input_branding_url').val() || '';

	/* statistics */
	Singleton.instance.statistics = {
		checkpoints: {},
		groups: []
	}
	const checkpoints = ['enter', 'start', 'result'];
	checkpoints.forEach(id => {
		if ($(`#input_statistics_${id}_enable`).is(":checked"))
			Singleton.instance.statistics.checkpoints[id] = $(`#input_statistics_${id}_name`).val();
	});
	$('#group_list .card').each(function(index) {
		const groupNode = $(this);
		const groupName = groupNode.find('.input_group_name').val();
		const groupPrefix = groupNode.find('.input_group_prefix').val();

		if (groupName && groupPrefix)
			Singleton.instance.statistics.groups.push({
				name: groupName,
				prefix: groupPrefix
			});
	});
	Singleton.instance.statistics.log = $(`#input_statistics_log`).val();
	Singleton.instance.statistics.url = $(`#input_statistics_url`).val();
}

function generateLanguages() {
	if (!Singleton.instance.languages) return;
	Singleton.instance.languages.forEach(
		language => generateLanguage(language.name, language.flag, language.url)
	);
}

function generateEmptyLanguage() {
	generateLanguage("", "", "");
}

function generateLanguage(name, flag_file, url) {
	var languagediv = `<div class="listcard card bg-light">
		<div class="card-body">
			<div class="form-row">
				<div class="col">
					<div class="form-group">
						<label>Sprache</label>
						<input type="text" class="form-control input_language" placeholder="Deutsch" value="${name}">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Dateiname der Flagge</label>
						<input type="text" class="form-control input_language_flag" placeholder="de.svg" value="${flag_file}">
						<small id="flagHelp" class="form-text text-muted">Name der Flaggen-Datei. Platziere die Datei im <code>img</code>-Verzeichnis. Die Flaggen <tt>de.svg</tt>, <tt>en.svg</tt> und <tt>fr.svg</tt> können bereits genutzt werden.</small>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Link zum Vote-O-Maten für diese Sprache</label>
				<input type="text" class="form-control input_language_url" placeholder="https://meinserver.de/vote-o-mat/de/" value="${url}">
				<small id="urlHelp" class="form-text text-muted">Der Link kann als URL (also mit <tt>https://...</tt> beginnend) oder relativ zum Vote-O-Maten (z.B. <tt>de/</tt>) angegeben werden.</small>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-danger" onclick="deleteme(this.parentNode)">Diese Sprache löschen</button>
				<button type="button" class="btn btn-default" onclick="moveup(this)"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Diese Sprache nach <strong>oben</strong> verschieben</button>
				<button type="button" class="btn btn-default" onclick="movedown(this)"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Diese Sprache nach <strong>unten</strong> verschieben</button>
			</div>
		</div>
	</div>`;

	$('#language_list').append(languagediv);
}

function generateGroups() {
	if (!Singleton.instance.statistics || !Singleton.instance.statistics.groups) return;
	Singleton.instance.statistics.groups.forEach(
		group => generateGroup(group.name, group.prefix)
	);
}

function generateEmptyGroup() {
	generateGroup("", "");
}

function generateGroup(name, prefix) {
	let groupDiv = `<div class="card listcard">
		<div class="card-body">
			<div class="form-row">
				<div class="col">
					<label>Sprache</label>
					<input type="text" class="form-control input_group_name" placeholder="Deutsch" value="${name}">
				</div>
				<div class="col">
					<div class="form-group">
						<label>Sprachspezifischer Präfix</label>
						<input type="text" class="form-control input_group_prefix" placeholder="de-" value="${prefix}">
						<small id="customPrefixHelp" class="form-text text-muted">Präfix der Sprache. Mit diesem können Statistiken nach Sprachen getrennt ausgewertet werden.</small>
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-danger" onclick="deleteme(this)">Präfix löschen</button>
		</div>
	</div>`;

	$('#group_list').append(groupDiv);
}

function initializeBrandingInputs() {
	if (!Singleton.instance.branding) return;
	$('#input_branding_logo').val(Singleton.instance.branding.logo || '');
	$('#input_branding_appendix').val(Singleton.instance.branding.appendix || '');
	$('#input_branding_url').val(Singleton.instance.branding.url || '');
}

function initializeStatisticsInputs() {
	if (!Singleton.instance.statistics) return;
	Object.keys(Singleton.instance.statistics.checkpoints).forEach(checkpointId => {
		$(`#input_statistics_${checkpointId}_enable`).prop('checked', true);
		$(`#input_statistics_${checkpointId}_name`).val(
			Singleton.instance.statistics.checkpoints[checkpointId]);
	});
	$(`#input_statistics_log`).val(Singleton.instance.statistics.log);
	$(`#input_statistics_url`).val(Singleton.instance.statistics.url);
}

function showSetupAlternative () {
	var alternativeSetupInput =
	`<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<p>Dein Browser scheint das Laden von Konfigurationsdateien nicht zu erlauben. Solltest du bereits eine <code>setup.json</code>-Konfigurationsdatei angelegt haben und diese nun anpassen wollen, kopiere den Inhalt der Datei in das Textfeld und fahre mit dem untenstehenden Button fort.</p>
		<p>Wenn du gerade zum ersten Mal eine Konfiguration erstellen willst, fahre direkt mit dem Button fort.</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<textarea class="form-control" id="alternativeSetupInput" rows="5"></textarea>
	</div>`

	$('#btn_start_next').parent().before(alternativeSetupInput);
}

function initializeSetup() {
	generateLanguages();
	generateGroups();
	initializeBrandingInputs();
	initializeStatisticsInputs();
}

$(function () {
	var singleton = new Singleton();

	$.getJSON(SETUP_FILE, function (data) {
		Singleton.instance = data;
		initializeSetup();
	}).fail(() => showSetupAlternative());

	$('#btn_add_language').click(function () {
		generateEmptyLanguage();
	});

	$('#btn_add_group').click(function () {
		generateEmptyGroup();
	});

	$('#language_input').hide();
	$('#branding_input').hide();
	$('#statistics_input').hide();
	$('#encodeddata').hide();


	$('#btn_start_next').click(function () {
		var setupJSONText = $('#alternativeSetupInput').val() || '';
		if (setupJSONText) {
			Singleton.instance = JSON.parse(setupJSONText);
			initializeSetup();
		}
		$('#start').hide(500);
		$('#language_input').show(500);
	});

	$('#btn_step_1_next').click(function () {
		$('#language_input').hide(500);
		$('#branding_input').show(500);
	});

	$('#btn_step_2_next').click(function () {
		$('#branding_input').hide(500);
		$('#statistics_input').show(500);
	});

	$('#btn_step_2_prev').click(function () {
		$('#language_input').show(500);
		$('#branding_input').hide(500);
	});

	$('#btn_step_3_prev').click(function () {
		$('#branding_input').show(500);
		$('#statistics_input').hide(500);
	});

	$('#btn_generate_prev').click(function () {
		$('#statistics_input').show(500);
		$('#encodeddata').hide(500);
	});

	$('#btn_generate').click(function () {
		readData();
		var jsonstring = JSON.stringify(Singleton.instance, null, '\t');
		$('#output_encodeddata').val(jsonstring);
		$('#statistics_input').hide(500);
		$('#encodeddata').show(500);
	});

	$('#btn_copy_encodeddata').click(function () {
		var textArea = $('#output_encodeddata');
		textArea.focus();
		textArea.select();
		var encodedData = textArea.val();
		navigator.clipboard.writeText(encodedData).then(() => {
			$('#btn_copy_encodeddata').popover('show');
			window.setTimeout(() => $('#btn_copy_encodeddata').popover('hide'), 5000);
		});
	});	

});