# Flash Messages for Your Laravel App

This package is inspired by [laracast/flash](https://packagist.org/packages/laracasts/flash) package.  
Unlike that package, this package allows to use multiple flash messages during one request and set additional properties to HTML tag.

## Installation

First, pull in the package through Composer.

Run `composer require valkovic/flash`

And then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'web' => [
    \Valkovic\Flash\FlashMiddleware::class,
],
```

For correct use, you must also register middleware, that cares about loading and saving flash messages during requests.
Attach middleware to any group you want, for example I will attach it to `web` group. Settings are at file `app/Http/Kernel.php`.





You can also register Facade for Flash package. Just set alias in `config/app.php`

```php
'aliases' => [
    'Flash' => Valkovic\Flash\FlashFacade::class,
];
```

## Usage

Within your controllers, before you perform a redirect...

```php
public function store()
{
    flash('Welcome Aboard!');

    return home();
}
```

You may also do:

- `flash('Message', 'none')`
- `flash('Message', 'info')`
- `flash('Message', 'primary')`
- `flash('Message', 'success')`
- `flash('Message', 'warning')`
- `flash('Message', 'error')`
- `flash()->overlay('Modal Message', 'Modal Title')`
- `flash('Message')->important()`

Behind the scenes, this will set `valkovic.flash-messages` key in the session:

During next request, `Valkovic\Flash\FlashMiddleware` will load messages from session and share them to all views as `Flashes` variable.  
Then, in your view, you can iterate over them.

```html
<div class="notifications">
    @foreach($flashes as $flash)
        <div>
            {{$flash->message}}
        </div>
    @endforeach
</div>
```

If you set type of message, that type is attach to message as CSS class. If you want to render also that class, you must call `$flash->renderProperties()`.
Because this text contains HTML specific tag, you must not escape output from that method.

```
<div class="notifications">
    @foreach($flashes as $flash)
        <div {!! $flash->renderProperties() !!}>
            {{$flash->message}}
        </div>
    @endforeach
</div>
```

> Note that type of messages reflect classes in Twitter Bootstrap.

If you with, you can add more classes or even properties to tag. For example, this code

```php
flash('Some message','primary',['class'=>'myClass','id'=>'flashMessage']);
```

with previous blade example will produce following code.

```html
<div class="notifications">
        <div class="primary myClass" id="flashMessage">
            Some message
        </div>
</div>
```

## Another usage



## Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @include('flash::message')

    <p>Welcome to my website...</p>
</div>

<!-- This is only necessary if you do Flash::overlay('...') -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
    $('#flash-overlay-modal').modal();
</script>

</body>
</html>
```

If you need to modify the flash message partials, you can run:

```bash
php artisan vendor:publish
```

The two package views will now be located in the `app/views/packages/laracasts/flash/` directory.

```php
flash('Welcome Aboard!');

return home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/message.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/message.png)

```php
flash('Sorry! Please try again.', 'danger');

return home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/error.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/error.png)

```php
flash()->overlay('Notice', 'You are now a Laracasts member!');

return home();
```

![https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/overlay.png](https://dl.dropboxusercontent.com/u/774859/GitHub-Repos/flash/overlay.png)

> [Learn exactly how to build this very package on Laracasts!](https://laracasts.com/lessons/flexible-flash-messages)

## Hiding Flash Messages

A common desire is to display a flash message for a few seconds, and then hide it. To handle this, write a simple bit of JavaScript. For example, using jQuery, you might add the following snippet just before the closing `</body>` tag.

```
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
```

This will find any alerts - excluding the important ones, which should remain until manually closed by the user - wait three seconds, and then fade them out.
