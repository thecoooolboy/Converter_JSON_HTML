<?php

require_once 'vendor/autoload.php';

use App\ElementConverter\ElementConverter;

$filePath = 'public/json/data.json';
$converter = new ElementConverter($filePath);
$html = $converter->convert();

echo $html;