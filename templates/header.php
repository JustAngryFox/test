<?
class head{
var $title;
var $description;
var $ogtitle;
var $ogdescription;
var $ogimage='images/logo.png';
var $ogtype;
var $ogurl;
var $oglocale='ru';
var $charset='utf-8';
var $styles;
var $js;

function header(){
if (empty($this->ogtitle)){$ogtitle=$this->title;} else 
	{$ogtitle=$this->ogtitle;} 
if (empty($this->ogdescription)){$ogdescription=$this->description;} else 
	{$this->ogdescription;}

echo '<!doctype html>
<html lang="ru">
<head><title>'.$this->title.'</title>
<meta charset="'.$this->charset.'"/>
<meta name="description" content="'.$this->description.'">  
<meta property="og:title" content="'.$ogtitle.'"/>
<meta property="og:description" content="'.$ogdescription.'"/>
<meta property="og:image" content="'.$this->ogimage.'"/>
<meta property="og:type" content="'.$this->ogtype.'"/>
<meta property="og:url" content= "'.$this->ogurl.'" />
<meta property="og:locale" content="'.$this->oglocale.'" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="SHORTCUT ICON" href="favicon.png" type="image/png">
<link href="styles/fonts.css" rel="stylesheet" type="text/css">
<link href="styles/template.css" rel="stylesheet" type="text/css">
<link href="styles/'.$this->styles.'" rel="stylesheet" type="text/css">
<script src="js/template_ready.js"></script>
<script src="js/template_function.js"></script>
<script src="js/'.$this->js.'_ready.js"></script>
<script src="js/'.$this->js.'_function.js"></script>



</head>
<body>';
}
}
?>