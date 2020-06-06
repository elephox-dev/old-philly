<?php

declare(strict_types=1);

namespace test\Philly;

/**
 * Class TestClass
 */
class SecondTestClass implements TestInterface, SecondTestInterface
{
    /**
     * @var string
     */
    public string $field2 = "value2";
}
