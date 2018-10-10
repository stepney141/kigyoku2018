<?php
/*
$char_A_ring = "\xC3\x85"; // 'LATIN CAPITAL LETTER A WITH RING ABOVE' (U+00C5)
$char_combining_ring_above = "\xCC\x8A";  // 'COMBINING RING ABOVE' (U+030A)

$char_1 = normalizer_normalize( $char_A_ring, Normalizer::FORM_C );
$char_2 = normalizer_normalize( 'A' . $char_combining_ring_above, Normalizer::FORM_C );
*/

$char_a = "ア";
$char_b = "ｱ";

$char_1 = normalizer_normalize( $char_a, Normalizer::FORM_KD );
$char_2 = normalizer_normalize( $char_b, Normalizer::FORM_KD );

echo $char_a;
echo nl2br(PHP_EOL);
echo $char_b;
echo nl2br(PHP_EOL);
echo ord($char_a);
echo ' ';
echo ord($char_b);

/*
echo "".urlencode($char_1);
echo ' ';
echo "".urlencode($char_2);
*/

echo nl2br(PHP_EOL);

echo ord($char_1);
echo ' ';
echo ord($char_2);


?>