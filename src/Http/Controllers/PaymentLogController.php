<?php

namespace TomatoPHP\TomatoWallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class PaymentLogController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoWallet\Models\PaymentLog::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-wallet::payment-logs.index',
            table: \TomatoPHP\TomatoWallet\Tables\PaymentLogTable::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \TomatoPHP\TomatoWallet\Models\PaymentLog::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::payment-logs.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoWallet\Models\PaymentLog::class,
            validation: [
                            'status' => 'required',
            'payload' => 'required',
            'response' => 'required'
            ],
            message: __('PaymentLog updated successfully'),
            redirect: 'admin.payment-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\PaymentLog $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoWallet\Models\PaymentLog $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-logs.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\PaymentLog $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoWallet\Models\PaymentLog $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-logs.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoWallet\Models\PaymentLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoWallet\Models\PaymentLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'status' => 'sometimes',
            'payload' => 'sometimes',
            'response' => 'sometimes'
            ],
            message: __('PaymentLog updated successfully'),
            redirect: 'admin.payment-logs.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\PaymentLog $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoWallet\Models\PaymentLog $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('PaymentLog deleted successfully'),
            redirect: 'admin.payment-logs.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
