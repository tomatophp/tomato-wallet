<?php

namespace TomatoPHP\TomatoWallet\Tables;

use Bavix\Wallet\Models\Transfer;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class TransferTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query=null)
    {
        if(!$query){
            $this->query = Transfer::query();
        }
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return $this->query;
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(
                label: trans('tomato-admin::global.search'),
                columns: ['id','uuid',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (Transfer $model) => $model->delete(),
                after: fn () => Toast::danger(__('Transfer Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'deposit_id',
                label: __('Deposit id'),
                sortable: true
            )
            ->column(
                key: 'withdraw_id',
                label: __('Withdraw id'),
                sortable: true
            )
            ->column(
                key: 'from_type',
                label: __('From type'),
                sortable: true
            )
            ->column(
                key: 'from_id',
                label: __('From id'),
                sortable: true
            )
            ->column(
                key: 'to_type',
                label: __('To type'),
                sortable: true
            )
            ->column(
                key: 'to_id',
                label: __('To id'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'status_last',
                label: __('Status last'),
                sortable: true
            )
            ->column(
                key: 'discount',
                label: __('Discount'),
                sortable: true
            )
            ->column(
                key: 'fee',
                label: __('Fee'),
                sortable: true
            )
            ->column(
                key: 'uuid',
                label: __('Uuid'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
