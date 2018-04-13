# End Official Support and Maintenance for Tania PHP

As the rewrite of Tania from PHP to Go is completed, and we have released the new Tania project to the public repository. The support for Tania PHP is ended. Please, check the new project at [tania-core](https://github.com/Tanibox/tania-core).

![Tania](readme-assets/project-logo.png "Tania Logo")

[![Gitter chat](https://badges.gitter.im/gitterHQ/gitter.png)](https://gitter.im/taniafarm/Lobby)
[![Build Status](https://travis-ci.org/Tanibox/tania.svg?branch=development)](https://travis-ci.org/Tanibox/tania)

Tania is a free and open source farming management system for everyone. You can manage your growing areas, reservoirs, farm tasks, inventories, and the crop growing progress.

It is developed on top of Symfony PHP web framework.

To get the stable release, you can checkout to the `master` branch or from the [release tab](https://github.com/Tanibox/tania/releases).

## Screenshots

![Tania Dashboard](https://s3-ap-southeast-1.amazonaws.com/asepco/iot-dashboard.PNG "Tania Dashboard")

## Requirements

- PHP >= 7.0
- MySQL >= 5.6
- Composer (you can install from [getcomposer.org](http://getcomposer.org))

## General installation steps

First, clone this project:

```
git clone git@github.com:Tanibox/tania.git
cd tania
```

Second, setup your database and mailer parameters in `/.env`. You can duplicate and rename the `/.env-example` file.

Third, setup the web application:

```
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

Fourth, setup the database tables:

```
php bin/console --no-interaction doctrine:migrations:migrate
```

Fifth, create user:

```
php bin/console fos:user:create {{user}} {{email}} {{password}}
```

The last, you can run Tania in development mode (on your PC or laptop) by using this command:

```
php bin/console server:run
``` 

Tania will run on `http://localhost:8000`.

You can also run Tania in production mode (on your server) by referring to this [Symfony documentation](http://symfony.com/doc/current/setup/web_server_configuration.html).

Done! You can start to use Tania.

## Questions and issues

You can use [our JIRA issue tracker](https://gettania.atlassian.net) for bug reporting, feature request, and general feedback.

## Maintainers

Current maintainers:

- Asep Bagja Priandana - [Linkedin](https://www.linkedin.com/in/asepbagja/)
- Retno Ika Safitri - [Linkedin](https://www.linkedin.com/in/retnoika/)
- Didiet Noor - [Linkedin](https://www.linkedin.com/in/didiet/)

If you are interested in being a core contributor to this project, please drop me an email at __asep@tanibox.com__.

## License

Tania is available under Apache 2.0 open source license.
