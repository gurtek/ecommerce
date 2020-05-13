<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Implementations\BrandRepository;
use App\Repositories\Implementations\ProductRepository;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Implementations\CategoryRepository;
use App\Repositories\Implementations\AttributeRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\AttributeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class,
                        CategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class,
                        BrandRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class,
                        AttributeRepository::class); 
        $this->app->bind(ProductRepositoryInterface::class,
                        ProductRepository::class);                           
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
