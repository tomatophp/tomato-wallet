<?php



Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->name('admin.')->group(function () {
    Route::get('admin/wallets', [\TomatoPHP\TomatoWallet\Http\Controllers\WalletController::class, 'index'])->name('wallets.index');
    Route::get('admin/wallets/api', [\TomatoPHP\TomatoWallet\Http\Controllers\WalletController::class, 'api'])->name('wallets.api');
    Route::get('admin/wallets/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\WalletController::class, 'show'])->name('wallets.show');
    Route::get('admin/wallets/{model}/balance', [\TomatoPHP\TomatoWallet\Http\Controllers\WalletController::class, 'balanceView'])->name('wallets.balance');
    Route::post('admin/wallets/{model}/balance', [\TomatoPHP\TomatoWallet\Http\Controllers\WalletController::class, 'balance'])->name('wallets.balance.update');
});

Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->name('admin.')->group(function () {
    Route::get('admin/transactions', [\TomatoPHP\TomatoWallet\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('admin/transactions/api', [\TomatoPHP\TomatoWallet\Http\Controllers\TransactionController::class, 'api'])->name('transactions.api');
    Route::get('admin/transactions/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
});

//Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->name('admin.')->group(function () {
//    Route::get('admin/transfers', [\TomatoPHP\TomatoWallet\Http\Controllers\TransferController::class, 'index'])->name('transfers.index');
//    Route::get('admin/transfers/api', [\TomatoPHP\TomatoWallet\Http\Controllers\TransferController::class, 'api'])->name('transfers.api');
//    Route::get('admin/transfers/create', [\TomatoPHP\TomatoWallet\Http\Controllers\TransferController::class, 'create'])->name('transfers.create');
//    Route::post('admin/transfers', [\TomatoPHP\TomatoWallet\Http\Controllers\TransferController::class, 'store'])->name('transfers.store');
//    Route::get('admin/transfers/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\TransferController::class, 'show'])->name('transfers.show');
//});

//Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->name('admin.')->group(function () {
//    Route::get('admin/payments', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
//    Route::get('admin/payments/api', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentController::class, 'api'])->name('payments.api');
//    Route::get('admin/payments/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');
//});
//
//Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->name('admin.')->group(function () {
//    Route::get('admin/payment-status', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'index'])->name('payment-status.index');
//    Route::get('admin/payment-status/api', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'api'])->name('payment-status.api');
//    Route::get('admin/payment-status/create', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'create'])->name('payment-status.create');
//    Route::post('admin/payment-status', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'store'])->name('payment-status.store');
//    Route::get('admin/payment-status/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'show'])->name('payment-status.show');
//    Route::get('admin/payment-status/{model}/edit', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'edit'])->name('payment-status.edit');
//    Route::post('admin/payment-status/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'update'])->name('payment-status.update');
//    Route::delete('admin/payment-status/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentStatusController::class, 'destroy'])->name('payment-status.destroy');
//});
//
//Route::middleware(array_merge(['splade', 'auth'], config('tomato-admin.route_middlewares')))->name('admin.')->group(function () {
//    Route::get('admin/payment-logs', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentLogController::class, 'index'])->name('payment-logs.index');
//    Route::get('admin/payment-logs/api', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentLogController::class, 'api'])->name('payment-logs.api');
//    Route::get('admin/payment-logs/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentLogController::class, 'show'])->name('payment-logs.show');
//    Route::delete('admin/payment-logs/{model}', [\TomatoPHP\TomatoWallet\Http\Controllers\PaymentLogController::class, 'destroy'])->name('payment-logs.destroy');
//});
