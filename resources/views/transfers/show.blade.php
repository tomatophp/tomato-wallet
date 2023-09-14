<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('transfers')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Deposit')" :value="$model->Deposit->id" type="text" />

          <x-tomato-admin-row :label="__('Withdraw')" :value="$model->Withdraw->id" type="text" />

          <x-tomato-admin-row :label="__('From type')" :value="$model->from_type" type="string" />

          
          <x-tomato-admin-row :label="__('To type')" :value="$model->to_type" type="string" />

          
          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Status last')" :value="$model->status_last" type="string" />

          
          
          <x-tomato-admin-row :label="__('Uuid')" :value="$model->uuid" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.transfers.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.transfers.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.transfers.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
