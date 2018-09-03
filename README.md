Phulp Changed
=============

It's a third-party project that lets you filter out files that haven't changed.

## Installation

```bash
composer require nsrosenqvist/phulp-changed
```

## Usage

You must pass the destination directory as the argument in the construct so that
the source files can be compared with that directory.

```php
<?php

use NSRosenqvist\Phulp\ChangedFilter;

$phulp->task('images', function ($phulp) {
    $phulp->src(['assets/images/'], '/png$/')
        ->pipe(new ChangedFilter('dist/images/'))
        ->pipe($phulp->dest('dist/images/'));
});
```

## License
MIT
