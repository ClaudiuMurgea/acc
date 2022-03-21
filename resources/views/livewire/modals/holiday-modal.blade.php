<div>
   <x-modal wire:model="show" >
       <div class="modal-header">
           <h2 class="font-medium text-base mr-auto">{!! __('lang.add_holiday') !!}</h2>
       </div>

       <!-- END: Modal Header -->
       <!-- BEGIN: Modal Body -->
       <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
           @include('forms.date',[
                       'parentDiv' => 'col-span-12 sm:col-span-4',
                       'label'     => __('lang.date') ,
                       'type'  => 'text',
                       'name'  => 'holiday_date',
                       'value' => null ,
                       'icon'  => '<i class="fas fa-calendar"></i>',
                       'options'   =>[
                           'wire:model.defer'  => "holiday_date",
                           'class'=>"datepicker form-control pl-12",
                           'data-single-mode' => "true",
                           'eventToEmit' => 'setHoliday',
                           'currentmodel' => 'holiday_date',
                           'wire:key'      => 'holiday_date'
                       ]
                   ])


           @include('forms.input',[
                      'parentDiv' => 'col-span-12 sm:col-span-4' ,
                      'label'     => __('lang.holiday_name') ,
                      'type'  => 'text',
                      'name'  => 'holiday_name',
                      'value' => null ,
                      'options'   =>[
                          'wire:model.defer'  => "holiday_name",
                          'class'=>"form-control",
                          'placeholder'   => 'Company specific Holiday',
                          'wire:key'       => random_int(1,125555555555)

                      ]
                  ])
           @include('forms.switch',[
                        'parentDiv' => 'col-span-12 sm:col-span-3 form-check form-switch w-full sm:w-auto sm:ml-auto  mt-4 text-center',
                        'label'     => __('lang.recurrent') ,
                        'type'  => 'text',
                        'name'  => 'recurrent',
                        'value' => 1 ,
                        'options'   =>[
                            'wire:model.defer'  => "recurrent",
                            'class'=>"form-check-input mr-0 ml-3",
                            'wire:key'       => random_int(1,125555555555)
                        ]
                    ])



       </div>
       <!-- END: Modal Body -->
       <!-- BEGIN: Modal Footer -->
       <div class="modal-footer text-right">
           <button type="button" data-dismiss="modal" class="btn btn-danger w-20 mr-1" x-on:click="show = false">{!! __('lang.cancel') !!}</button>
           <button type="button" class="btn btn-primary w-20" wire:click="addHoliday()">{!! __('lang.add',['what' => '']) !!}</button>
       </div>
   </x-modal>
</div>
