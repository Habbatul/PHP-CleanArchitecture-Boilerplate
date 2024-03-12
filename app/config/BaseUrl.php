<?php

define('BASE_URL', 'http://localhost/clean-architecture-php');

/**
 *Fungsi untuk mendapatkan URL dasar aplikasi.
 *
 * @param string $uri Jalur opsional yang akan ditambahkan ke URL dasar.
 * @return string URL dasar aplikasi dengan suburl jika diberikan.
 */
function base_url($uri = '') {
    //Menggunakan BASE_URL yang telah didefinisikan di index.php
    return rtrim(BASE_URL, '/') . '/' . ltrim($uri, '/');
}
?>
