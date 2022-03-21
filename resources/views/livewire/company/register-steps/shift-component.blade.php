<div wire:init="shiftselected">
    @include('company.steps.stepsCounter',['data' => $data])

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="flex flex-col sm:flex-row items-center ">
            <h2 class="font-medium text-base mr-auto"> {!! __('lang.standard_shift_schedule') !!}</h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <button class="btn btn-secondary form-control col-span-4" wire:click="addShiftGroup"><i class="fas fa-plus"></i>&nbsp; {!! __('lang.add',['what' => 'Shift Group']) !!}</button>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            <label for="regular-form-1" class="form-label">{!! __('lang.name') !!}</label>
        </div>




        <div class="flex gap-4  text-sm font-bold bg-stripes-purple rounded-lg">
            @foreach($shifts as $index => $shift)
                @include('forms.input-group-icon',[
               'icon'       => count($shifts) >1 ? '<i class="fas fa-times text-danger  w-8 h-8 absolute mt-3 right-0 cursor-pointer " wire:click.prevent="removeShiftGroup( '.$index.' )"></i>' : null,
               'label'     => __('lang.billing_name') ,
               'type'  => 'text',
               'name'  => "shifts.$index.name",
               'value' => null ,
               'options'   =>[
                   'class'=>"form-control focus:outline-none",
                   'id'     => 'shift-'.$index,
                   'placeholder'    => __('lang.shift_name') ,
                   'wire:model'     => "shifts.$index.name",
                   'wire:click'     => 'shiftselected('.$index.')',
                   'wire:key'       => 'shift-selected-' . $index
               ]
           ])

            @endforeach

        </div>




        @foreach($shifts[$selectedShift]['values'] as $valueKey => $row)
            <div class="flex gap-4  text-sm font-bold bg-stripes-purple rounded-lg  mt-5">
                @include('forms.time',[
                                     'parentDiv' => 'col-span-12 sm:col-span-6 xl:col-span-3',
                                     'label'     => __('lang.time',['time' => 'Start']) ,
                                     'type'  => 'text',
                                      'icon'  => '<i class="far fa-clock"></i>',
                                     'name'  => 'shifts.'.$selectedShift.'.values.'.$valueKey.'.start_time',
                                     'value' => null ,
                                     'options'   =>[
                                         'wire:model'      => 'shifts.'.$selectedShift.'.values.'.$valueKey.'.start_time',
                                         'class'=>"timepicker form-control pl-12",
                                         'data-single-mode' => "true",
                                         'id'   => 'timepicker-'.'shifts.'.$selectedShift.'.values.start_time',
                                         'wire:key'      =>  'shifts.'.$selectedShift.'.values.'.$valueKey.'.start_time' . rand(1,100000000),
                                     ]
                                 ])
                @include('forms.time',[
                                     'parentDiv' => 'col-span-12 sm:col-span-6 xl:col-span-3',
                                     'label'     => __('lang.time',['time' => 'End']) ,
                                     'type'  => 'text',
                                     'icon'  => '<i class="far fa-clock"></i>',
                                     'name'  => 'shifts.'.$selectedShift.'.values.'.$valueKey.'.end_time',
                                     'value' => null ,
                                     'options'   =>[
                                         'wire:model'      => 'shifts.'.$selectedShift.'.values.'.$valueKey.'.end_time',
                                         'class'=>"timepicker form-control pl-12",
                                         'data-single-mode' => "true",
                                         'id'   => 'timepicker-'.'shifts.'.$selectedShift.'.values.end_time',
                                         'wire:key'      =>  'shifts.'.$selectedShift.'.values.'.$valueKey.'.end_time' . rand(1,100000000),
                                     ]
                                 ])


                @foreach($row['days'] as $dayName => $day)
                    @php
                        $selected = ($shifts[$selectedShift]['values'][$valueKey]['days'][$dayName] == 1) ? 'border-1 border-primary text-black-700' : '';
                    @endphp
                    @include('forms.buttons',[
                             'parentDiv' => 'col-span-12 sm:col-span-3 xl:col-span-3',
                             'buttons'   =>[
                                      [
                                           'label'      => $dayName,
                                           'nolabel' => 1,
                                           'name'   => 'shifts.'.$selectedShift.'.values.*.days',
                                           'options'   =>[
                                                'nolabel' => true,
                                               'wire:click'  => '$emit("selectDay","'.$dayName.'",'.$selectedShift.','.$valueKey.')',
                                               'class'=>"btn btn-default w-24 ml-2 mt-2  $selected" ,
                                               'wire:model'      => 'shifts.'.$selectedShift.'.values.'.$valueKey.'.end_time',
                                           ]
                                       ],
                                 ]
                           ])


                @endforeach
                <div class="col-span-12 sm:col-span-3 xl:col-span-3">
                    <br><br>
                    @if(count($shifts[$selectedShift]['values']) > 1 )
                        <i class="fas fa-times text-danger  w-8 h-8 absolute cursor-pointer " wire:click="removeShift({!! $valueKey !!})"></i>
                    @endif
                </div>
            </div>
        @endforeach



    <!-- END: Single Item -->
        <div class="flex gap-4  text-sm font-bold bg-stripes-purple rounded-lg  mt-5">
            @include('forms.buttons',[
                        'parentDiv' => 'intro-y col-span-12 flex sm:justify-start mt-5',
                        'buttons'   =>[
                                 [
                                      'label'      => '<i class="fas fa-plus"></i>&nbsp'.__('lang.add',['what' => 'Shift']) ,
                                      'options'   =>[
                                           'wire:click'  => 'addShift()',
                                          'class'=>"btn btn-secondary form-control col-span-4",
                                      ]
                                  ],

                            ]
                      ])

        </div>


        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.buttons',[
                        'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                        'buttons'   =>[
                                         [
                                              'label'      => 'Prev',
                                              'options'   =>[
                                                      'wire:click'  => '$emit("changeStep",4)',
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
        {{--@dump($shifts)--}}
    </div>


</div>

