<?php
require_once 'MathCelebrity.php';

$api = new MathCelebrityAPI("YOUR_API_KEY");

$result = $api->solve("2x + 5 = 15");

print_r($result);
?>
