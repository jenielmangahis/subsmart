<?php

function loadDotEnv($filepath) {
    $handle = fopen($filepath, 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if ((strlen($line) == 0) || (strpos($line, '#') === 0)) {
                continue;
            }
            $parts = explode('=', $line, 2);
            if (count($parts)==2) {
                $k = trim($parts[0]);
                $v = trim($parts[1]);
                if (strlen($k) > 0) {
                    $_ENV[$k] = $v;
                }
            }
        }
        fclose($handle);
        return "";
    } else {
        return "Error opening file [$filepath]";
    }
}

?>