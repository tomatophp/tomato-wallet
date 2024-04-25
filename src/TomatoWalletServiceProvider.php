<?php

namespace TomatoPHP\TomatoWallet;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;


class TomatoWalletServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoWallet\Console\TomatoWalletInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-wallet.php', 'tomato-wallet');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-wallet.php' => config_path('tomato-wallet.php'),
        ], 'tomato-wallet-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-wallet-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-wallet');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-wallet'),
        ], 'tomato-wallet-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-wallet');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-wallet'),
        ], 'tomato-wallet-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

    }

    public function boot(): void
    {

        $menu = [];

        if(config('tomato-wallet.menu.wallets')) {
            $menu[] = Menu::make()
                ->group(__('Wallets'))
                ->label(__('Wallets'))
                ->icon('bx bxs-wallet')
                ->route('admin.wallets.index');
        }

        if(config('tomato-wallet.menu.transactions')) {
            $menu[] = Menu::make()
                ->group(__('Wallets'))
                ->label(__('Transactions'))
                ->icon('bx bx-money')
                ->route('admin.transactions.index');
        }

        TomatoMenu::register($menu);
    }
}
