<div>
    @include('facility.steps.stepsCounter',['data' => $data])

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="flex flex-col sm:flex-row items-center ">
            <h2 class="font-medium text-base mr-auto"> {!! __('lang.role_groups') !!}</h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <button class="btn btn-secondary form-control col-span-4" x-data
                        x-on:click="
                        window.livewire.emitTo(
                            'modals.facility-step-modal',
                            'showFacilityModal',
                            'role_groups',
                            '{!! $companyId !!}',
                            JSON.stringify({
                            facilityId: {!! $facility->id !!},
                            groupId: null
                            })
                        )">
                    <i class="fas fa-plus"></i>&nbsp;
                    {!! __('lang.add',['what' => __('lang.role_groups')]) !!}</button>

            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Single Item -->
                <div class="intro-y box">

                    <div class="p-5" wire:key="{!! 'table'.$data['page_title'] !!}">
                        <div class="preview">
                            <div class="overflow-x-auto">
                                <table class="table ">
                                    <thead class="border-b ">
                                    <tr>
                                        <th class="whitespace-nowrap">{!! __('lang.role_name') !!}</th>
                                        <th class="whitespace-nowrap">{!! __('lang.required_roles') !!}</th>
                                        <th class="whitespace-nowrap"></th>
                                    </tr>
                                    </thead>
                                    <tbody >
                                    @if(!count($facility->Groups))
                                        <tr >
                                            <td colspan="3" class="text-center"><span class="text-primary">{!! __('lang.no_data',['what' => __('lang.role_groups')]) !!}</span></td>
                                        </tr>
                                    @else
                                        @foreach($facility->Groups as $group)

                                            <tr class="{!! !$loop->last ? 'border-b' : '' !!} ">
                                                <td class="whitespace-nowrap">{!! $group->name !!}</td>
                                                <td>

                                                    @foreach($group->Roles as $role)

                                                        <span class="flex-none  bg-gray-200 text-gray-600 text-xs tracking-wide px-2 py-1 rounded-md mr-3">{!! $role->EmployeeRole->name  !!}</span>
                                                    @endforeach
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    <div class="flex float-right">
                                                        <a class="flex text-warning" href="#" wire:click="$emit('toggleModal',{!! $group->id !!})" x-data
                                                           x-on:click="
                                                            window.livewire.emitTo(
                                                                'modals.facility-step-modal',
                                                                'showFacilityModal',
                                                                'role_groups',
                                                                '{!! $companyId !!}',
                                                                JSON.stringify({
                                                                facilityId: {!! $facility->id !!},
                                                                groupId: {!! $group->id !!}
                                                                })
                                                            )">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                                            {!! __('lang.edit') !!}
                                                        </a> &nbsp&nbsp&nbsp
                                                        <a class="flex text-danger" href="#" wire:click="delete({!! $group->id !!}) " >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> {!! __('lang.delete') !!}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- END: Single Item -->
            </div>

        </div>
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.buttons',[
                        'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                        'buttons'   =>[
                                 [
                                      'label'      => 'Prev',
                                      'options'   =>[
                                      'wire:click'  => '$emit("changeStep",5)',
                                          'class'=>"btn btn-default w-24 ml-2",
                                      ]
                                  ],
                                 [
                                      'label'      => 'Next',

                                      'options'   =>[
                                          'wire:click'  => "save()",
                                          'class'=>"btn btn-primary w-24 ml-2",
                                         /* 'disabled'   => !$company_employee_types->count() ? true : false,*/
                                      ]
                                  ]
                            ]
                      ])

        </div>
    </div>



</div>

