# Bubbles

<img src="/screenshots/preview.png?raw=tru" width="240" align="right" style="margin-left: 20px;" alt="screenshot of Bubbles" />

## Archived Project

This project has been archived. Forking is still possible, but the code has known security issues in some of its dependencies, such as [axios](https://github.com/REMEXLabs/Bubbles/network/alert/package-lock.json/axios/open) and [tar](https://github.com/REMEXLabs/Bubbles/network/alert/package-lock.json/tar/open).

## Gamification Patterns

- User based Level and Experience System (Architecture, Design)
- Game Wording and Style (Quests, Icons)
- User Ranking
- Progress Bars (Level, Status)
- Clean Dashboard Design (Bubbles)


## Publications

- [Gamification in the Development of Accessible Software](http://link.springer.com/chapter/10.1007/978-3-319-07437-5_17)
- [Gamification and Accessibility](http://link.springer.com/chapter/10.1007/978-3-319-20892-3_15)


## Video

- [Gamification and Accessibility](http://events.mi.hdm-stuttgart.de/2015-06-19-acessibility-day/Accessible%20Gamification)


## Server Configuration

```
composer install --ignore-platform-reqs
sudo chmod 755 -R bubbles.gpii.eu/
sudo chmod -R o+w bubbles.gpii.eu/storage
sudo chmod -R o+w bubbles.gpii.eu/bootstrap/cache/
```


## Contributing

The following tools are required to contribute:

- [Node.js](https://nodejs.org/en/download/)
- [Gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)
- [Bower](https://bower.io/#install-bower)
- [Composer](https://getcomposer.org/)

After the installation you can install all dependencies and requirements:

```
git clone https://github.com/REMEXLabs/Bubbles.git .
php composer.phar install
npm install
bower install
php artisan migrate:refresh --seed
```

Please don't forget to create a new database and to setup a [local environment](https://laravel.com/docs/5.2/configuration) `.env` file.

Thank you for considering contributing to the project! You can build und test the website by running the `gulp build` or `gulp watch` task. After that you can send your changes as pull request to the repository.


## Licence & Copyright

Bubbles uses the Laravel framework, which is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT). 

The developed website is open-source software licensed under the [Apache license](http://www.apache.org/licenses/LICENSE-2.0).

Copyright 2015-2017 Hochschule der Medien (HdM) / Stuttgart Media University ([research group Remex](https://www.hdm-stuttgart.de/remex)).

## Funding Acknowledgement

The research leading to these results has received funding from the [European Union's Seventh Framework Programme](https://ec.europa.eu/research/fp7/index_en.cfm) (FP7) under grant agreement No.610510 ([Prosperity4All](http://www.prosperity4all.eu/)).
