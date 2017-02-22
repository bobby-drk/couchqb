<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Exception;



abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function disableProtectionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {

            public function __construct() {}
            public function report(Exception $e) {}
            public function render($request, Exception $e)
            {
                throw $e;
            }

        });

    }
}
