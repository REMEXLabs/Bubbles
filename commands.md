## Requirements

Installation of:

- [Composer](https://getcomposer.org/) ([https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md))
- [Laravel](https://laravel.com/) (`composer global require "laravel/installer"`)

## Permissions

```
$ chmod -R 777 storage
$ chmod -R 777 bootstrap/cache
```

## Optional Aliases

```
alias art='php artisan'
```

## Development Commands

### Backend

- `php artisan migrate:refresh`
- `php artisan migrate:refresh --seed`
- `php artisan db:seed`

And if you want to use the extended commands: https://github.com/laracasts/Laravel-5-Generators-Extended

- `php artisan make:migration:schema <[create|add|remove]_[...]_[from|to]_[...]_table> --schema="<values>"`
- `php artisan make:migration:schema <[create|add|remove]_[...]_[from|to]_[...]_table> -s="<values>"`
- `php artisan make:migration:pivot <name> <name>` (e.g. `tags` and `posts`)

### Frontend

- -
