<?php
if (!function_exists('rm_charac')) {
    function rm_charac($data) {
        $syntax = array("/", "\\", "*", "'", "\"", "(", ")", ",", ";", "%", "#", "@", "!", "&");
        return str_replace($syntax, "", $data);
    }
}
?>
