<?php
$expresion="25delnomviembredel2008";
$explode=preg_split("/(de)[l]*/i", $expresion);
echo $explode[2];
echo $explode[ 1];