<div wire:key="{!! now() !!}">

        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
        @include('forms.input',[
                   'parentDiv' => 'intro-y col-span-12 sm:col-span-12',
                   'label'     => __('lang.name') ,
                   'type'  => 'text',
                   'name'  => 'name',
                   'value' => null ,
                   'options'   =>[
                       'wire:model.defer'  => "name",
                       'class'=>"form-control",
                       'placeholder'   => __('lang.employee_role')
                   ]
               ])
        </div>
</div>

