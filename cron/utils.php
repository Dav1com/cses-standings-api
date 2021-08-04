<?php

/* utils */
function getTaskIdFromUrl($url) {
    $arr = explode("/", rtrim($url, "/"));
    return intval(end(explode("/", rtrim($url, "/"))));
}
