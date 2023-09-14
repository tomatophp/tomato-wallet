<?php

namespace TomatoPHP\TomatoWallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class TransactionController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = Transaction::class;
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
            view: 'tomato-wallet::transactions.index',
            table: \TomatoPHP\TomatoWallet\Tables\TransactionTable::class
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
            model: Transaction::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-wallet::transactions.create',
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
            model: Transaction::class,
            validation: [
                            'wallet_id' => 'required|exists:wallets,id',
            'payable_type' => 'required|max:255|string',
            'payable_id' => 'required',
            'type' => 'required|string',
            'amount' => 'required',
            'confirmed' => 'required',
            'meta' => 'nullable',
            'uuid' => 'required|max:36|string'
            ],
            message: __('Transaction updated successfully'),
            redirect: 'admin.transactions.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\Transaction $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoWallet\Models\Transaction $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::transactions.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\Transaction $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoWallet\Models\Transaction $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-wallet::transactions.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoWallet\Models\Transaction $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoWallet\Models\Transaction $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'wallet_id' => 'sometimes|exists:wallets,id',
            'payable_type' => 'sometimes|max:255|string',
            'payable_id' => 'sometimes',
            'type' => 'sometimes|string',
            'amount' => 'sometimes',
            'confirmed' => 'sometimes',
            'meta' => 'nullable',
            'uuid' => 'sometimes|max:36|string'
            ],
            message: __('Transaction updated successfully'),
            redirect: 'admin.transactions.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoWallet\Models\Transaction $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoWallet\Models\Transaction $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Transaction deleted successfully'),
            redirect: 'admin.transactions.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
