const CONFIG_FILE = '../config/setup.json'; 

function img(file_name) {
	return '../img/'+file_name;
}

// translation instance, see lang/*.js files
var t = new T();

$(() => {
	translate();
	init();
});

function translate() {
	for (let prop in t) {
		let id = prop.replace(/_/g, '-');
		$('#' + id).html(t[prop]);
	}
}

function missing(dataItem) {
	$('#error-msg').append(`<div class="alert alert-danger" role="alert"><b>Fehlende Daten:</b> In der Konfigurationsdatei <a href="${CONFIG_FILE}"><tt>${CONFIG_FILE}</tt></a> wurde folgendes Datum nicht spezifiziert: ${dataItem}. Nutze <a href="../setup.html"><tt>setup.html</tt></a> um es nachzutragen.</div>`);
}

function init() {
	$.getJSON(CONFIG_FILE)
		.done(function (jsondata) {
			generateLinks(jsondata.languages);
			setBranding(jsondata.branding);
		})
		.fail(function () {
			$('#error-msg').html(`<div class="alert alert-danger" role="alert"><b>Fehler</b> Die Konfigurationsdatei <a href="${CONFIG_FILE}"><tt>config/data.json</tt></a> konnte nicht geladen werden. Existiert sie und enthält keine Syntaxfehler? <br>Sie kann außerdem nicht lokal geladen werden, platziere die Dateien auf einem Server.</div>`);
		});
}

function generateLinks(languages) {
	if (!languages) return;
	languages.forEach(
		language => generateLanguage(language.name, language.flag, language.url)
	);
}

function generateLanguage(name, flag, url) {
	if (!name) {
		return missing('Name einer spezifizierten Sprache');
	} else if (!flag) {
		return missing(`Flagge der Sprache "${name}"`);
	} else if (!url) {
		return missing(`URL der Sprache "${name}"`);
	}

	var languageItem = `<a href="${url}">
		<img src="${img(flag)}" style="margin: 10px; height: 10rem"/>
		<br> ${name}
	</a>`;

	$('#flag-container').append(languageItem);
}

function setBranding(branding) {
	$('#branding-container').html(getBrandingHTML(branding));
}

function getBrandingHTML(branding) {
	var brandingText = branding.appendix || "";

	if (!branding.logo) return brandingText;
	var brandingLogo = `<img src="${img(branding.logo)}" alt="Branding Logo" style="height: 1.5em; margin-top: -0.25em"/>`;

	if (!branding.url) return `${brandingText} ${brandingLogo}`;

	return `${brandingText} <a href="${branding.url}" title="Website öffnen" target="_blank">${brandingLogo}</a>`;
}