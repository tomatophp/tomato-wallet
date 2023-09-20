<?php

Route::middleware(['auth:sanctum'])->prefix('api/wallet')->name('api.wallet.')->group(function () {
    Route::post('/deposit', [\TomatoPHP\TomatoWallet\Http\Controllers\API\WalletController::class, 'deposit'])->name('deposit');
    Route::get('/transactions', [\TomatoPHP\TomatoWallet\Http\Controllers\API\WalletController::class, 'transactions'])->name('transactions');
});
