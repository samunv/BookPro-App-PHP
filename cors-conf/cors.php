<?php
$allowed_origins = [
    "http://localhost:5173",
    "https://bookpro-b0751.web.app",
    "http://localhost:4173",
    "https://bookpro-app.web.app",
    "http://localhost:5174"
];

// Si el origen de la solicitud está en la lista, se permite
if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Manejo de solicitudes OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}
