## Laravel Monolog MySQL Handler.

This package will log errors into MySQL database instead storage/log/laravel.log file.

### Installation

~~~
# composer 先升级为2.0 https://getcomposer.org/download/ 不然报找不到包的错误
composer require westeast/laravel-monolog-mysql
~~~

Open up `config/app.php` and find the `providers` key.

~~~
'providers' => array(
    // ...
    Logger\Laravel\Provider\MonologMysqlHandlerServiceProvider::class,
);
~~~

Publish config using Laravel Artisan CLI.

~~~
#先执行这个清除下缓存再publish
php artisan config:clear

php artisan vendor:publish

~~~

Migrate tables.

~~~
php artisan migrate
~~~

## Application Integration
For Laravel 6
~~~php
//add use 
use Logger\Monolog\Handler\MysqlHandler;

// add mysql channels to config/logging.php:
   'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single','mysql'],
            'ignore_exceptions' => false,
        ],

        'mysql' => [
            'driver' => 'monolog',
            'handler' => MysqlHandler::class,
            'level' => 'debug',
        ],
        
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

~~~


For Old Laravel version In your application `bootstrap/app.php` add:

~~~php
$app->configureMonologUsing(function($monolog) use($app) {
    $monolog->pushHandler(new Logger\Monolog\Handler\MysqlHandler());
});
~~~

## Environment configuration

If you wish to change default table name to write the log into or database connection use following definitions in your .env file

~~~
DB_LOG_TABLE=logs
DB_LOG_CONNECTION=mysql
~~~

## Credits

Based on:

- [Pedro Fornaza] (https://github.com/pedrofornaza/monolog-mysql)
