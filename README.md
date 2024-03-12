### PHP with Clean Architecture Concept
This is a boilerplate implementing a layered approach while adhering to the clean architecture concept by Uncle Bob.
- Don't forget to run "composer install".
- Make sure you have a basic understanding of Symfony/HttpFoundation & Symfony/Routing.
- This is not a framework and does not follow any framework folder conventions. It's an attempt to implement a layered folder structure using pure PHP in the Domain Layer.
- The framework component is only used in the Controller layer and outside of the Domain Layer (index.php, config.php and routes.php).
- Only use 3 depedencies : php-di/php-di, symfony/routing, symfony/http-foundation
