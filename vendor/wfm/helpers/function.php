<?php

function debug($data, $die = false) 
{
    echo '<pre>'. print_r($data, 1) . '<pre>';
    if ($die) {
        die;
    }
}

// против потенциальных опасностей в html
function h($str)
{
 return htmlspecialchars($str);
}