### Requirements

Installation of:

- [Composer](https://getcomposer.org/) ([https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md))
- [Laravel](https://laravel.com/) (`composer global require "laravel/installer"`)

### Permissions

```
$ chmod -R 777 storage
$ chmod -R 777 bootstrap/cache
```

### Optional Aliases

```
alias art='php artisan'
```

### Development Commands

- `php artisan migrate:refresh`
- `php artisan migrate:refresh --seed`
- `php artisan db:seed`

Or with the defined alias:

- `art migrate:refresh`
- `art migrate:refresh --seed`
- `art db:seed`
