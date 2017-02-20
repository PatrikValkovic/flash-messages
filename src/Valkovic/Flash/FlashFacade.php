<?php
/**
 * Created by PhpStorm.
 * User: kowalsky
 * Date: 2/20/17
 * Time: 9:23 PM
 */

namespace Valkovic\Flash;

use Illuminate\Support\Facades\Facade;

class FlashFacade extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Flash::class;
    }
}