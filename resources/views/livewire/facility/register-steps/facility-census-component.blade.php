<div>
    @include('facility.steps.stepsCounter',['data' => $data])


    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">

            <button wire:click="toggleCensors(false)" class="{!! $existingCensors ? 'btn btn-sm btn-secondary' : '' !!} mr-3">{!! __('lang.authenticate_census') !!}</button>
            <button wire:click="toggleCensors(true)" class="{!! !$existingCensors ? 'btn btn-sm btn-secondary' : '' !!}">{!! __('lang.existing_provider') !!}</button>
        </div>

        @if(!$existingCensors)
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                @include('forms.input',[
                    'parentDiv' => 'intro-y xl:col-span-6',
                    'label'     => __('lang.provider_name') ,
                    'type'  => 'text',
                    'name'  => 'provider_name',
                    'value' => null ,
                    'options'   =>[
                        'wire:model.defer'  => "provider_name",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.provider_name_placeholder')
                    ]
                ])
            </div>

            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                @include('forms.input',[
                    'parentDiv' => 'intro-y xl:col-span-6',
                    'label'     => __('lang.address') ,
                    'type'  => 'text',
                    'name'  => 'address',
                    'value' => null ,
                    'options'   =>[
                        'wire:model.defer'  => "address",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.address_placeholder')
                    ]
                ])
            </div>
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                @include('forms.input',[
                    'parentDiv' => 'intro-y xl:col-span-6',
                    'label'     => __('lang.city') ,
                    'type'  => 'text',
                    'name'  => 'city',
                    'value' => null ,
                    'options'   =>[
                        'wire:model.defer'  => "city",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.city_placeholder')
                    ]
                ])
            </div>
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                @include('forms.input',[
                    'parentDiv' => 'intro-y xl:col-span-6',
                    'label'     => __('lang.zip_code') ,
                    'type'  => 'text',
                    'name'  => 'zip_code',
                    'value' => null ,
                    'options'   =>[
                        'wire:model.defer'  => "zip_code",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.zip_code_placeholder')
                    ]
                ])
            </div>
        @else
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                @include('forms.select',[
                    'parentDiv' => 'intro-y xl:col-span-6',
                    'label'     => __('lang.provider') ,
                    'type'  => 'text',
                    'name'  => 'provider',
                    'values' => $censuses,
                    'options'   =>[
                        'wire:model'  => "provider",
                        'class'=>"form-control",
                        'id'        => 'provider',
                        'wire:key'  => rand(0,1202012)

                    ]
                ])
            </div>
        @endif




        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">

            @include('forms.buttons',[
                'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                'buttons'   =>[
                         [
                              'label'      => 'Prev',
                              'options'   =>[
                              'wire:click'  => '$emit("changeStep",1)',
                                  'class'=>"btn btn-default w-24 ml-2",
                              ]
                          ],
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


