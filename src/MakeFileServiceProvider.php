<?php

namespace AshrafSaeed\MakeFile;

use Illuminate\Support\ServiceProvider;

//use AshrafSaeed\MakeFile\MakeFileClient;

class MakeFileServiceProvider extends ServiceProvider
{

    /**
     * creating registration of textmessage in booting of servicesprovider.
     *
     * @return null
     */
    public function boot() {

        $this->commands([
            MakeFileClient::class
        ]);

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() {   

    }

}

