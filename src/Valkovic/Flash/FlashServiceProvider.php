<?php
/**
 * Created by PhpStorm.
 * User: kowalsky
 * Date: 2/20/17
 * Time: 3:14 PM
 */

namespace Valkovic\Flash;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends  ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MessageContainer::class,function(){
            return new MessageContainer();
        });

        $this->app->bind(Flash::class,function(Application $app){
            return new Flash($app->make(MessageContainer::class));
        });
    }
}