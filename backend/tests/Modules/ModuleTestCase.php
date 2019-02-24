<?php

namespace IWD\TEST\Modules;

use PHPUnit\Framework\TestCase;

class ModuleTestCase extends TestCase
{
    protected $app;

    /**
     * PHPUnit setUp for setting up the application.
     *
     * Note: Child classes that define a setUp method must call
     * parent::setUp().
     */
    protected function setUp()
    {
        $this->app = $this->createApplication();
    }

    /**
     * Creates the application.
     *
     * @return HttpKernelInterface
     */
    public function createApplication()
    {
        return require ROOT_PATH . '/src/Client/Webapp/app.php';
    }
}