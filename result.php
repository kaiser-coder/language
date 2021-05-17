<?php

require 'Language.php';
use Kaiser\Language;

$lang = new Language();

$result = $lang->defineLanguage(explode(' ', strtolower($_POST['text'])));

echo 'Cette phrase est en '. $result['defined_language'] .' et contient: 
<ul>
   <li>'. count($result['francais']) .' mots francais</li>
   <li>'. count($result['anglais']) .' mots anglais</li>
   <li>'. count($result['inconnu']) .' mots inconnus</li>
</ul>';