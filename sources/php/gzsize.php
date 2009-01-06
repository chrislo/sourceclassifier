<?php
$stuff = file_get_contents('php://stdin');

$stuff = preg_replace('/<span class="com">.*<\/span>/m', '', $stuff);
$stuff = preg_replace('/<span class="slc">.*<\/span>/m', '', $stuff);
$stuff = preg_replace('/<span class="[a-z]{3}">/m', '', $stuff);

$stuff = preg_replace('/<span class="hl com">.*<\/span>/m', '', $stuff);
$stuff = preg_replace('/<span class="hl slc">.*<\/span>/m', '', $stuff);
$stuff = preg_replace('/<span class="hl [a-z]{3}">/m', '', $stuff);

$stuff = preg_replace('/<\/span>/m', '', $stuff);

$stuff = preg_replace('/\s+/m', ' ', $stuff);
$stuff = preg_replace('/&quot;/m', '"', $stuff);
$stuff = preg_replace('/&lt;/m', '<', $stuff);
$stuff = preg_replace('/&gt;/m', '>', $stuff);

echo strlen( gzcompress($stuff,1) );
?>
