<?php
function logError($message) {
    file_put_contents(BASE_PATH . '/logs/error.log', date('[Y-m-d H:i:s] ') . $message . PHP_EOL, FILE_APPEND);
}