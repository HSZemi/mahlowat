var sprueche = new Array(
		'Heute schon gewählt?',
		'Ich bin übrigens ein großer Fan des Wahlausschusses.',
		'Schon die alten Römer haben Kreuze gemacht',
		'Ich mach drei Kreuze wenn der Shit hier vorbei ist.',
		'Mit Tabellen kenn ich mich aus.',
		'Was geht?',
		'Beim Gewichtheben habe ich mir schonmal was verrenkt.',
		'Alles so schön bunt hier!',
		'Wenn euch langweilig ist, könnt ihr ja mal Muster klicken.<br> Rot-Gelb-Grün oder doppelt-einfach-doppelt...',
		'--!',
		'',
		'',
		'',
		'');
var index = 0;
function changeText(page){
	var index_old = index;
	index = Math.floor((Math.random()*sprueche.length));
	
	if(index == index_old){
		index = (index + 1) % sprueche.length;
	}
	
	if(sprueche[index] != ''){
		$('#spruch').html('<i>&bdquo;'+sprueche[index]+'&ldquo;</i>');
	} else {
		$('#spruch').html('');
	}
}