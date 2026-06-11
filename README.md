![alt text](https://marshmallow.dev/cdn/media/logo-red-237x46.png "marshmallow.")

# Connect your Laravel application with Linear

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marshmallow/laravel-linear.svg?style=flat-square)](https://packagist.org/packages/marshmallow/laravel-linear)
[![Tests](https://img.shields.io/github/actions/workflow/status/marshmallow-packages/laravel-linear/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/marshmallow-packages/laravel-linear/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/marshmallow/laravel-linear.svg?style=flat-square)](https://packagist.org/packages/marshmallow/laravel-linear)

This package will allow you to connect your Laravel application with Linear via a Linear OAuth App.

<img src="/resources/images/linear-preview.png">

## Installation

You can install the package via composer:

```bash
composer require marshmallow/laravel-linear
```

After you've installed the package you can run the installation command. This command will publish the mandatory migrations and publish components and assets that are needed to show the beautiful Linear pages.

```bash
php artisan linear:install
```

Optionally, you can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-linear-config"
```

### Create your Linear OAuth App

Go to settings in your Linear account. In the `account menu`, you will find the API button. Once you click on `API` you will be able to create an `OAuth application`. Click on `Create New`.

Fill in all the fields. The most important part is the Callback URLs. You need to add your callback URL like `your-domain.test/linear/oauth2/callback`. Add the callback url for all your domains. Local, Beta and Production so it will work on all your sites.

When you've created your app, you will get a `Client id` and a `Client secret`. Copy these, we need them later!

<img src="/resources/images/linear-oauth-app.png">

## Configuration

The config file (`config/linear.php`) exposes the credentials for your Linear OAuth application. All values are read from your `.env` file:

| Key | Default | Description |
| --- | --- | --- |
| `service.client_id` | `env('LINEAR_CLIENT_ID')` | The Client id of your Linear OAuth application. |
| `service.client_secret` | `env('LINEAR_CLIENT_SECRET')` | The Client secret of your Linear OAuth application. |
| `service.redirect` | `env('LINEAR_REDIRECT_URI', '/linear/oauth2/callback')` | The OAuth callback path that handles the Linear redirect. |

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

Go to `your-domain.test/linear/auth` and follow the steps to connect your Laravel application to Linear. After you've done this you will be able to connect a company, team and project.

### Submit your first issue

Build a `LinearIssue` message and send it to a notifiable via the `NewLinearIssue` notification:

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

The `LinearIssue` message supports the following fluent methods:

```php
(new LinearIssue)
  ->title('Issue title')        // required, the issue title
  ->message('Issue message')    // the issue description
  ->projectId('project-uuid')   // assign the issue to a Linear project
  ->label('Bug')                // attach a label to the issue
  ->submitter('Jane Doe')       // who submitted the issue (defaults to "Anonymous")
  ->attachment('/path/to/file') // add an attachment (call multiple times for more)
  ->issueModel($model);         // relate the issue to an Eloquent model
```

### Using the notification channel

The `NewLinearIssue` notification routes through the package's `LinearChannel` and returns the `LinearIssue` message from its `toLinear()` method. Any notifiable that uses Laravel's `Notifiable` trait can send a Linear issue by calling `$notifiable->notify(new NewLinearIssue($issue))` as shown above — no extra channel registration is required.

### Change the settings

When you go to `your-domain.test/linear/auth` after you've connected to Linear you will be able to change the config.

## Updating

When you install a new version of this package via Composer it might be helpful to run the update command so all the views and assets are up to date. This command will publish the latest assets for this package and publish new components if they are available.

```bash
php artisan linear:update
```

## Linear

Here are some documentation pages from Linear that might be helpful.

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

Please report security vulnerabilities by email rather than via the public issue tracker.

## Credits

-   [Stef van Esch](https://github.com/stefvanesch)
-   [Lars Kort](https://github.com/LTKort)
-   [All Contributors](https://github.com/marshmallow-packages/laravel-linear/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
</content>
</invoke>
