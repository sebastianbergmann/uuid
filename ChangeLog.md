# ChangeLog

All notable changes are documented in this file using the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [2.0.0] - 2026-MM-DD

### Added

* `uuidFromBytes()` for creating a UUID of a given version (1 to 8) from 16 given bytes, with the bits of its version and its variant set according to [RFC 9562](https://www.rfc-editor.org/rfc/rfc9562)

### Removed

* This component is no longer supported on PHP 8.1, PHP 8.2, and PHP 8.3

## [1.0.2] - 2023-07-13

### Changed

* Narrowed return type of `uuid()` from `string` to `non-empty-string`

## [1.0.1] - 2023-03-26

* No functional changes

## [1.0.0] - 2023-03-21

* Initial release

[2.0.0]: https://github.com/sebastianbergmann/uuid/compare/1.0.2...main
[1.0.2]: https://github.com/sebastianbergmann/uuid/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/sebastianbergmann/uuid/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/sebastianbergmann/uuid/compare/f4a58bc49316b4dae46aa69cbe311d08932be2f6...1.0.0
