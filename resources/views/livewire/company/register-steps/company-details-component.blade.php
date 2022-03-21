<div>
    @include('company.steps.stepsCounter',['data' => $data])

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">{!! __('lang.company_details') !!}</div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.company_name') ,
                'type'  => 'text',
                'name'  => 'company_name',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "company_name",
                    'class'=>"form-control",
                    'placeholder'   => 'John\'s Company'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.number_of_locations') ,
                'type'  => 'text',
                'name'  => 'no_of_locations',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "no_of_locations",
                    'class'=>"form-control",
                    'placeholder'   => '10'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.corporate_address') ,
                'type'  => 'text',
                'name'  => 'corporate_address',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "corporate_address",
                    'class'=>"form-control",
                    'placeholder'   => '123 Anywhere Street, New York, NY 10000'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.corporate_phone') ,
                'type'  => 'text',
                'name'  => 'corporate_phone_number',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "corporate_phone_number",
                    'class'=>"form-control",
                    'placeholder'   => '000 000 000'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.ein') ,
                'type'  => 'text',
                'name'  => 'ein',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "ein",
                    'class'=>"form-control",
                    'placeholder'   => '00-00000000'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.point_of_contact') ,
                'type'  => 'text',
                'name'  => 'poc',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "poc",
                    'class'=>"form-control",
                    'placeholder'   => '00-00000000'
                ]
            ])
            @include('forms.select',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.week_start') ,
                'type'  => 'text',
                'name'  => 'week_start',
                'values' => [null => 'Select', '0' => 'Sunday','1' => 'Monday'],
                'options'   =>[
                    'wire:model.defer'  => "week_start",
                    'class'=>"form-control",

                ]
            ])

            @include('forms.select',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.hour_format') ,
                'type'  => 'text',
                'name'  => 'hour_format',
                'values' => [null => 'Select', '0' => '24H','1' => 'AM / PM'],
                'options'   =>[
                    'wire:model.defer'  => "hour_format",
                    'class'=>"form-control",

                ]
            ])


            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">

                @include('forms.buttons',[
                      'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                      'buttons'   =>[
                               [
                                    'label'      => 'Next',

                                    'options'   =>[
                                        'wire:click'  => "save()",
                                        'class'=>"btn btn-primary w-24 ml-2",

                                    ]
                                ]
                          ]
                    ])
            </div>
        </div>
    </div>
</div>
