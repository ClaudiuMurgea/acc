<div>
    @include('company.steps.stepsCounter',['data' => $data])

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">
            {!! __('lang.staff_details') !!}

        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Single Item -->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5  bg-primary text-white">
                        <h2 class="font-medium text-base mr-auto">{!! __('lang.available_employees') !!}</h2>
                        <div class="w-full sm:w-auto flex items-center sm:ml-auto  sm:mt-0">

                        </div>
                    </div>
                    <div class="p-5" wire:key="{!! 'table'.$data['page_title'] !!}">
                        <div class="preview">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <tbody>
                                    @foreach($contract_types as $contractType)
                                        <tr>
                                            <td class="border-b whitespace-nowrap">{!! $contractType->name !!}</td>
                                            <td class="border-b whitespace-nowrap ">
                                                @include('forms.switch',[
                                                       'parentDiv' => 'form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0 float-right',
                                                       'value' => 1 ,
                                                       'name' => 'checkbox',
                                                       'options'   =>[
                                                           'wire:click'  => "subscribeEmployeeType($contractType->id)",
                                                           'class'=>"form-check-input mr-0 ml-3",
                                                           'wire:key'       => random_int(1,125555555555),
                                                           'checked'    => in_array($contractType->id,$company_contract_types_arr) ? true : false,
                                                       ]
                                                   ])
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- END: Single Item -->
            </div>
            @if(!$company_contract_types->count())
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="alert alert-warning show mb-2 text-center" role="alert">{!! __('lang.no_selected_employees') !!}</div>
                </div>
            @else
                <ul class="intro-y col-span-12 lg:col-span-6" drag-root  wire:sortable="updateOrder" >
                    @foreach($company_contract_types as $contract_type)

                        <li draggable="true"  drag-item wire:sortable.item="{{ $contract_type->employee_contract_type_id }}" wire:key="employee-type-{{ $contract_type->id }}" wire:sortable.handle>
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none ">
                                    <h5 class="text-lg text-theme-5 font-medium leading-none mt-3 border-r-2">P{!! $contract_type->order !!}</h5>
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium" >{!! $contract_type->Type->name !!}</div>

                                </div>
                                <div class="text-danger"><i class="fas fa-grip-vertical" ></i>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.buttons',[
                        'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                        'buttons'   =>[
                                 [
                                      'label'      => 'Prev',
                                      'options'   =>[
                                      'wire:click'  => '$emit("changeStep",3)',
                                          'class'=>"btn btn-default w-24 ml-2",
                                      ]
                                  ],
                                 [
                                      'label'      => 'Next',

                                      'options'   =>[
                                          'wire:click'  => "save()",
                                          'class'=>"btn btn-primary w-24 ml-2",
                                          'disabled'   => !$company_contract_types->count() ? true : false,
                                      ]
                                  ]
                            ]
                      ])

        </div>
    </div>




</div>
