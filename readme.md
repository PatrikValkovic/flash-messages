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

This package provides `Flash` model, `Flash` facade and also `flash` helper function.
You are free yo choose, which approach more suits for you. If you want to use `Flash` facade, you will first need to register alias for it, as is noted in Install section.

These commands will have same results.
```php

flash('Message','success');
Flash()->success('Message');
flash()->success('Message'); //Note that flash() without parameters return Flash Model

// OR INSIDE CLASS
private $flash;
public function __construct(\Valkovic\Flash\Flash $flash) {
    $this->flash = $flash;
}
public function send(User $user) {
    //store User
    $this->flash->success('Message');
}
```

If you don't want to use Bootstrap specific classes, you are free to use array of properties as second parameter to `message` method or `flash` helper.

```php
flash('Message',['class'=>'myClass','id'=>'flashMessage']);
Flash()->message('Message',['class'=>'myClass','id'=>'flashMessage']);

//with template before will produce
<div class="notifications">
        <div class="myClass" id="flashMessage">
            Some message
        </div>
</div>
```


## Hiding Flash Messages

A common desire is to display a flash message for a few seconds, and then hide it. To handle this, write a simple bit of JavaScript. For example, using jQuery, you might add the following snippet just before the closing `</body>` tag.
Because you can attach id property to tag, you can refer to `id` property directly. 

```
flash('Message',['id'=>'toHide']);

<script>
$('#toHide').delay(3000).fadeOut(350);
</script>
```

## Custom views

This package in current version don't provide views, to show flash messages.
