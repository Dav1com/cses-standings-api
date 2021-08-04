<?php

if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle) {
        return (string)$needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0;
    }
}

/* User ids to fetch */
function getIds() {
    $url = "https://raw.githubusercontent.com/progcompuch/apunte/main/config.toml";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($curl);

    if (curl_errno($curl)) {
        echo "Curl Error: " . curl_error($curl) . '\n';
        return array();
    }

    echo curl_getinfo($curl, CURLINFO_HTTP_CODE) . "\n";

    $output = explode("\n", $output);

    foreach ($output as $line) {
        $line = trim($line);
        if (str_starts_with($line, "csesIds")) {
            $parts = explode("=", $line, 1);
            return json_decode(trim($parts[1]));
        }
    }

    return array();
}

echo json_encode(getIds());
