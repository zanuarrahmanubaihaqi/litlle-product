# litlle-product

CRUD (Product & Category) with laravel 7 and mysql

# Installation

-   after clone this repository
-   run `composer install`
-   rename or copy `.env.example` file to `.env`
-   run `php artisan key:generate`
-   set database connection in `.env`
-   run `php artisan migrate`
-   run `php artisan db:seed`
-   run `composer require yajra/laravel-datatables:^1.5`
-   open the file config/app.php and then add following service provider with `Yajra\DataTables\DataTablesServiceProvider::class,` and aliases with `'DataTables' => Yajra\DataTables\Facades\DataTables::class,`
-   run `php artisan vendor:publish --tag=datatables`

# Note

-   before login edit methode `username()` di file `AuthenticatesUsers.php` vendor/laravel/ui/auth-backend/AuthenticatesUsers.php return 'email' to return 'username'
-   admin : username -> admin & password -> passw0rd
-   bootstrap 4 and JQuery inside
