<?php
    function rndName() {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $name = '';
        for ($i = 0; $i < 10; $i++) {
            $name .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $name;
    }

    function saveFile($content) {
        $name = rndName();
        $file = fopen("data/$name.txt", 'w');
        fwrite($file, $content);
        fclose($file);
        return $name;
    }

    function loadKey($name) {
        $file = fopen("data/$name.txt", 'r');
        $content = fread($file, filesize("data/$name.txt"));
        fclose($file);
        return $content;
    }
?>