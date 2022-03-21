<div>
    @include('facility.steps.stepsCounter',['data' => $data])
    <div wire:loading>
        @include('forms.loading')
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">{!! __('lang.location_details') !!}</div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

            @include('forms.input',[
                'parentDiv' => 'intro-y xl:col-span-6',
                'label'     => __('lang.facility_name') ,
                'type'  => 'text',
                'name'  => 'facility_name',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "facility_name",
                    'class'=>"form-control",
                    'placeholder'   => __('lang.facility_name_placeholder')
                ]
            ])
        </div>

        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.input',[
                'parentDiv' => 'intro-y xl:col-span-6',
                'label'     => __('lang.license_no') ,
                'type'  => 'text',
                'name'  => 'license_no',
                'value' => null ,
                'options'   =>[
                    'wire:model.defer'  => "license_no",
                    'class'=>"form-control",
                    'placeholder'   => __('lang.license_no_placeholder')
                ]
            ])
        </div>

        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.select',[
                         'parentDiv' => 'intro-y xl:col-span-6',
                         'label_class' => 'form-label text-left flex',
                         'label' =>  __('lang.time_zone'),
                         'type'  => 'text',
                         'name'  => 'time_zone',

                         'values' => $timezones,
                         'options' => [
                                  'name' => 'time_zone',
                                  'id' => 'select2-time_zone',
                                  'data-model' => 'time_zone',
                                  'class' => 'form-control select2',
                                  'data-function_to_emit' => 'updateTimezone',
                                   'label' =>  __('lang.time_zone'),
                                  'functionToEmit'    => 'updateTimezone',
                              ],
                              'selected' => $time_zone ?? "",
                     ])
        </div>



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
    <script>
        window.addEventListener("DOMContentLoaded", function () {
            Livewire.emit("reinitSelect2");


        });

    </script>
</div>


