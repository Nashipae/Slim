<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/4.x/LICENSE.md (MIT License)
 */

declare(strict_types=1);

namespace Slim\Routing;

use Slim\Interfaces\DispatcherInterface;

class RoutingResults
{
    public const NOT_FOUND = 0;
    public const FOUND = 1;
    public const METHOD_NOT_ALLOWED = 2;

    /**
     * @var DispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var string
     */
    protected $httpMethod;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var int
     * The status is one of the constants shown above
     * NOT_FOUND = 0
     * FOUND = 1
     * METHOD_NOT_ALLOWED = 2
     */
    protected $routeStatus;

    /**
     * @var null|string
     */
    protected $routeIdentifier;

    /**
     * @var array
     */
    protected $routeArguments;

    /**
     * RoutingResults constructor.
     *
     * @param DispatcherInterface   $dispatcher
     * @param string                $httpMethod
     * @param string                $uri
     * @param int                   $routeStatus
     * @param string|null           $routeIdentifier
     * @param array                 $routeArguments
     */
    public function __construct(
        DispatcherInterface $dispatcher,
        string $httpMethod,
        string $uri,
        int $routeStatus,
        string $routeIdentifier = null,
        array $routeArguments = []
    ) {
        $this->dispatcher = $dispatcher;
        $this->httpMethod = $httpMethod;
        $this->uri = $uri;
        $this->routeStatus = $routeStatus;
        $this->routeIdentifier = $routeIdentifier;
        $this->routeArguments = $routeArguments;
    }

    /**
     * @return DispatcherInterface
     */
    public function getDispatcher(): DispatcherInterface
    {
        return $this->dispatcher;
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return int
     */
    public function getRouteStatus(): int
    {
        return $this->routeStatus;
    }

    /**
     * @return null|string
     */
    public function getRouteIdentifier(): ?string
    {
        return $this->routeIdentifier;
    }

    /**
     * @param bool $urlDecode
     * @return array
     */
    public function getRouteArguments(bool $urlDecode = true): array
    {
        if (!$urlDecode) {
            return $this->routeArguments;
        }

        $routeArguments = [];
        foreach ($this->routeArguments as $key => $value) {
            $routeArguments[$key] = rawurldecode($value);
        }

        return $routeArguments;
    }

    /**
     * @return array
     */
    public function getAllowedMethods(): array
    {
        return $this->dispatcher->getAllowedMethods($this->httpMethod, $this->uri);
    }
}
