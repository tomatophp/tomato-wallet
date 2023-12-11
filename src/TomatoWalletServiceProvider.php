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


        Request::overwrite('input', function ($key) {
            return \request($key);
        });

        /**
         * Bind to service container.
         */
        $this->app->bind('shetabit-payment', function () {
            $config = config('payment') ?? [];

            return new Payment($config);
        });

        $this->registerEvents();

        // use blade to render redirection form
        Payment::setRedirectionFormViewRenderer(function ($view, $action, $inputs, $method) {
            if ($this->existCustomRedirectFormView()) {
                return $this->loadNormalRedirectForm($action, $inputs, $method);
            }
            return Blade::render(
                str_replace('</form>', '@csrf</form>', file_get_contents($view)),
                [
                    'action' => $action,
                    'inputs' => $inputs,
                    'method' => $method,
                ]
            );
        });

        $this->app->bind('tomato-wallet', function () {
            return new Payment();
        });
    }

    public function boot(): void
    {
        TomatoMenu::register([
           Menu::make()
                ->group(__('Wallets'))
                ->label(__('Wallets'))
                ->icon('bx bxs-wallet')
                ->route('admin.wallets.index'),
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Transactions'))
                ->icon('bx bx-money')
                ->route('admin.transactions.index'),
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Transfers'))
                ->icon('bx bx-transfer')
                ->route('admin.transfers.index'),
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Payments'))
                ->icon('bx bxs-credit-card')
                ->route('admin.payments.index')
        ]);
    }


    /**
     * Register Laravel events.
     *
     * @return void
     */
    public function registerEvents()
    {
        Payment::addPurchaseListener(function ($driver, $invoice) {
            event(new InvoicePurchasedEvent($driver, $invoice));
        });

        Payment::addVerifyListener(function ($reciept, $driver, $invoice) {
            event(new InvoiceVerifiedEvent($reciept, $driver, $invoice));
        });
    }

    /**
     * Checks whether the user has customized the view file called `redirectForm.blade.php` or not
     *
     * @return bool
     */
    private function existCustomRedirectFormView()
    {
        return file_exists(resource_path('views/vendor/tomato-wallet') . '/redirectForm.blade.php');
    }

    /**
     * @param $action
     * @param $inputs
     * @param $method
     * @return Application|Factory|View
     */
    private function loadNormalRedirectForm($action, $inputs, $method)
    {
        return view('tomato-wallet::redirectForm')->with(
            [
                'action' => $action,
                'inputs' => $inputs,
                'method' => $method,
            ]
        );
    }
}
