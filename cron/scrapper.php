<?php

require './utils.php';
require './status.php';

const BASE_RESOLVE_URL = "https://cses.fi/problemset/user/";

function getUserTasks($userId) {
    $url = BASE_RESOLVE_URL . strval($userId) . "/";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, $url);

    $output = curl_exec($curl);

    if (curl_errno($curl)) {
        echo "Curl Error: " . curl_error($curl) . '\n';
        return array("error" => "curlError");
    }

    $html = new DOMDocument();
    $html->loadHTML($output);

    $results = array(
        ACCEPTED => array(),
        ATTEMPED => array(),
        NOT_ATTEMPTED => array()
    );

    $tds = $html->getElementsByTagName("td");
    foreach($tds as $td) {
        $attr = $td->firstChild->attributes;
        $classes = $attr->getNamedItem("class")->nodeValue;

        foreach (STATUS_CLASSES as $key => $value) {
            if ($classes == $value) {
                $status = $key;
                break;
            }
        }

        $results[$status][] = getTaskIdFromUrl($attr->getNamedItem("href")->nodeValue);
    }

    curl_close($curl);    
    return $results;
}
