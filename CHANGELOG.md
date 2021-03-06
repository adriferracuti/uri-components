# Changelog

All Notable changes to `League\Uri\Components` will be documented in this file

## 1.2.0 - 2017-11-06

### Added

- `League\Uri\build_query` as an alias of `Query::build`

### Fixed

- function docblocks

### Deprecated

- None

### Remove

- None

## 1.1.1 - 2017-11-03

### Added

- `League\Uri\parse_query` as an alias of `Query::parse`
- `League\Uri\extract_query` as an alias of `Query::extract`

### Fixed

- `League\Uri\parse_query` returned value was the wrong one

### Deprecated

- None

### Remove

- None

## 1.1.0 - 2017-10-24

### Added

- `League\Uri\parse_query` as an alias of `Query::extract`

### Fixed

- Internal call in PHP7.2 with incompatible definitions
- update PHP Domain Parser to be compatible with PHP7.2 deprecation notice
- remove restriction to constructor characters for `Path`, `Query` and `UserInfo`.

### Deprecated

- None

### Remove

- None

## 1.0.4 - 2017-08-10

### Added

- None

### Fixed

- Bug fix label conversion depending on locale [issue #102](https://github.com/thephpleague/uri/issues/102)

### Deprecated

- None

### Remove

- None

## 1.0.3 - 2017-04-27

### Added

- None

### Fixed

- Bug fix negative offset [issue #5](https://github.com/thephpleague/uri-components/issues/5)

### Deprecated

- None

### Remove

- None

## 1.0.2 - 2017-04-19

### Added

- None

### Fixed

- Improve registered name validation [issue #5](https://github.com/thephpleague/uri-parser/issues/5)

### Deprecated

- None

### Remove

- None

## 1.0.1 - 2017-02-06

### Added

- None

### Fixed

- Update idn to ascii algorithm from INTL_IDNA_VARIANT_2003 to  INTL_IDNA_VARIANT_UTS46

### Deprecated

- None

### Remove

- None

## 1.0.0 - 2017-01-17

### Added

- None

### Fixed

- Improve validation check for `Query::build`
- Remove `func_* function usage
- Improve `HierarchicalPath::createFromSegments`
- Internal code simplification

### Deprecated

- None

### Remove

- None

## 1.0.0-RC1 - 2017-01-09

### Added

- `ComponentInterface`
- `EncodingInterface`
- `HierarchicalPath::withDirname`
- `HierarchicalPath::withBasename`
- `HierarchicalPath::withoutSegments`
- `HierarchicalPath::replaceSegment`
- `Host::withRegisterableDomain`
- `Host::withSubdomain`
- `Host::withRootLabel`
- `Host::withoutRootLabel`
- `Host::withoutLabels`
- `Host::replaceLabel`
- `Query::getParams`
- `Query::getParam`
- `Query::append`
- `Query::hasPair`
- `Query::withoutPairs`

### Fixed

- ComponentInterface::getContent supports RFC1738
- The methods that accept integer offset supports negative offset
    - `HierarchicalPath::getSegment`
    - `HierarchicalPath::replaceSegment`
    - `HierarchicalPath::withoutSegments`
    - `Host::getLabel`
    - `Host::replaceLabel`
    - `Host::withoutLabels`
- `Query::merge` only accepts string

### Deprecated

- None

### Remove

- PHP5 support
- Implementing `League\Uri\Interfaces\Component`
- `Query::hasKey`
- `Query::without`
- `Query::filter`
- `Host::hasKey`
- `Host::without`
- `Host::filter`
- `Host::replace`
- `HierarchicalPath::hasKey`
- `HierarchicalPath::without`
- `HierarchicalPath::filter`
- `HierarchicalPath::replace`
- `League\Uri\Components\PathInterface`

## 0.5.0 - 2016-12-09

### Added

- None

### Fixed

- Remove `League\Uri\Interfaces\CollectionComponent` interface dependencies from:
    - `League\Uri\Components\Host`
    - `League\Uri\Components\HierarchicalPath`

- Bug fix `League\Uri\Components\Query::build`

- Update dependencies on `League\Uri\Interfaces`

### Deprecated

- None

### Remove

- None

## 0.4.0 - 2016-12-01

### Added

- None

### Fixed

- `League\Uri\Components\Host::getContent` now support correctly RFC3987
- `League\Uri\Components\Host::__toString` only returns RFC3986 representation
- `League\Uri\Components\UserInfo::getUser` to use the `$enc_type` parameter
- `League\Uri\Components\UserInfo::getPass` to use the `$enc_type` parameter

### Deprecated

- None

### Remove

- `League\Uri\Components\Host::isIdn`
- `League\Uri\Components\Port::getDecoded`
- `League\Uri\Components\Scheme::getDecoded`

## 0.3.0 - 2016-11-29

### Added

- `League\Uri\Components\Exception` as the base exception for the library
- `League\Uri\Components\DataPath::getDecoded` returns the non-encoded path
- `League\Uri\Components\HierarchicalPath::getDecoded` returns the non-encoded path
- `League\Uri\Components\Path::getDecoded` returns the non-encoded path
- `League\Uri\Components\Fragment::getDecoded` returns the non-encoded fragment
- `League\Uri\Components\Port::getDecoded` returns the non-encoded port
- `League\Uri\Components\Scheme::getDecoded` returns the non-encoded scheme
- `League\Uri\Components\Query::extract` public static method returns a hash similar to `parse_str` without the mangling from the query string

### Fixed

- `getContent` is updated to support RFC3987

### Deprecated

- None

### Removed

- `Query::parsed` use `Query::extract` instead
- `Query::parsedValue` use `Query::extract` instead

## 0.2.1

### Added

- None

### Fixed

- issue [#84](https://github.com/thephpleague/uri/issues/84). Query string is not well encoded.

### Deprecated

- None

### Removed

- None

## 0.2.0

### Added

- `Query::parsed` returns an array similar to `parse_str` result with a second options with unmangled key.
- `Query::getParsedValue` returns single value from the parse and unmangled PHP variables.
- `Host::createFromIp` a name constructor to create a host from a IP
- `Host::getIp` returns the IP part from the host if present otherwise returns `null`

### Fixed

- `Host::__construct` no longers takes a IPv6 without delimiter as a valid argument.

### Deprecated

- None

### Removed

- None

## 0.1.1 - 2016-11-09

- improve dependencies - broken

## 0.1.0 - 2016-10-17

### Added

- None

### Fixed

- `League\Uri\QueryParser` is now a trait `League\Uri\Components\Traits\QueryParser` used by `League\Uri\Components\Query`
- `League\Uri\Components\UserInfo` now only accepts string and null as constructor parameters.

### Deprecated

- None

### Removed

- `League\Uri\Components\User`
- `League\Uri\Components\Pass`
- `League\Uri\QueryParser`