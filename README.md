SymfonyUserReferer
==================

This package contains a bundle to easily save information about referal users that came to your web-site
All users that registrate on web-site, and come to it with containing  GET argument "ref" (http://site.com/downloads?ref=hfkjgv),
will be saved with additional information: ref, ip, referer, date

## Installation

Add SymfonyUserReferer in your composer.json:

```js
{
    "require": {
        "virmyt/symfony-user-referer-bundle": "dev-master"
    }
}
```

Add in AppKernel.php:
``` php
       $bundles = array(
            ...
            new \Virmyt\UserRefererBundle\VirmytUserRefererBundle(),
        );
```

Configure entity mapping to your User Entity:
``` yaml
doctrine:
    ...
    orm:
        ...
        resolve_target_entities:
            Virmyt\UserRefererBundle\Model\ReferrerInterface: App\MainBundle\Entity\User
```
where App\MainBundle\Entity\User - should be your User Entity. 

And it MUST implement Virmyt\UserRefererBundle\Model\ReferrerInterface
``` php
<?php
use Virmyt\UserRefererBundle\Model\ReferrerInterface;
class User implements ReferrerInterface {
    public function getRef()
    {
        return $this->ref; // For examle
    }
...
```

Update DB schema:
``` bash
php app/console doctrine:schema:update --dump-sql -v --force
```

## Usage:
All Referal data about user will be saved in single table users_referral that have relation to your UserEntity.
