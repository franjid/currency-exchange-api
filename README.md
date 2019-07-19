# Basic "API" implementation

This is a simple exercise to show how to implement some code for a [theoretical currency API](docs/api.md)

First things first, install dependencies via composer :

```
composer install
```

Now you could run tests (hopefully you will see everything green):
```
./vendor/bin/phpunit tests/unit --colors
```

I've created a file that will show some API endpoints and the output they would have:
```
php src/Application/index.php
```
