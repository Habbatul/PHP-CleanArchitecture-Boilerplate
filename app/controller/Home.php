<?php
/**
 * Contoh Pembuatan Controller
 */
namespace Controller;

class Home
{

    public function __construct(){}

    public function beranda(){
        require(__DIR__ . '/../view/users/HalamanTerserah.php');
    }

}