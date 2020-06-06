---
layout: default
title: Project Guide
parent: Contributing
---

# Project Guide
{: .no_toc}

- TOC
{:toc}

---

## Directory Structure

```
Philly/
 ├── src/
 │    ├── Container/
 │    │    └── Container.php
 │    ├── Contracts/
 │    │    ├── Container/
 │    │    │    └── Container.php
 │    │    └── App.php
 │    └── App.php
 ├── test/
 │    ├── Unit/
 │    │    ├── Container/
 │    │    │    └── ContainerTest.php
 │    │    └── AppTest.php
 │    ├── TestClass.php
 │    └── TestInterface.php
 └── composer.json
```

The directory structure should be familiar if you ever worked on PHP projects before.
There are three main folders at the top-level:

- `src`: Houses all the source code for the framework.
- `test`: Contains the source code of all tests.

There are also a lot of other files at the top-level, but they are not important right now.
The only file you should look into is the `composer.json`.
It declares where the autoloader (and you) should look when encountering an unloaded class:

```json
...
  "autoload": {
    "psr-4": {
      "Philly\\": "src"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "test\\Philly\\": "test"
    }
  },
...
```

As you can see, the files in the `src` folder have the namespace `Philly\` and tests have the namespace `test\Philly\`.
This part also tells you that Philly uses the [PSR-4](https://www.php-fig.org/psr/psr-4/) autoloading standard to load classes.

## Coding Style

Using a common code style helps to reduce stress levels when reading code from others.
To work against this, Philly follows the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style standard.
Your code doesn't need to be perfect. Most small details get fixed by [StyleCI](#styleci) automatically.

### .editorconfig

This project uses an `.editorconfig` file to establish a common file styling across common IDEs and editors.
It uses a lot of JetBrains specific tags, so if you are using a JetBrains IDE (like PhpStorm), they will be respected.

### PHP DocBlocks

There are a few tools used by Philly which rely on consistent style and meaningful contents in the documentation blocks.
Below you can see a valid docblock in Philly source code.
The most important part is the type-hint when documenting parameters, throw declarations and return types.
Whenever you can, use PHP 7's type-hints (like in this example).

```php
     /**
      * Checks if this container accepts the provided instance as a binding. Throws an exception if the given type is not
      * acceptable.
      *
      * @param mixed $instance The instance to check.
      *
      * @throws UnacceptableBindingException If the given type is not acceptable for binding.
      *
      * @return object The given instance.
      */
     public function verifyAcceptable($instance): object { ... }
```

It is not always possible to use type-hints to declare the type of variable.
In this case, please use a docblock so tools like [psalm](https://psalm.dev/) can infer the type from it.
This example shows how to do an inline-type-hint via a docblock:

```php
    ...
    /** @var Foo $foo */
    $foo = get_foo();
    ...
```

## Tooling

Philly uses multiple tools to analyze and test the submitted code.

### PHPUnit & Infection

To execute tests, Philly uses [PHPUnit](https://phpunit.de/).
Additionally, Philly uses [Infection](https://infection.github.io/) to analyze how effective the tests really are.

To run PHPUnit locally, execute

```bash
$ composer run-script test
```

or

```bash
$ vendor/bin/phpunit --configuration=phpunit.xml.dist
```

For Infection, execute

```bash
$ composer run-script infect
```

or

```bash
$ vendor/bin/infection --configuration=infection.json.dist
```

### Psalm

The codebase is statically analyzed by [Psalm](https://psalm.dev).
As stated above, Psalm uses docblocks and type-hints to infer the types of variables and return types of functions.
This way, it can check for possible errors beforehand, so we can fix them before they even happen.

To execute Psalm locally, run

```bash
$ composer run-script stan
```

or

```bash
$ vendor/bin/psalm --config=psalm.xml.dist
```

### StyleCI

Philly uses [StyleCI](https://styleci.io) to fix small issues with code styling.
