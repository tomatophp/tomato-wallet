<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('PaymentStatus')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.payment-status.store')}}" method="post">
        
          <x-splade-input :label="__('Name-EN')" :placeholder="__('Name-en')" name="name.en" type='text' />
<x-splade-input :label="__('Name-AR')" :placeholder="__('Name-ar')" name="name.ar" type='text' />
          <x-splade-input :label="__('Description-EN')" :placeholder="__('Description-en')" name="description.en" type='text' />
<x-splade-input :label="__('Description-AR')" :placeholder="__('Description-ar')" name="description.ar" type='text' />
          <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
          <x-splade-input :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.payment-status.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
