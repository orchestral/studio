---
title: Studio Change Log

---

## Version 3.1 {#v3-0}

### v3.1.4 {#v3-1-4}

* Passes `$force` value to downstream.

### v3.1.3 {#v3-1-3}

* Refactor `Orchestra\Studio\Console\PublishCommand` and move publishing files and routes to separate trait.
* Add `guest` middleware to user registration controller stub.

### v3.1.2 {#v3-1-2}

* Add generator commands:
  - `make:acl-policy`
* Fixes `validator.stub` indentation.

### v3.1.1 {#v3-1-1}

* Add reusable `Orchestra\Studio\Console\PublishCommand`.
* Add auth related (login, logout, register and password reset) controllers, views and routes.
* Suggest `wikimedia/composer-merge-plugin` for workbench usage.

### v3.1.0 {#v3-1-0}

* Update support to Laravel Framework v5.1.

## Version 3.0 {#v3-0}

### v3.0.0 {#v3-0-0}

* Initial release.
* Add basic generator commands:
  - `make:contract`
  - `make:filter`
  - `make:menu`
  - `make:validator`
