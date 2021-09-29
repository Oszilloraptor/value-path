# ValuePath

[![packagist name](https://badgen.net/packagist/name/rikta/value-path)](https://packagist.org/packages/rikta/value-path)
[![version](https://badgen.net/packagist/v/rikta/value-path/latest?label&color=green)](https://github.com/RiktaD/value-path/releases)
[![php version](https://badgen.net/packagist/php/rikta/value-path)](https://github.com/RiktaD/value-path/blob/main/composer.json)

[![license](https://badgen.net/github/license/riktad/value-path)](https://github.com/RiktaD/value-path/blob/main/LICENSE.md)
[![GitHub commit activity](https://img.shields.io/github/commit-activity/m/riktad/value-path)](https://github.com/RiktaD/value-path/graphs/commit-activity)
[![open issues](https://badgen.net/github/open-issues/riktad/value-path)](https://github.com/RiktaD/value-path/issues?q=is%3Aopen+is%3Aissue)
[![closed issues](https://badgen.net/github/closed-issues/riktad/value-path)](https://github.com/RiktaD/value-path/issues?q=is%3Aissue+is%3Aclosed)

[![ci](https://badgen.net/github/checks/riktad/value-path?label=ci)](https://github.com/RiktaD/value-path/actions?path=branch%3Amain+workflow%3A%22Testing+Path%22+workflow%3Acreate-release++)
[![dependabot](https://badgen.net/github/dependabot/riktad/value-path)](https://dependabot.com)
[![maintainability score](https://badgen.net/codeclimate/maintainability/RiktaD/value-path)](https://codeclimate.com/github/RiktaD/value-path)
[![tech debt %](https://badgen.net/codeclimate/tech-debt/RiktaD/value-path)](https://codeclimate.com/github/RiktaD/value-path/issues)
[![maintainability issues](https://badgen.net/codeclimate/issues/RiktaD/value-path?label=maintainability%20issues)](https://codeclimate.com/github/RiktaD/value-path/issues)

Perform get-operations on a string-notated subvalue of an object or array

## Installation 

`composer require rikta/value-path`

No config, no dependency-injection, nothing. Plug&Play!

## Usage

1. Create a ValuePath-instance for a path, e.g. `$path = new ValuePath('.contact.phone.0');`
2. Invoke the instance on some data, e.g. `$phone = $path($data);`

### Example

```php
$data = [
    [
        'name' => 'John Doe',
        'contact' => [
            'phone' => [
                '+49301234567'
            ]
        ]
    ]
];

$path = new Rikta\ValuePath\ValuePath('.contact.phone.0');
$phone = $path($data);

\PHPUnit\Framework\assertEquals('+49301234567', $phone);
```

## Notation

On top of the "usual" dot-notation for arrays this package also support objects.

The following notations are valid:

```php
new Rikta\ValuePath\ValuePath('.something'); // = $value['something']
new Rikta\ValuePath\ValuePath('.0'); // = $value[0]
new Rikta\ValuePath\ValuePath('["something"]'); // = $value['something']
new Rikta\ValuePath\ValuePath('->something'); // = $value->something
new Rikta\ValuePath\ValuePath('->something("a", "b", 1)]'); // = $value->something("a", "b", 1)

// it's also possible to chain the notations to get some deeply nested data
new Rikta\ValuePath\ValuePath('.something["somethingElse"]->someOtherThing->sth("a", "b")]');

// ' and " are interchangeable
new Rikta\ValuePath\ValuePath(".something['somethingElse']->someOtherThing->sth('a', 'b', 1)]");
```

## Set Data

It is planned to provide the feature to set data as well, 
but right now, while having multiple approaches, I don't have a satisfying concept for the chaining of methods.
Properties and arrays are a no-brainer, but as soon as methods come into play the whole topic gets a bit more complicated
