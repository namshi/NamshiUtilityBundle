# NAMSHI | UtilityBundle

This bundle provides some basic, silly utilities
that we use across our Symfony2 applications.

## Installation

The bundle can be easily installed via
composer (`"namshi/utility-bundle": "dev-master"`).

More informations available on
[Packagist](https://packagist.org/packages/namshi/utility-bundle).

Then enable it in the `AppKernel.php`:

``` php
new Namshi\UtilityBundle\NamshiUtilityBundle(),
```

## File serving with authentication

One of the utilities that you can take
advantage of is file serving, mixing it
with authentication.

Suppose you have a file, `protected.txt`,
in `/path/to/symfony2/data/protected.txt`
and you want only some users to be able
to access it.

You just have to enable a route that tells
the bundle which file to serve:

``` yml
protected_file:
    pattern:  /protected.txt
    defaults: { _controller: NamshiUtilityBundle:Default:serveFile, file: protected.txt }
```

and define the file path in the `parameters.yml`:

``` yml
namshi_utility.files.protected.txt: /path/to/symfony2/data/protected.txt
```

At that point you will be able to access the
content of the file (it uses `file_get_contents()`, so
don't try using this utility as a download manager).

How to restrict access to the file then? Simply use
the built-in ACL system that you have in Symfony2:
configure your `security.yml` for the path `^/protected.txt`
and you're done.