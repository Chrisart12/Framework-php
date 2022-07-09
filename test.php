<?php

ob_start();

?>
ggggggggggggggg
<?php
echo "Je suis ici";

$content = ob_get_clean();

var_dump($content);

?>

