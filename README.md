
# Laravel Domain Oriented Design

Laravel Domain Oriented Design is simple to make:

- Action
- Repository
- View Model
- Data Transfer Object
- Service

## Installing

The recommended way to install Laravel DOD is through
[Composer](https://getcomposer.org/).

```bash
composer require sontx/laravel-dod
```


## Docs

Make Action.

```bash
php artisan make:action myAction
```

Make Repositoty.

```bash
php artisan make:repositoty myRepositoty
```

Make Repositoty without extend model

```bash
php artisan make:repositoty myRepositoty --no-model
```

Make DataTransferObject.

```bash
php artisan make:dto myDataTransferObject
```

Make Service.

```bash
php artisan make:service myService
```

Make ViewModel.

```bash
php artisan make:view-model myViewModel
```

Publish config.

```bash
php artisan vendor:publish --tag=laravel-dod-config
```
