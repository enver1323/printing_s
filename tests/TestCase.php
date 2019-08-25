<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function informTest(string $function)
    {
        $class = last(explode('\\', get_class($this)));
        echo "$class: $function()\n";
    }
}
