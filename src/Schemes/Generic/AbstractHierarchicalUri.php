<?php
/**
 * League.Url (http://url.thephpleague.com)
 *
 * @link      https://github.com/thephpleague/uri/
 * @copyright Copyright (c) 2013-2015 Ignace Nyamagana Butera
 * @license   https://github.com/thephpleague/uri/blob/master/LICENSE (MIT License)
 * @version   4.0.0
 * @package   League.uri
 */
namespace League\Uri\Schemes\Generic;

use Exception;
use League\Uri;
use League\Uri\Interfaces;
use Psr\Http\Message\UriInterface;
use ReflectionClass;

/**
 * Value object representing a Hierarchical URI.
 *
 * @package League.uri
 * @since   4.0.0
 *
 */
abstract class AbstractHierarchicalUri extends AbstractUri implements Interfaces\Schemes\HierarchicalUri
{
    /**
     * Path Component
     *
     * @var Interfaces\Components\HierarchicalPath
     */
    protected $path;

    /**
     * Create a new instance of URI
     *
     * @param Interfaces\Components\Scheme           $scheme
     * @param Interfaces\Components\UserInfo         $userInfo
     * @param Interfaces\Components\Host             $host
     * @param Interfaces\Components\Port             $port
     * @param Interfaces\Components\HierarchicalPath $path
     * @param Interfaces\Components\Query            $query
     * @param Interfaces\Components\Fragment         $fragment
     */
    public function __construct(
        Interfaces\Components\Scheme $scheme,
        Interfaces\Components\UserInfo $userInfo,
        Interfaces\Components\Host $host,
        Interfaces\Components\Port $port,
        Interfaces\Components\HierarchicalPath $path,
        Interfaces\Components\Query $query,
        Interfaces\Components\Fragment $fragment
    ) {
        $this->scheme = $scheme;
        $this->userInfo = $userInfo;
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->query = $query;
        $this->fragment = $fragment;
        $this->assertValidObject();
    }

    /**
     * Create a new instance from an array returned by
     * PHP parse_url function
     *
     * @param array $components
     *
     * @throws \InvalidArgumentException If the URI can not be parsed
     *
     * @return Uri\Interfaces\Schemes\Uri
     */
    public static function createFromComponents(array $components)
    {
        $components = static::formatComponents($components);

        return (new ReflectionClass(get_called_class()))->newInstance(
            new Uri\Components\Scheme($components['scheme']),
            new Uri\Components\UserInfo($components['user'], $components['pass']),
            new Uri\Components\Host($components['host']),
            new Uri\Components\Port($components['port']),
            new Uri\Components\HierarchicalPath($components['path']),
            new Uri\Components\Query($components['query']),
            new Uri\Components\Fragment($components['fragment'])
        );
    }

    /**
     * Supported Schemes
     *
     * @var array
     */
    protected static $supportedSchemes = [];

    /**
     * {@inheritdoc}
     */
    public function appendPath($path)
    {
        return $this->withProperty('path', $this->path->append($path));
    }

    /**
     * {@inheritdoc}
     */
    public function prependPath($path)
    {
        return $this->withProperty('path', $this->path->prepend($path));
    }

    /**
     * {@inheritdoc}
     */
    public function filterPath(callable $callable, $flag = Interfaces\Components\Collection::FILTER_USE_VALUE)
    {
        return $this->withProperty('path', $this->path->filter($callable, $flag));
    }

    /**
     * {@inheritdoc}
     */
    public function withExtension($extension)
    {
        return $this->withProperty('path', $this->path->withExtension($extension));
    }

    /**
     * {@inheritdoc}
     */
    public function withTrailingSlash()
    {
        return $this->withProperty('path', $this->path->withTrailingSlash());
    }

    /**
     * {@inheritdoc}
     */
    public function withoutTrailingSlash()
    {
        return $this->withProperty('path', $this->path->withoutTrailingSlash());
    }

    /**
     * {@inheritdoc}
     */
    public function replaceSegment($offset, $value)
    {
        return $this->withProperty('path', $this->path->replace($offset, $value));
    }

    /**
     * {@inheritdoc}
     */
    public function withoutSegments($offsets)
    {
        return $this->withProperty('path', $this->path->without($offsets));
    }

    /**
     * {@inheritdoc}
     */
    public function withoutDotSegments()
    {
        return $this->withProperty('path', $this->path->withoutDotSegments());
    }

    /**
     * {@inheritdoc}
     */
    public function withoutEmptySegments()
    {
        return $this->withProperty('path', $this->path->withoutEmptySegments());
    }

    /**
     * {@inheritdoc}
     */
    public function appendHost($host)
    {
        return $this->withProperty('host', $this->host->append($host));
    }

    /**
     * {@inheritdoc}
     */
    public function prependHost($host)
    {
        return $this->withProperty('host', $this->host->prepend($host));
    }

    /**
     * {@inheritdoc}
     */
    public function withoutZoneIdentifier()
    {
        return $this->withProperty('host', $this->host->withoutZoneIdentifier());
    }

    /**
     * {@inheritdoc}
     */
    public function toUnicode()
    {
        return $this->withProperty('host', $this->host->toUnicode());
    }

    /**
     * {@inheritdoc}
     */
    public function toAscii()
    {
        return $this->withProperty('host', $this->host->toAscii());
    }

    /**
     * {@inheritdoc}
     */
    public function replaceLabel($offset, $value)
    {
        return $this->withProperty('host', $this->host->replace($offset, $value));
    }

    /**
     * {@inheritdoc}
     */
    public function withoutLabels($offsets)
    {
        return $this->withProperty('host', $this->host->without($offsets));
    }

    /**
     * {@inheritdoc}
     */
    public function filterHost(callable $callable, $flag = Interfaces\Components\Collection::FILTER_USE_VALUE)
    {
        return $this->withProperty('host', $this->host->filter($callable, $flag));
    }

    /**
     * {@inheritdoc}
     */
    public function hasStandardPort()
    {
        if ($this->port->isEmpty()) {
            return true;
        }

        if ($this->scheme->isEmpty()) {
            return false;
        }

        return static::$supportedSchemes[$this->scheme->__toString()] === $this->port->toInt();
    }

    /**
     * {@inheritdoc}
     */
    public function sameValueAs($uri)
    {
        if (!$uri instanceof Interfaces\Schemes\HierarchicalUri && !$uri instanceof UriInterface) {
            return parent::sameValueAs($uri);
        }

        try {
            return static::createFromComponents(static::parse($uri->__toString()))
                ->toAscii()->withoutDotSegments()->ksortQuery()->__toString() === $this
                ->toAscii()->withoutDotSegments()->ksortQuery()->__toString();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function relativize(Interfaces\Schemes\HierarchicalUri $relative)
    {
        $className = get_class($this);
        if (!$relative instanceof $className) {
            return $relative;
        }

        if (!$this->scheme->sameValueAs($relative->scheme) || $this->getAuthority() !== $relative->getAuthority()) {
            return $relative;
        }

        return $relative
                ->withScheme('')->withUserInfo('')->withHost('')->withPort('')
                ->withPath($this->path->relativize($relative->path)->__toString());
    }

    /**
     * Tell whether the Hierarchical URI is valid
     *
     * @return bool
     */
    protected function isValidHierarchicalUri()
    {
        if ($this->scheme->isEmpty()) {
            return true;
        }

        if (!isset(static::$supportedSchemes[$this->scheme->__toString()])) {
            return false;
        }

        return !($this->host->isEmpty() && !empty($this->getSchemeSpecificPart()));
    }
}