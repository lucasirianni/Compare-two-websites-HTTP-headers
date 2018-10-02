#!/usr/bin/php
<?php

stream_context_set_default( [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);

$url1 = readline("Enter the first website ie. https://www.fractione.com    ");
$url2 = readline("Enter the second website ie. https://[2600:1f14:e07:501:5fd7:bc84:31cb:f2a1]    ");
echo PHP_EOL; echo PHP_EOL;

$headers1 = (get_headers($url1, 1));
$headers2 = (get_headers($url2, 1));

echo("All HTTP Response headers of $url1");
echo PHP_EOL; echo PHP_EOL;
print_r($headers1);
echo PHP_EOL; echo PHP_EOL;
echo("All HTTP Response headers of $url2");
echo PHP_EOL; echo PHP_EOL;
print_r($headers2);
echo PHP_EOL; echo PHP_EOL;

foreach($headers1 as $key => $value) {
    if(empty($headers2[$key])) {
        $missing_keys[] = $key;
    } elseif ($headers2[$key] != $value) {
        $non_matching_values[$key] = $value . '|<---DIFFERENT--->|' . $headers2[$key];
    }
    unset($headers2[$key]);
}
foreach($headers2 as $key => $value) {
    $missing_keys[] = $key;
}

echo("The followin headers are contained ONLY in the first website");
echo PHP_EOL; echo PHP_EOL;
print_r($missing_keys);
echo PHP_EOL; echo PHP_EOL;
echo("The followin headers are contained in BOTH websites, but they contain DIFFERENT values");
echo PHP_EOL; echo PHP_EOL;
print_r($non_matching_values);
echo PHP_EOL; echo PHP_EOL;
?>
