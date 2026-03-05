<?php

// Force a stable base URL to avoid cookie/session issues behind local port mapping.
$cfg['PmaAbsoluteUri'] = 'http://localhost:8081/';
$cfg['ForceSSL'] = false;
$cfg['LoginCookieValidity'] = 36000;
$cfg['CookieSameSite'] = 'Lax';
