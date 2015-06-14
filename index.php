<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$baseurl = "http://" . $_SERVER['SERVER_NAME'] . $uri_parts[0];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mahlowat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="Mahlowat">
    
    <meta name="image_src" content="img/mahlowat_logo.png"/>
    <meta name="description" content="Der Mahlowat ist ein Angebot von XYZ und wurde auf Beschluss des XXXV. Studierendenparlaments der Uni Bonn entwickelt. Er ermöglicht es, zu ausgewählten Themen die eigenen Standpunkte mit denen der Listen abzugleichen, die zur Wahl antreten."/>
    
    <meta property="og:title" content="Mahlowat"/>
    <meta property="og:type"  content="website"/>
    <meta property="og:image" content="img/mahlowat_logo.png"/>
    <meta property="og:url"   content=""/>
    <meta property="og:site-name" content="example.com"/>
    <meta property="og:description" content="Der Mahlowat ist ein Angebot von XYZ und wurde auf Beschluss des XXXV. Studierendenparlaments der Uni Bonn entwickelt. Er ermöglicht es, zu ausgewählten Themen die eigenen Standpunkte mit denen der Listen abzugleichen, die zur Wahl antreten."/>
    
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <link href="shariff/shariff.min.css" rel="stylesheet">
    
    <script src="js/jquery-2.0.2.min.js"></script>
    
  </head>
  <body>
  
  <div class="container mow-container" style="margin-top:20px;">
  
  <div class="text-center">
  
    <img src="img/mahlowat_logo.png" title="Mahlowat Logo"/>
    
    <h1><small>Der</small> Mahlowat</h1>
  </div>
    <p>Der Mahlowat ist ein technisches Hilfsmittel, das es ermöglicht, zu ausgewählten Themen die eigenen Standpunkte mit denen der Listen abzugleichen, die zur $Wahl antreten.</p>
    
    <p>Er ist selbstverständlich nur als Automat ohne Hirn zu verstehen und spricht keine Wahlempfehlungen aus.</p>
    
    <p>Lorem Ipsum.</p>
    
    <p>Für ihre Stellungnahmen zu den Thesen sind die Listen selbst verantwortlich.</p>
    
    <p class="text-center"><a class="btn btn-large btn-primary" href="mahlowat.php" title="Mahlowat starten">Mit der Befragung beginnen!</a></p>
    
    <p class="text-center"><a href="faq.php" title="Fragen und Antworten"><small>FAQ</small></a></p>
    
    
    
    <div class="shariff" data-url="<?php echo $baseurl; ?>" data-referrer-track=null></div>
    <script src="shariff/shariff.min.js"></script>
  </div>
  
  </body>
</html>