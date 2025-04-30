#!/usr/bin/env php
<?php
passthru(
    "php vendor/bin/bricolo " . implode(' ', array_map(
        'escapeshellarg', 
        array_slice($_SERVER['argv'], 1)
    )),
    $exitCode
);
exit($exitCode);