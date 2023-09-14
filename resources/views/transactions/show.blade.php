<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('transactions')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Wallet')" :value="$model->Wallet->name" type="text" />

          <x-tomato-admin-row :label="__('Payable type')" :value="$model->payable_type" type="string" />

          
          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />

          
          <x-tomato-admin-row :label="__('Confirmed')" :value="$model->confirmed" type="bool" />

          
          <x-tomato-admin-row :label="__('Uuid')" :value="$model->uuid" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.transactions.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.transactions.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.transactions.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
