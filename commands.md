## Requirements

You have to install [Composer](https://getcomposer.org/) and [Laravel](https://laravel.com/) globally:

1. Composer: [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)

2. Laravel:

```
composer global require "laravel/installer"
```

## Permissions

Using the Laravel framework requires specific permissions:

```
$ chmod -R 777 storage
$ chmod -R 777 bootstrap/cache
```

## Optional Aliases

We recommend creating and using short aliases:

```
alias art='php artisan'
```

## Development Commands


### Backend

```
php artisan migrate:refresh
php artisan migrate:refresh --seed
php artisan db:seed
```

You can use extended generetors provided by [Laravel-5-Generators-Extended](https://github.com/laracasts/Laravel-5-Generators-Extended):

```
php artisan make:migration:schema <[create|add|remove]_[...]_[from|to]_[...]_table> --schema="<values>"
php artisan make:migration:schema <[create|add|remove]_[...]_[from|to]_[...]_table> -s="<values>"
php artisan make:migration:pivot <name> <name>` (e.g. `tags` and `posts`)
```

You can use specific methods for debugging:

[https://github.com/barryvdh/laravel-debugbar#usage](https://github.com/barryvdh/laravel-debugbar#usage)


### Frontend

You have to install [Gulp.js](http://gulpjs.com/) globally:

```
npm install --global gulp-cli
```
