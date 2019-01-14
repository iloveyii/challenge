Challenge - coding
===============================


This is an app for coding challenges. The admin can create a challenge and invite others to complete it. The code is tested against the results and performance automatically.

![Screenshot](http://challenge.softhem.se/images/screenshot.png)

# [Demo](http://challenge.softhem.se/)

INSTALLATIONS
---------------
  * Clone the repository `git clone git@bitbucket.org:iloveyii/challenge.git`.
  * Run composer install `composer install`.
  * Then run composer command `composer dump-autoload`.
  * Create a database (manually for now) and adjust the database credentials in the `common/config/main.local.php` file as per your environment.
  * Run the init command to create the database table as `php init.php`.
  * Point web browser to frontend/web directory or Create a virtual host using [vh](https://github.com/iloveyii/vh) `vh new challenge -p ~/challenge/frontend/web`
  * Browse to [http://challenge.loc](http://challenge.loc) 
  

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```