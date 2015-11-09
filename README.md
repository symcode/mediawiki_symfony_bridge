# MediaWiki <-> Symfony Bridge

This MediaWiki extension can be installed via composer and allow you to use your symfony session for your wiki.

The Extension will create a WikiUser if your Symonfy Session is available.

It will check for an existing user with the help of the username. 

## Installation

  composer require dev-master

## Configuration

edit your LocalSettings.php and add this at the end

  $wgSessionName = "SFSESSID";
  $wgAuth = new Symcode\Mediawiki\SymfonyBridge\AuthBridge('/your/path/to/symfony/root', 'http://your-symfony-aplication.com');


