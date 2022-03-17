# Simple PHP Portals ⇶🕳⇇
Hey! This is a simple, puristic and small PHP portal engine. With portals, you can send contents from any procedural point of your app to any other point. Throw your contents back and forth through time. A portal is a single point of time and space inside your template or app. You can just open portals and then send contents to there from any other location of your app. No mater if the target portal is defined before or after, you will send content to there. This makes portals extremely efficient. Portals just work by replacing strings and will not require complex parsing. So this approach is very fast.

## Simple example:
```php
<?php

// Use this namespace
use Steampixel\Portal;

// Include portal class
include 'src/Steampixel/Portal.php';

// Initiate the portal engine
// Portals will work from now
Portal::init();

// Lets throw some data into portals before the template is created
// Imagine this could be done through plugins or third party theme files
Portal::send('javascript', '<script>console.log("Hello world 1");</script>');
Portal::send('main-content', '<h1>Hey! Welcome</h1>');
Portal::send('style', '<style>body{background:#ccc;}</style>');

// Define for example a simple HTML template and fill it with target portals
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?=Portal::open('head') ?>
    <?=Portal::open('style') ?>
  </head>

  <body>

    <?=Portal::open('main-content') ?>

    <?PHP
      // Lets throw some contents to the portals while the template is created
      // This is usefull if your theme is composed by partials
      // So some partials can require aditional styles or scripts while the theme gets composed
      Portal::send('javascript', '<script>console.log("Hello world 2");</script>');
      Portal::send('main-content', 'This is the portal engine.<br>');
      Portal::send('style', '<style>body{font-size:1rem;}</style>');
    ?>

    <?=Portal::open('javascript') ?>

  </body>

</html>
<?PHP

// Lets throw some contents to the portals after the template was created
Portal::send('javascript', '<script>console.log("Hello world 3");</script>');
Portal::send('main-content', 'Hope the portal engine will not create a black hole.<br>');
Portal::send('style', '<style>body{text:#cc0000;}</style>');

// Do the portal magic, compose all contents together and print the result
Portal::compose();

```
## Installation using Composer
Just run `composer require steampixel/simple-php-portals`
Than add the autoloader to your project like this:
```php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Portal;

Portal::init();

```

## Prepend contents instead of appending them
Sometimes you want to prepend contents to a portal instead of appending it.
Just set the first parameter to true to prepend the content to the current stack.
```
Portal::send('main-content', '<p>The portal page</p>', true);
```

## Send contents only once
Sometimes contents should only send once to a portal. No mater how often they are sent to there.
This is useful if some plugins or theme partials requires the same resources, for example.
Set the fourth parameter to true, so the following JavaScript will only be sent once:
```
Portal::send('javascript', '<script>console.log("Hello world 2");</script>', false, true);
```

## Test setup with Docker
I have created a little Docker test setup.

1. Build the image: `docker build -t simplephpportals docker/image-php-7.4.1`

2. Spin up a container: `docker run -d -p 80:80 -v $pwd:/var/www/html --name simplephpportals simplephpportals`

3. Open your browser and navigate to http://localhost

## License
This project is licensed under the MIT License. See LICENSE for further information.
