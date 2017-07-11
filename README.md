![Tania](project-logo.png "Tania Logo")

Tania is a free and open source farming management system for everyone. You can manage your growing areas, reservoirs, farm tasks, inventories, and the crop growing progress.

It is developed on top of Symfony PHP web framework.

This project is under active development. You can checkout the `development` branch to get the latest development progress.

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

Second, setup your database and mailer parameters in `app/config/parameters.yml`. You can duplicate and rename the `app/config/parameters.yml.dist` file.

Third, setup the web application:

```
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

The last, setup the database tables:

```
php bin/console --no-interaction doctrine:migrations:migrate
```

Done! You can start to use Tania.

## Installation notes

If you use MySQL 5.7, you should disable `ONLY_FULL_GROUP_BY`. You can refer to this [StackOverflow discussion](https://stackoverflow.com/questions/23921117/disable-only-full-group-by).

## Questions and issues

You can use [the issue tracker of Tania](https://github.com/tanibox/tania/issues) for bug reporting, feature request, and general feedback.

## Maintainers

Current maintainers:

- Asep Bagja Priandana - [Linkedin](https://www.linkedin.com/in/asepbagja/)
- Retno Ika Safitri - [Linkedin](https://www.linkedin.com/in/retnoika/)

If you are interested in being a core contributor to this project, please drop me an email at __asep@asep.co__.

## License

Tania is available under Apache 2.0 open source license.
