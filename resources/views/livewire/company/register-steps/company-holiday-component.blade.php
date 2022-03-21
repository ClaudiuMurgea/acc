<div>
    @include('company.steps.stepsCounter',['data' => $data])

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">
            {!! __('lang.holiday_details') !!}

        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            {{--Standard Holidays--}}
            @include('livewire.company.register-steps.commons.holiday',[
                 'title' =>  __('lang.standard_us_holidays'),
                 'holidays'  => $legalHolidays,
                 'showModal'      => false
             ])
            {{--ADITIONAL HOLIDAYS--}}

            @include('livewire.company.register-steps.commons.holiday',[
               'title' =>  __('lang.additional_holiday'),
               'holidays'  => $company_holidays,
               'showModal'      => true
           ])


        </div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.buttons',[
                        'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                        'buttons'   =>[
                                 [
                                      'label'      => 'Prev',
                                      'options'   =>[
                                      'wire:click'  => '$emit("changeStep",2)',
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



{{--    @if($modal)
        <livewire:modal.add-holiday-modal :companyId="$companyId"/>
    @endif--}}


</div>

