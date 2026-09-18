<?php

declare(strict_types=1);

define(
    'APP_NAME',
    'Arna Tours & Travels'
);

define(
    'APP_URL',
    rtrim((string)(getenv('ARNA_APP_URL') ?: 'http://localhost/ARNA-TOURS-TRAVELS'), '/')
);

define(
    'TIMEZONE',
    'Asia/Kolkata'
);

date_default_timezone_set(TIMEZONE);