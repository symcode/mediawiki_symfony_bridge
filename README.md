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

_Important_

    $wgSessionName
    
You need to define here the same Session name as in symfony. In a future update we will configure this automatically.
You need to define it in symfony and also you need to define the cookie name for subdomain support ( i.e wiki.xxxx.com symfony.xxx.com or xxx.com )


    session:
        cookie_lifetime: 0
        name: SFSESSID
        cookie_domain: ".symcode.de"

## Features

### Symfony Session

The current extension will read your symfony session.

If a Session exist, a User will created in the Wiki Database based on the symfony username and the User will be automatically logged in.

*Warning* If you allow username changes in your symfony application you need to handle the name change also in MediaWiki. If not the Extension will create a new WikiUser with the new Name and the old Wiki User will stay forever in the Database.


### Groups

If your Symfony User Object has an Method "getGroups", the Groups will be added to the wiki user

(Your Group object need an getId() method)

For the best result use the FosUserBundle

### Group Namepspaces

If you want to protect some namespaces only to group users you need to unstall the Lockdown Extension (https://www.mediawiki.org/wiki/Extension:Lockdown)

And then pass a 3t argument to the AuthBridge constructor. This argument need to be your group manager symfony service name (FosUserBundle default is "fos_user.group_manager").

After this the Bridge will add permissions for all symfony groups and create some group namespace where only group members have access


## ToDo

### Correct Login/Logout redirect

Currently the Login/Logout will only redirect to your Symfony URL. But we are planing to get the correct route based in the routing.

### Session Name

We need to get the Session name from the Symfony Configuration and define $wgSessionName in the constructor of our class