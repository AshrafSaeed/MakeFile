<?php

namespace AshrafSaeed\MakeFile;

use Illuminate\Support\ServiceProvider;

//use AshrafSaeed\MakeFile\MakeFileClient;

class MakeFileServiceProvider extends ServiceProvider
{

	/**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;

    /**
     * creating registration of textmessage in booting of servicesprovider.
     *
     * @return null
     */
    public function boot() {

        $this->publishes([
            __DIR__.'/../config/makefile.php' => config_path('makefile.php'),
        ]);

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {   

        $this->app->bind(MakeFileClient::class, function() {

            dd('dd');

            return new MakeFileClient();
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    // public function provides() {

    //     return [MakeFileClient::class];
    
    // }

}

