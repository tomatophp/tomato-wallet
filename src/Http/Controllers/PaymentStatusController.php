<?php

namespace TomatoPHP\TomatoWallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class PaymentStatusController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoWallet\Models\PaymentStatus::class;
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
            view: 'tomato-wallet::payment-status.index',
            table: \TomatoPHP\TomatoWallet\Tables\PaymentStatusTable::class
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
            model: \TomatoPHP\TomatoWallet\Models\PaymentStatus::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::payment-status.create',
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
            model: \TomatoPHP\TomatoWallet\Models\PaymentStatus::class,
            validation: [
                            'name' => 'required',
            'description' => 'nullable',
            'color' => 'nullable|max:255',
            'icon' => 'nullable|max:255'
            ],
            message: __('PaymentStatus updated successfully'),
            redirect: 'admin.payment-status.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\PaymentStatus $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoWallet\Models\PaymentStatus $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-status.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\PaymentStatus $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoWallet\Models\PaymentStatus $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::payment-status.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoWallet\Models\PaymentStatus $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoWallet\Models\PaymentStatus $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'name' => 'sometimes',
            'description' => 'nullable',
            'color' => 'nullable|max:255',
            'icon' => 'nullable|max:255'
            ],
            message: __('PaymentStatus updated successfully'),
            redirect: 'admin.payment-status.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\PaymentStatus $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoWallet\Models\PaymentStatus $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('PaymentStatus deleted successfully'),
            redirect: 'admin.payment-status.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
