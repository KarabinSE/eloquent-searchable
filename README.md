# Easily search eloquent models and their relations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/karabinse/eloquent-searchable.svg)](https://packagist.org/packages/karabinse/eloquent-searchable)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/karabinse/eloquent-searchable/run-tests.yml?branch=main&label=tests)](https://github.com/karabinse/eloquent-searchable/actions?query=workflow%3Arun-tests+branch%3Amain)

## Installation

You can install the package via composer:

```bash
composer require karabinse/eloquent-searchable
```


## Usage

Add the trait and add columns that are searchable.

```php
use Karabin\Searchable\Concerns\IsSearchable;

class User extends Authenticatable
{
    use HasFactory, HasRoles, IsSearchable, Notifiable;

    protected $searchable = [
        'name',
        'email',
    ];

```

The package also includes a custom TermSearchFitler to be used with [Laravel Query Builder](https://github.com/spatie/laravel-query-builder).
```php
use Karabin\Searchable\Filters\TermSearchFilter;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::custom('search', new TermSearchFilter),
            ])
            ->paginate($request->query('limit', 10));

        return Inertia::render('User/Index', [
            'users' => UserData::collect($users),
        ]);
    }
```

## Testing

```bash
composer test
```

## Credits

- [Albin N](https://github.com/KarabinSE)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
