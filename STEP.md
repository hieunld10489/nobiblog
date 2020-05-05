../../bin/php/php7.3.1/bin/php composer.phar install
../../bin/php/php7.3.1/bin/php artisan key:generate
../../bin/php/php7.3.1/bin/php composer.phar require barryvdh/laravel-debugbar

../../bin/php/php7.3.1/bin/php artisan ide-helper:generate
../../bin/php/php7.3.1/bin/php artisan ide-helper:model

../../bin/php/php7.3.1/bin/php composer.phar require --dev barryvdh/laravel-ide-helper
../../bin/php/php7.3.1/bin/php artisan ide-helper:generate
../../bin/php/php7.3.1/bin/php artisan clear-compiled

../../bin/php/php7.3.1/bin/php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config


../../bin/php/php7.3.1/bin/php artisan make:controller Home --invokable
../../bin/php/php7.3.1/bin/php artisan make:controller HomeController --resource

../../bin/php/php7.3.1/bin/php artisan view:clear
../../bin/php/php7.3.1/bin/php artisan make:model Vocabulary
../../bin/php/php7.3.1/bin/php artisan make:model AccessLog
../../bin/php/php7.3.1/bin/php artisan make:model StatisticAccess

../../bin/php/php7.3.1/bin/php artisan make:request StoreBlogPost