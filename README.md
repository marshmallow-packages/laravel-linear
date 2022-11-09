# Connect your Laravel application with Linear

This package will allow you to connect your Laraval application with Linear via a Linear OAuth App.

<img src="/resources/images/linear-preview.png">

## Installation

You can install the package via composer:

```bash
composer require marshmallow/laravel-linear
```

After you've installed the package you can run the installation command. This command will publish the mandatory migrations and publish components and assets that are needed to show the beautifull Linear pages.

```bash
php artisan linear:install
```

### Create your Linear OAuth App

Go to settings in you Linear account. In the `account menu`, you will find the API button. Once you click on `API` you will be able to create an `OAuth application`. Click on `Create New`.

Fill in all the field. The most importent part is the Callback URLs. You need to add you callback URL like `your-domain.test/linear/oauth2/callback`. Add the callback url for all your domains. Local, Beta and Production so it will work on all your sites.

When you've create your app, you will get a `Client id` and a `Client secret`. Copy these, we need them later!

<img src="/resources/images/linear-oauth-app.png">

## Usage

Using this package is super easy. We just need to make two minor updates to your application.

### Update your .env file

When you created your Linear OAuth Application you got a `Client id` and a `Client secret`. You need to add them to your `.env` file.

```bash
LINEAR_CLIENT_ID="____YOUR_CLIENT_ID____"
LINEAR_CLIENT_SECRET="____YOUR_CLIENT_SECRET____"
```

### Update your Authenticatable model

First you need to be logged in to your application. This is so not everybody can change the connection to Linear.

On your Authenticatable model, usually the User model, you need to implement one new method to let the package know who can manage the Linear connection. Add the method below.

```php
class User extends Authenticatable
{
    // ...
    public function allowedToManagerLinearConnection(): bool
    {
        return in_array($this->email, [
            'stef@marshmallow.dev',
        ]);
    }
}
```

Go to `your-domain.test/linear/auth` and follow the steps to connect your Laraval application to Linear. After you've done this you will be able to connect a company, team and project.

### Submit your first issue

```php
use App\Models\User;
use LaravelLinear\Notifications\NewLinearIssue;
use LaravelLinear\Notifications\Messages\LinearIssue;

$issue = (new LinearIssue)
  ->title('Issue title')
  ->message('Issue message');

$user = User::first();
$user->notify(new NewLinearIssue($issue));
```

### Using the notification channel

### Change the settings.

When you go to `your-domain.test/linear/auth` after you've connected to linear you will be able to change the config.

## Updating

When you install a new version of this package via Composer it might be helpfull to run the update command so all the views and assets are up to date. This command will publish the latest assets for this package and publish new components if they are available.

```bash
php artisan linear:update
```

## Linear

Here are some documentation pages from Linear that might be helpfull.

[https://developers.linear.app/docs/oauth/authentication](https://developers.linear.app/docs/oauth/authentication)
[https://developers.linear.app/docs/oauth/oauth-actor-authorization](https://developers.linear.app/docs/oauth/oauth-actor-authorization)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Stef van Esch](https://github.com/stefvanesch)
-   [Lars Kort](https://github.com/LTKort)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
