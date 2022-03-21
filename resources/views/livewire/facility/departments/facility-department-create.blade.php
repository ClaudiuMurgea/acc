<div class="intro-y col-span-12 lg:col-span-6">
    <!-- BEGIN: Vertical Form -->
    <div class="intro-y box">
        <div id="vertical-form" class="p-5">
            <div>

                @include('forms.input',[
                   'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                   'label'     =>  __('lang.what_name',['what' => __('lang.department')]) ,
                   'type'  => 'text',
                   'name'  => 'name',
                   'value' => null ,
                   'options'   =>[
                               'wire:model.defer'  => "name",
                               'class'=>"form-control",
                               'placeholder'   => ''
                        ]
                    ])
            </div>
            <div class="mt-3">
                @include('forms.input',[
                   'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                   'label'     =>  __('lang.what_description',['what' => __('lang.department')]) ,
                   'type'  => 'text',
                   'name'  => 'description',
                   'value' => null ,
                   'options'   =>[
                               'wire:model.defer'  => "description",
                               'class'=>"form-control",
                               'placeholder'   => ''
                        ]
                    ])
            </div>

            @include('forms.buttons',[
                       'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-start mt-5',
                       'buttons'   =>[
                                [
                                     'label'      => __('lang.cancel'),
                                     'options'   =>[
                                     'wire:click'  => '$emitUp("show","showList")',
                                         'class'=>"btn btn-default w-24 ",
                                     ]
                                 ],
                                [
                                     'label'      => __('lang.save'),

                                     'options'   =>[
                                         'wire:click'  => "save()",
                                         'class'=>"btn btn-primary w-24 ml-2",

                                     ]
                                 ]
                           ]
                     ])




        </div>
    </div>
    <!-- END: Vertical Form -->

</div>

