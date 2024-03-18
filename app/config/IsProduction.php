<?php
use Symfony\Component\HttpFoundation\Response;

//ubah ke true bila pesan error tidak ingin ditampilkan
$isProduction = true;


if ($isProduction) {
    // Mengatur opsi display_errors ke Off
    ini_set('display_errors', 'Off');
    // Function to handle PHP fatal errors
    function handleFatalError() {
        $lastError = error_get_last();
        if ($lastError !== null && $lastError['type'] === E_ERROR) {
            $error404Content = file_get_contents(__DIR__ . '/../../public/error/errorPHP.html');
            $response = new Response($error404Content, Response::HTTP_NOT_FOUND);
            $response->send();
        }
    }
    // Register shutdown function to handle fatal errors
    register_shutdown_function('handleFatalError');
}