<?php

/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Tests\Mocks;

use Slim\Factory\Psr17\Psr17Factory;

class MockPsr17FactoryWithoutStreamFactory extends Psr17Factory
{
    protected static $responseFactoryClass = 'Slim\Psr7\Factory\ResponseFactory';
    protected static $streamFactoryClass = '';
    protected static $serverRequestCreatorClass = '';
    protected static $serverRequestCreatorMethod = '';
}
