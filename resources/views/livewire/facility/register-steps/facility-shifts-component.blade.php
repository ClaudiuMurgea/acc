<div>
    @include('facility.steps.stepsCounter',['data' => $data])

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">{!! __('lang.standard_shift_schedule') !!}</div>

        <div class="flex  mt-10">
            <div class="tab-content justify-center w-full">
                <div  class="flex flex-col  lg:flex-row">
                    <div class="intro-y w-1/4 py-16"></div>

                    <div class="intro-y w-full  box {!! $shiftType  ? 'border-primary border-2 ' : '' !!} py-16 lg:ml-5 mb-5 lg:mb-0  cursor-pointer " wire:click="selectType(true)">
                        <img src="/incs/imgs/calendar.png" class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto" />
                        <div class="text-md font-medium text-center mt-10">{!! __('lang.company_default') !!}</div>
                        <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">{!! __('lang.use_company_default') !!}</div>
                    </div>
                    <div class="intro-y w-full  box {!! !$shiftType  ? 'border-primary border-2 ' : '' !!} py-16 lg:ml-5 mb-5 lg:mb-0  cursor-pointer " wire:click="selectType(false)">
                        <img src="/incs/imgs/calendar-override.png" class="block w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto" />
                        <div class="text-md font-medium text-center mt-10">{!! __('lang.override') !!}</div>
                        <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">{!! __('lang.override_description') !!}</div>
                    </div>
                    <div class="intro-y w-1/4 py-16"></div>
                </div>
            </div>
        </div>

        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
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
</div>

