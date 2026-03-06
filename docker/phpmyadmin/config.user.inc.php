<?php

// Force a stable base URL to avoid cookie/session issues behind local port mapping.
$cfg['PmaAbsoluteUri'] = 'http://localhost:8081/';
$cfg['ForceSSL'] = false;
$cfg['LoginCookieValidity'] = 36000;
$cfg['CookieSameSite'] = 'Lax';

// Keep phpMyAdmin aligned with Docker .env credentials to avoid auth mismatch.
$cfg['Servers'][1]['auth_type'] = 'config';
$cfg['Servers'][1]['host'] = getenv('PMA_HOST') ?: 'mysql';
$cfg['Servers'][1]['port'] = (int) (getenv('PMA_PORT') ?: 3306);
$cfg['Servers'][1]['user'] = getenv('PMA_USER') ?: 'sail';
$cfg['Servers'][1]['password'] = getenv('PMA_PASSWORD') ?: 'password';
