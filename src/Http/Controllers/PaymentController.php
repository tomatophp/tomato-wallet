<?php

namespace TomatoPHP\TomatoWallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class PaymentController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoWallet\Models\Payment::class;
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
            view: 'tomato-wallet::payments.index',
            table: \TomatoPHP\TomatoWallet\Tables\PaymentTable::class
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
            model: \TomatoPHP\TomatoWallet\Models\Payment::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::payments.create',
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
            model: \TomatoPHP\TomatoWallet\Models\Payment::class,
            validation: [
                            'payment_status_id' => 'required|exists:payment_status,id',
            'uuid' => 'required|max:255|string',
            'model_id' => 'required',
            'model_table' => 'required|max:255|string',
            'order_id' => 'required',
            'order_table' => 'required|max:255|string',
            'type' => 'nullable|max:255|string',
            'payment_method' => 'nullable|max:255|string',
            'transaction_vendor' => 'nullable|max:255|string',
            'transaction_code' => 'nullable|max:255|string',
            'amount' => 'required',
            'notes' => 'nullable|max:255|string',
            'currency' => 'nullable|max:255|string'
            ],
            message: __('Payment updated successfully'),
            redirect: 'admin.payments.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\Payment $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoWallet\Models\Payment $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payments.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\Payment $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoWallet\Models\Payment $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payments.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoWallet\Models\Payment $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoWallet\Models\Payment $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'payment_status_id' => 'sometimes|exists:payment_status,id',
            'uuid' => 'sometimes|max:255|string',
            'model_id' => 'sometimes',
            'model_table' => 'sometimes|max:255|string',
            'order_id' => 'sometimes',
            'order_table' => 'sometimes|max:255|string',
            'type' => 'nullable|max:255|string',
            'payment_method' => 'nullable|max:255|string',
            'transaction_vendor' => 'nullable|max:255|string',
            'transaction_code' => 'nullable|max:255|string',
            'amount' => 'sometimes',
            'notes' => 'nullable|max:255|string',
            'currency' => 'nullable|max:255|string'
            ],
            message: __('Payment updated successfully'),
            redirect: 'admin.payments.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\Payment $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoWallet\Models\Payment $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Payment deleted successfully'),
            redirect: 'admin.payments.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
