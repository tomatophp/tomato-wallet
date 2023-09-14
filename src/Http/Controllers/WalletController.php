<?php

namespace TomatoPHP\TomatoWallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class WalletController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = Wallet::class;
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
            view: 'tomato-wallet::wallets.index',
            table: \TomatoPHP\TomatoWallet\Tables\WalletTable::class
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
            model: Wallet::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::wallets.create',
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
            model: Wallet::class,
            validation: [
                            'holder_type' => 'required|max:255|string',
            'holder_id' => 'required',
            'name' => 'required|max:255|string',
            'slug' => 'required|max:255|string',
            'uuid' => 'required|max:36|string',
            'description' => 'nullable|max:255|string',
            'meta' => 'nullable',
            'balance' => 'required',
            'decimal_places' => 'required'
            ],
            message: __('Wallet updated successfully'),
            redirect: 'admin.wallets.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param Wallet $model
     * @return View|JsonResponse
     */
    public function show(Wallet $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::wallets.show',
        );
    }

    /**
     * @param Wallet $model
     * @return View
     */
    public function edit(Wallet $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::wallets.edit',
        );
    }

    /**
     * @param Request $request
     * @param Wallet $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, Wallet $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'holder_type' => 'sometimes|max:255|string',
            'holder_id' => 'sometimes',
            'name' => 'sometimes|max:255|string',
            'slug' => 'sometimes|max:255|string',
            'uuid' => 'sometimes|max:36|string',
            'description' => 'nullable|max:255|string',
            'meta' => 'nullable',
            'balance' => 'sometimes',
            'decimal_places' => 'sometimes'
            ],
            message: __('Wallet updated successfully'),
            redirect: 'admin.wallets.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param Wallet $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Wallet $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Wallet deleted successfully'),
            redirect: 'admin.wallets.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
