<?php

namespace TomatoPHP\TomatoWallet\Facade;

use Illuminate\Support\Facades\Facade;
use TomatoPHP\TomatoWallet\Invoice;
use TomatoPHP\TomatoWallet\Contracts\ReceiptInterface;
use TomatoPHP\TomatoWallet\Payment as MultipayPayment;

/**
 * Class Payment
 *
 * @method static MultipayPayment config($key, $value = null)
 * @method static MultipayPayment callbackUrl($url = null)
 * @method static MultipayPayment resetCallbackUrl()
 * @method static MultipayPayment amount($amount)
 * @method static MultipayPayment detail($key, $value = null)
 * @method static MultipayPayment transactionId($id)
 * @method static MultipayPayment via($driver)
 * @method static MultipayPayment purchase(Invoice $invoice = null, $finalizeCallback = null)
 * @method static mixed pay($initializeCallback = null)
 * @method static ReceiptInterface verify($finalizeCallback = null)
 *
 * @package Shetabit\Payment\Facade
 * @see \TomatoPHP\TomatoWallet\Payment
 */
class Payment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'tomato-payment';
    }
}
