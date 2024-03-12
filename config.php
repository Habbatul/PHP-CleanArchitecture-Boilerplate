<?php
require_once 'app/config/Database.php';

foreach (glob("app/controller/*") as $filename) {
    require_once $filename;
}
foreach (glob("app/repository/*") as $filename) {
    require_once $filename;
}
foreach (glob("app/service/*") as $filename) {
    require_once $filename;
}
foreach (glob("app/entity/*") as $filename) {
    require_once $filename;
}


use Config\Database;
use Controller\AuthController;
use Repository\AdminRepository;
use Repository\AdminRepositoryImpl;
use Service\AuthService;
use Service\AuthServiceImpl;

use function DI\create;
use function DI\get;
use function DI\autowire;


//depedency injection
// Dependency injection configuration
return [
    // Database connection
    'database' => fn() => Database::getConnection(),

    AdminRepository::class => create(AdminRepositoryImpl::class)->constructor(get('database')),
    AuthService::class => autowire(AuthServiceImpl::class),
    AuthController::class => autowire(),
];





