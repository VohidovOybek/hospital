<?php
function dump($data)
{
    echo "<pre style='background-color: black;color: lightgreen;padding: 15px'>";
    var_dump($data);
    echo "</pre>";
}

function asset(?string $path)
{
    if ($path)
        return '/assets' . $path;
    return '';
}