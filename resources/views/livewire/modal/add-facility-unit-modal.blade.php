<div wire:key="{!! now() !!}">
    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
        @include('forms.input',[
                                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                                'label'     => __('lang.unit_name') ,
                                'type'  => 'text',
                                'name'  => 'name',
                                'value' => null ,
                                'options'   =>[
                                    'wire:model.defer'  => "name",
                                    'class'=>"form-control",
                                    'placeholder'   => __('lang.unit_name')
                                ]
                            ])
        @include('forms.input',[
                                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                                'label'     => __('lang.type') ,
                                'type'  => 'text',
                                'name'  => 'type',
                                'value' => null ,
                                'options'   =>[
                                    'wire:model.defer'  => "type",
                                    'class'=>"form-control",
                                    'placeholder'   => __('lang.type')
                                ]
                            ])
        @include('forms.select',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.group') ,
                'type'  => 'text',
                'name'  => 'group',
                'values' => $groups,
                'options'   =>[
                    'wire:model.defer'  => "group",
                    'class'=>"form-control",

                ]
            ])
        @include('forms.input',[
                               'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                               'label'     => __('lang.budget') ,
                               'type'  => 'text',
                               'name'  => 'budget',
                               'value' => null ,
                               'options'   =>[
                                   'wire:model.defer'  => "budget",
                                   'class'=>"form-control",
                                   'placeholder'   => __('lang.budget')
                               ]
                           ])


    </div>
</div>








