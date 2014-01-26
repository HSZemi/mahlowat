 
jQuery(document).ready(function($){
        if($('#socialshareprivacy').length > 0){
          $('#socialshareprivacy').socialSharePrivacy({
        "services":{"facebook":{
		"status":"on",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an Facebook senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off",
		"action":"recommend",
		"language":"de_DE"
        },
        "twitter":{
		"tweet_text":"Der Mahlowat meint, ich könnte evtl. \'<?php echo $hsg_array[0]['name']; ?>\' gut finden. http://akut-bonn.de/wahl-o-man/",
		"status":"on",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an Twitter senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off",
		"language":"de"
	  },
	  "gplus":{
		"status":"off",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an Google+ senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off"
	  },
	  "flattr":{
		"status":"off",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an Flattr senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off"
	  },
	  "xing":{
		"status":"off","txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an Xing senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off",
		"language":"de"
	  },
	  "pinterest":{
		"status":"off",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an Pinterest senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off"
	  },
	  "t3n":{
		"status":"off",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an t3n senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off"
	  },
	  "linkedin":{
		"status":"off",
		"txt_info":"2 Klicks f\u00fcr mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie k\u00f6nnen Ihre Empfehlung an LinkedIn senden. Schon beim Aktivieren werden Daten an Dritte \u00fcbertragen.",
		"perma_option":"off"
	  }
	  },
	  "info_link":"http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html",
	  "display_infobox":"off",
	  'cookie_domain' : 'akut-bonn.de',
        'uri' : 'http://akut-bonn.de/wahl-o-man/'
	  
	  });}
      });