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

## Doctrine CommaSeparatedList type

If you want to persist an array into the
DB as a list of comma-separated strings (ie.
to be able to execute [FIND_IN_SET](http://dev.mysql.com/doc/refman/5.0/en/string-functions.html#function_find-in-set))
you can simply use the `Namshi\UtilityBundle\ORM\Type\CommaSeparatedList`
type.

Remember to register it inside Symfony2's `config.yml`:

```
doctrine:
    dbal:
        types:
            comma_separated_list: Namshi\UtilityBundle\ORM\Type\CommaSeparatedList
```

and then use it on your entities:

``` php
/**
 * @var array
 *
 * @ORM\Column(name="tags", type="comma_separated_list", nullable=true)
 */
protected $tags = array();
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

## Currency conversion

Totally unrelated to Symfony2, but included here for (our) conveniency,
there is a currency converter that accepts conversion rates
and can be used to easily convert an amount from a currency to
another one.

``` php
<?php

use Namshi\UtilityBundle\Currency\Converter;
use Namshi\UtilityBundle\Currency\Currency;
use Namshi\UtilityBundle\Exception\CurrencyNotFound;

$conversionRates = array(
  'EUR' => array(
    'USD' => 1.3,
  ),
  'USD' => array(
    'AED' => 4,
    'EUR' => 0.7,
  ),
);

$converter = new Converter($conversionRates);

try {
    echo $converter->convert(12, Currency::UNITED_STATES_DOLLAR, Currency::EURO)
} catch (CurrencyNotFound $e) {
    echo "Yo boss, can ya provide conversion rates here?";
}
```
