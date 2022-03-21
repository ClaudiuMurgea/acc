<div>
    @include('company.steps.stepsCounter',['data' => $data])
    <div wire:loading>
        @include('forms.loading')
    </div>

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">
            {!! __('lang.billing_details') !!}
            <button class="btn btn-secondary">{!! __('lang.auto_link') !!}</button>
        </div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.billing_name') ,
                'type'  => 'text',
                'name'  => 'billing_name',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "billing_name",
                    'class'=>"form-control",
                    'placeholder'   => 'John\'s Company'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                'label'     => __('lang.billing_phone_number') ,
                'type'  => 'text',
                'name'  => 'phone_number',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "phone_number",
                    'class'=>"form-control",
                    'placeholder'   => '000 000 000'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-4',
                'label'     => __('lang.billing_address') ,
                'type'  => 'text',
                'name'  => 'billing_address',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "billing_address",
                    'class'=>"form-control",
                    'placeholder'   => '123 Anywhere Street, New York, NY 10000'
                ]
            ])
            @include('forms.input',[
                'parentDiv' => 'intro-y col-span-12 sm:col-span-4',
                'label'     => __('lang.billing_address2') ,
                'type'  => 'text',
                'name'  => 'billing_address2',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "billing_address2",
                    'class'=>"form-control",
                    'placeholder'   => '123 Anywhere Street, New York, NY 10000'
                ]
            ])
            @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-12 sm:col-span-4',
                    'label'     => __('lang.zip_code') ,
                    'type'  => 'text',
                    'name'  => 'zip_code',
                    'value' => null ,
                    'options'   =>[
                        'wire:model.defer'  => "zip_code",
                        'class'=>"form-control",
                        'placeholder'   => '000000'
                    ]
                ])
        </div>


        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

            @include('forms.select',[
                          'parentDiv' => 'intro-y xl:col-span-4',
                          'label_class' => 'form-label text-left flex',
                          'label' =>  __('lang.country'),
                          'type'  => 'text',
                          'name'  => 'country_id',
                          'ignore' => true,
                          'values' => $countryList,
                          'options' => [
                                   'name' => 'country_id',
                                   'id' => 'select2-country_id',
                                   'data-model' => 'country_id',
                                   'class' => 'form-control select2',
                                   'data-function_to_emit' => 'updateCountry_id',
                                    'label' =>  __('lang.country'),
                                   'functionToEmit'    => 'updateCountry_id',
                               ],
                               'selected' => $country_id ?? "",
                      ])


            @include('forms.select',[
                        'parentDiv' => 'intro-y xl:col-span-4',
                        'label_class' => 'form-label text-left flex',
                        'label' =>  __('lang.state'),
                        'type'  => 'text',
                        'name'  => 'state_id',
                        'ignore' => $ignoreStates,
                        'values' => $statesList,
                        'options' => [
                                    'name' => 'state_id',
                                    'id' => 'select2-state_id',
                                    'data-model' => 'state_id',
                                    'label' =>  __('lang.state'),
                                    'class' => 'form-control select2',
                                    'wire:model'    => 'state_id',
                                    'functionToEmit'    => 'updateState_id',
                                ],
                                'selected' => $state_id ?? "",

                    ])

            @include('forms.select',[
                        'parentDiv' => 'intro-y xl:col-span-4',
                        'label_class' => 'form-label text-left flex',
                        'label' =>  __('lang.city'),
                        'type'  => 'text',
                        'name'  => 'state_id',
                        'ignore' => $ignoreCities,
                        'values' => $citiesList,
                        'options' => [
                                    'name' => 'city_id',
                                    'id' => 'select2-city_id',
                                    'data-model' => 'city_id',
                                    'class' => 'form-control select2',
                                    'wire:model'    => 'city_id',
                                    'functionToEmit'    => 'updateCity_id',
                                     'label' =>  __('lang.city'),
                                ],
                                'selected' => $city_id ?? "",

                    ])




        </div>

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

    <script>
        window.addEventListener("DOMContentLoaded", function () {
            Livewire.emit("reinitSelect2");


        });

    </script>
</div>
