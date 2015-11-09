# MediaWiki <-> Symfony Bridge

This MediaWiki extension can be installed via composer and allow you to use your symfony session for your wiki.

The Extension will create a WikiUser if your Symonfy Session is available.

It will check for an existing user with the help of the username. 

## Important

This Extension require both Systems (Wiki and Symfony) on the same webserver.

And the Wiki (Webserver/vhost) User need access to the Symfony Files to initalize the Kernel and get the Session.

This Extension *will not* simmulate the Symfony Session via Database Access. We are using the existing Symfony Kernel.

## Installation

    composer require symcode/mediawiki_symfony_bridge dev-master

## Configuration

edit your LocalSettings.php, add this at the end:

    $wgSessionName = "SFSESSID";
    $wgAuth = new Symcode\Mediawiki\SymfonyBridge\AuthBridge('/your/path/to/symfony/root', 'http://your-symfony-aplication.com');

## Features

### Symfony Session

The current extension will read your Symfony Session.

If a Session exist, a User will created in the Wiki Database based on the Symfony Username and the User will be automaticly logged in.

*Warning* If you allow Username Changes in your Symfony Application you need to handle the Name Change also in MediaWiki. If not the Extension will create a new WikiUser with the new Name and the old Wiki User will stay forever in the Database.


## ToDo

### User Groups

A upcomming feature will be to use the Symfony User Groups for the Wiki Groups.

### Correct Login/Logout redirect

Currently the Login/Logout will only redirect to your Symfony URL. But we are planing to get the correct route based in the routing.
