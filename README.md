Project based on Symfony Standard Edition
========================

Using vagrant with ansible
---

1) Composer install (more on [Installing (Use Composer)](#composer))
    
    cd ./project
    composer install    

2) Create env via Vagrant:
 
    cd ./vagrant
    vagrant up

4) add to you hosts:
 
    12.18.56.100 project_demo.vagrant www.project_demo.vagrant
     
5) on browser 

    http://12.18.56.100
    
    or
    
    http://project_demo.vagrant

On box:

* Ubuntu Precise Pangolin (12.04) [LTS] 32

* memory: 512

* ip: 12.18.56.95

* shared folder: /project to /var/www/project

* timezone: UTC

* nginx, DocRoot: /var/www/project, ServerName: impartsocial.vagrant

* php7 (modules: php7.0-cli, php7.0-intl, php7.0-mcrypt, php7.0-curl, php7.0-gd, php7.0-imap, php7.0-mysql | options: short_open_tag=1, opcache.enable_cli=1)

* mysql (user: project, pass: project, dbname: project_dev)

Project structure
---

* config/ - config directory contains all configs, required for running application in production-like environment. 

For instance, web projects should have at least web-server config. Another examples are database, search engine, message queue etc.

Recommended to store configs due to their original file system structure. 

For example, unix-way restricts to put nginx vhost config here: /etc/nginx/sites-available/project.conf

* db/ - db-directory contains database create/update statement scripts (.sql for instance) without any fixture data.

* deploy/ -  Build directory contains all required scripts or manifests for building and deploying project.

* vagrant/ -  vagrant configs with ansible.

* project/ - Here is project placeholder, with its own unique file structure and required artifacts.


Deploy
===

You can find all information about deploying on: [https://wiki.ciklum.net/display/PRPHP/Continuous+Integration][21]
For setup jenkins user on env: https://wiki.ciklum.net/display/POST/Keys

Project
===

This folder include [Symfony Standard Edition][14] and some additional features, bundles.

1) composer.json
---

composer.json include some additinal repositories:

* ["sensio/distribution-bundle"][15] - (in dev/test env) - Adds functionality for configuring and working with Symfony distributions.

* ["sensio/framework-extra-bundle"][6] - Adds several enhancements, including template and routing annotation capability.

* ["incenteev/composer-parameter-handler"][16] - This tool allows you to manage your ignored parameters when running a composer install or update.

* ["twig/extensions"][17] - This repository hosts Twig Extensions that do not belong to the core but can be nonetheless interesting to share with other developers.

* ["doctrine/doctrine-bundle"][7] - Adds support for the Doctrine ORM

* ["doctrine/doctrine-migrations-bundle"][18] - This bundle integrates the Doctrine2 Migrations library. into Symfony so that you can safely and quickly manage database migrations.
  
* ["doctrine/doctrine-fixtures-bundle"][19] - This bundle integrates the Doctrine2 Data Fixtures library. into Symfony so that you can load data fixtures programmatically into the Doctrine ORM or ODM.
 
* ["beberlei/DoctrineExtensions"][20] - A set of extensions to Doctrine 2 that add support for additional query functions available in MySQL and Oracle.

at additional composer.json include some scripts for:

* copy parameters from parameters.yml.dist to  parameters.yml

* clear cache

* symfony assets-install

at additional composer.json include some link to custom private repositories (if you wann't use this remove links)

2) Configuration
---

  * configured `app/config/doctrine.yml`, `app/config/security.yml`, `app/config/routing.yml` and all `app/config/parameters.yml.*`;
  
  * if you use sonata admin bundle configured `app/config/admin.yml` else remove this file;
  
  * enable resource configuration files on `app/config/config.yml`;

<a name="composer"></a>3) Installing (Use Composer)
----

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Composer will install Symfony and all its dependencies under the `path/to/install` directory.

    php composer.phar install

4) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path-to-project/web/config.php

If you get any warnings or recommendations, fix them before moving on.

5) Browsing the Demo
--------------------------------

Congratulations! You're now ready to use Symfony.

From the `config.php` page, click the "Bypass configuration and go to the
Welcome page" link to load up your first Symfony page.

You can also use a web-based configurator by clicking on the "Configure your
Symfony Application online" link of the `config.php` page.

To see a real-live Symfony page in action, access the following page:

    web/app_dev.php/ - see not secured page
    web/app_dev.php/secure - see error page, because you is not authorized user

6) Getting started with Project
-------------------------------

This distribution is meant to be the starting point for your Symfony
applications, but it also contains some sample code that you can learn from
and play with.

A great way to start learning Symfony is via the [Quick Tour][4], which will
take you through all the basic features of Symfony2.

Once you're feeling good, you can move onto reading the official
[Symfony2 book][5].

A default bundle, `ProjectAppBundle`, shows you Symfony2 in action. After
playing with it, you can remove it by following these steps:


What's inside?
---------------

The Symfony Standard Edition is configured with the following defaults:

  * Twig is the only configured template engine;

  * Doctrine ORM/DBAL is configured;

  * Swiftmailer is configured;

  * Annotations for everything are enabled.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][12] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **ProjectAppBundle** - A demo bundle with some example code

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  http://symfony.com/doc/2.5/book/installation.html
[2]:  http://getcomposer.org/
[3]:  http://symfony.com/download
[4]:  http://symfony.com/doc/2.5/quick_tour/the_big_picture.html
[5]:  http://symfony.com/doc/2.5/index.html
[6]:  http://symfony.com/doc/2.5/bundles/SensioFrameworkExtraBundle/index.html
[7]:  http://symfony.com/doc/2.5/book/doctrine.html
[8]:  http://symfony.com/doc/2.5/book/templating.html
[9]:  http://symfony.com/doc/2.5/book/security.html
[10]: http://symfony.com/doc/2.5/cookbook/email.html
[11]: http://symfony.com/doc/2.5/cookbook/logging/monolog.html
[12]: http://symfony.com/doc/2.5/cookbook/assetic/asset_management.html
[13]: http://symfony.com/doc/2.5/bundles/SensioGeneratorBundle/index.html
[14]: https://github.com/symfony/symfony-standard
[15]: https://github.com/sensiolabs/SensioDistributionBundle
[16]: https://github.com/Incenteev/ParameterHandler
[17]: https://github.com/twigphp/Twig-extensions
[18]: http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html
[19]: http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
[20]: https://github.com/beberlei/DoctrineExtensions
[21]: https://wiki.ciklum.net/display/PRPHP/Continuous+Integration
