<?php

/* utils */
function getTaskIdFromUrl($url) {
    return intval(end(explode("/", rtrim($url, "/"))));
}
