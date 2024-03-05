# AdminLTE

## Includes

- Added the Light/Dark mode in profile section at top nav.

- Added the Role Module.

- Added the Permission Module.

## Toast

- Added the toastr which has 4 classes success, info, warning & error. you can use it own it.

```php
<x-admin>
    {{ 'Put your blade code here' }}
</x-admin>
```

- For the page title use a section method Like this.

```php
    @section('title', __('language_file.page_title'))
```

## Alerts

- I added alerts. You just have to call like this.

```php
->with('success', 'Success message');
->with('danger', 'danger message');
->with('info', 'info message');
->with('dark', 'dark message');
->with('warning', 'warning message');
->with('light', 'light message');
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
