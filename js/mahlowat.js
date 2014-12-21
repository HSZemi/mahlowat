/* Relevant functions for Mahlowat */
function callPage(evt, action, answerstring, count){
	if(evt != null){
		evt.preventDefault();
	}
	var html = "<input name='ans' value='"+answerstring+"'/><input name='count' value='"+count+"'/>";
	$('<form style="display: none;" method="post"/>').attr('action', action).html(html).appendTo('body').submit();
	
}

function array2str(arr){
	str = ''
	for(i=0;i<arr.length;i++){
		str += arr[i];
	}
	return str;
}

function resultStringToArray(answerstr, count){
	arr = [];
	if(answerstr.length != count){
		for(i = 0; i < count; i++){
			arr[i] = 'd'; //no selection
		}
	} else {
		items = answerstr.split("");
		for(i = 0; i < items.length; i++){
			if(items[i] <= 'h' && items[i] >= 'a'){
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