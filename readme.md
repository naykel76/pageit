<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

<a href="https://packagist.org/packages/naykel/pageit"><img src="https://img.shields.io/packagist/dt/naykel/pageit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/naykel/pageit"><img src="https://img.shields.io/packagist/v/naykel/pageit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/naykel/pageit"><img src="https://img.shields.io/packagist/l/naykel/pageit" alt="License"></a>

# Naykel Pageit



The `$url` is the `route_prefix` and `slug` from the database combined with the segments separated with a `/`. Why is this important? I think this only matters when using json nav with defined url.

Each route prefix needs a custom route

```php
Route::get('/about/{page:slug}', [PageController::class, 'show'])
    ->name('pages.about.show')->where('route_prefix', 'about');

Route::get('/categories/books/{page:slug}', [PageController::class, 'show'])
    ->name('pages.categories.books.show')->where('route_prefix', 'categories.books');
```

#### Fallback Wildcard Route

The fallback route should appear at the end of your `web.php` file.

```php
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
```


## Database Schema

| Field        | Description                                                                              |
| ------------ | ---------------------------------------------------------------------------------------- |
| route_prefix |                                                                                          |
| is_category  |                                                                                          |
| title        | Page title                                                                               |
| hide_title   |                                                                                          |
| intro        |                                                                                          |
| headline     | Can be used to create some lead text, lists or special content generally used the banner |
| slug         |                                                                                          |
| body         |                                                                                          |
| image        |                                                                                          |
| type         |                                                                                          |
| layout       |                                                                                          |
| sort_order   |                                                                                          |
| published_at |                                                                                          |
