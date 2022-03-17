<?php

// Use this namespace
use Steampixel\Portal;

// Include portal class
include 'src/Steampixel/Portal.php';

// Initiate the portal engine
// Portals will work from now
Portal::init();

// Lets throw some data into portals before the template is created
Portal::send('javascript', '<script>console.log("Hello world 1");</script>');
Portal::send('main-content', '<h1>Hey! Welcome</h1>');
Portal::send('style', '<style>body{background:#ccc;}</style>');

// Lets send a snippet of Javascript once to a target portal
// This is usefull if some plugins or theme particals requires the same snippet
Portal::send('javascript', '<script>console.log("Hello world 2");</script>', false, true);

// Define for example a simple HTML template and fill it with portals
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
      // So some template modules can require aditional styles and scripts for example
      Portal::send('javascript', '<script>console.log("Hello world 3");</script>');
      Portal::send('main-content', 'This is the portal engine.<br>');
      Portal::send('style', '<style>body{font-size:1rem;}</style>');
    ?>

    <?=Portal::open('javascript') ?>

  </body>

</html>
<?PHP

// Lets throw some contents to the portals after the template was created
Portal::send('javascript', '<script>console.log("Hello world 4");</script>');
Portal::send('main-content', 'Hope it will not create a black hole.<br>');
Portal::send('style', '<style>body{text:#cc0000;}</style>');

// Prepend content instead of appending it
Portal::send('main-content', '<p>The portal page</p>', true);

// Lets send a snippet of Javascript once to a target portal
// This is usefull if some plugins or theme particals requires the same
Portal::send('javascript', '<script>console.log("Hello world 2");</script>', false, true);

// Do the portal magic, compose all contents together and print the result
Portal::compose();
