<div wire:key="{!! now() !!}">
    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
        @include('forms.input',[
                                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                                'label'     => __('lang.group_name') ,
                                'type'  => 'text',
                                'name'  => 'group_name',
                                'value' => null ,
                                'options'   =>[
                                    'wire:model.defer'  => "group_name",
                                    'class'=>"form-control",
                                    'placeholder'   => __('lang.group_name')
                                ]
                            ])

        @include('forms.select',[
            'parentDiv' => "intro-y col-span-12 sm:col-span-6",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.required_roles'),
            'name' => 'roles',
            'ignore' => false,
            'values' =>   $employeeRoles,
            'options' => [
            'label' =>  __('lang.required_roles'),
                'class'=>"form-control select2",
                'multiple'  => 'multiple',
                'wire:model'    => 'roles',
                'functionToEmit'    => 'assocSelect2'
            ],
            'selected' => $roles,
        ])
    </div>
</div>








