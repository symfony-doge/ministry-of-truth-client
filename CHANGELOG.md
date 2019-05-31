# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Changes
- No changes yet.

## [0.1.1] - 2019-05-31
### Fixed

- Response deserialization fixes

Main client can now be used for real requests (`symfony_doge.motc.client` @ symfony bridge). Server example: 
[symfony-doge/ministry-of-truth-cis](https://github.com/symfony-doge/ministry-of-truth-cis). 

## [0.1.0] - 2019-03-27
### Added

- Integration layer DTOs (request/response models and intermediate data structures).
- `ClientInterface` with `index` and `getTagGroups` methods.
- `Client` facade that implements an interface and uses 
`GuzzleHttp\ClientInterface`, `Uri\Builder` and other components
for sending HTTP requests to the API endpoint.
- `ValidatorAwareClient` that expands a base client logic by performing 
request validation before any interactions with API endpoint.
- Bridge for library integration into the Symfony environment which defines
a configuration rule set and registers all necessary services.

Main client is not stable yet at this stage, so only `DummyClient` can be used
for client code developing and testing
(`symfony_doge.motc.dummy_client` @ symfony bridge). 

[Unreleased]: https://github.com/symfony-doge/ministry-of-truth-client/compare/0.1.1...0.x
[0.1.1]: https://github.com/symfony-doge/ministry-of-truth-client/releases/tag/0.1.1
[0.1.0]: https://github.com/symfony-doge/ministry-of-truth-client/releases/tag/0.1.0