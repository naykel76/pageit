<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

<a href="https://packagist.org/packages/naykel/pageit"><img src="https://img.shields.io/packagist/dt/naykel/pageit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/naykel/pageit"><img src="https://img.shields.io/packagist/v/naykel/pageit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/naykel/pageit"><img src="https://img.shields.io/packagist/l/naykel/pageit" alt="License"></a>

# Naykel Pageit

Uses `spatie` package with `spatie/permissions`


    <x-gotime-actions-toolbar formName="page-form" routeName="pages" :preview=true />


## Installation and Configuration

add route to `web.php` **MUST COME LAST**
 
    Route::get('/{page}', [PageController::class, 'show'])->name('pages.show')

## Change log

See the [changelog](changelog.md) for more information on what has changed recently.

[link-author]: https://github.com/naykel76
[link-email]: nathan@naykel.com.au
