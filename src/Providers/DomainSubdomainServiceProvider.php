<?php

namespace Jmrashed\DomainSubdomain\Providers;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Jmrashed\DomainSubdomain\Calculator;
use Jmrashed\DomainSubdomain\Console\{InstallDomainSubdomainPackage, MakeFooCommand};

class DomainSubdomainServiceProvider extends ServiceProvider
{
    public function register()
    {

        // Register a class in the service container
        $this->app->bind('calculator', function ($app) {
            return new Calculator();
        });
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'domainsubdomain');
    }

    public function boot(Kernel $kernel)
    {
        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                // Commands\InstallCommand::class,
                InstallDomainSubdomainPackage::class,
                MakeFooCommand::class,
            ]);

            // Publish the config file
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('domainsubdomain.php'),
            ], 'config');
            // The tag that can be used when publishing the config file. 



            // Publish the migration file
            $this->publishes([
                __DIR__ . '/../database/migrations/create_domains_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_domains_table.php'),
            ], 'migrations');
            // The tag that can be used when publishing the migration file.



            // Publish the views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/domainsubdomain'),
            ], 'views');
            // The tag that can be used when publishing the views.


            // Publish the assets
            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('vendor/domainsubdomain'),
            ], 'assets');
            // The tag that can be used when publishing the assets.


            // Publish the language files
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/domainsubdomain'),
            ], 'lang');
            // The tag that can be used when publishing the language files.


            // Publish the routes
            $this->publishes([
                __DIR__ . '/../routes' => base_path('routes'),
            ], 'routes');
            // The tag that can be used when publishing the routes.


            // Publish the controllers
            $this->publishes([
                __DIR__ . '/../app/Http/Controllers' => app_path('Http/Controllers'),
            ], 'controllers');
            // The tag that can be used when publishing the controllers.


            // Publish the models
            $this->publishes([
                __DIR__ . '/../app/Models' => app_path('Models'),
            ], 'models');
            // The tag that can be used when publishing the models.


            // Publish the events
            $this->publishes([
                __DIR__ . '/../app/Events' => app_path('Events'),
            ], 'events');
            // The tag that can be used when publishing the events.


            // Publish the listeners
            $this->publishes([
                __DIR__ . '/../app/Listeners' => app_path('Listeners'),
            ], 'listeners');
            // The tag that can be used when publishing the listeners.


            // Publish the jobs
            $this->publishes([
                __DIR__ . '/../app/Jobs' => app_path('Jobs'),
            ], 'jobs');
            // The tag that can be used when publishing the jobs.


            // Publish the mail
            $this->publishes([
                __DIR__ . '/../app/Mail' => app_path('Mail'),
            ], 'mail');
            // The tag that can be used when publishing the mail.


            // Publish the notifications
            $this->publishes([
                __DIR__ . '/../app/Notifications' => app_path('Notifications'),
            ], 'notifications');
            // The tag that can be used when publishing the notifications.





            // Publish the Components
            $this->publishes([
                __DIR__ . '/../app/View/Components' => app_path('View/Components'),
                __DIR__ . '/../resources/views/components/' => resource_path('views/components'),

            ], 'components');
            // The tag that can be used when publishing the Components.


        }

        // Load the routes file
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load the views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'domainsubdomain');

        // Load the translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'domainsubdomain');

        // Load the migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');


        // Register the middleware
        $kernel->pushMiddleware(DomainCheck::class);

        // Register the middleware group
        Route::middlewareGroup('domain', [
            DomainCheck::class,
        ]);




        // register the kernel  pushMiddleware
        $kernel->pushMiddleware(DomainCheck::class);


        // router middleware 

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('domain', DomainCheck::class);
        $router->pushMiddlewareToGroup('web', DomainCheck::class);

        // loadViewComponentsAs
        $this->loadViewComponentsAs('domainsubdomain', [
            DomainSubdomain::class,
        ]);
    }
}
