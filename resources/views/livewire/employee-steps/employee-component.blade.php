<div>
    <div class="flex justify-center">
        <div class="font-medium text-base">{!! __('lang.payroll_info_form') !!}</div>
    </div>
    <div class="w-1/4 justify-center m-auto pb-5 pt-5">
        <div class="text-xs">{!! __('lang.payroll_description') !!}</div>
    </div>
    <div class="justify-center m-auto pt-10 text-center flex">
        <div class="w-1/4 rounded overflow-hidden shadow-lg cursor-pointer" wire:click="setStep('new_employee');">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">New Employee</div>
                <p class="text-gray-700 text-base">
                    Onboarding Form for New Hires
                </p>
            </div>
        </div>
        <div class="w-1/4 rounded overflow-hidden shadow-lg cursor-pointer" wire:click="setStep('existing_employee');">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Existing Employee</div>
                <p class="text-gray-700 text-base">
                    Change of Status on Existing Employees Form
                </p>
            </div>
        </div>
    </div>


    @if($option == 'existing_employee')
        <div class="justify-center m-auto flex">
            <div class="container w-1/2">
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    @include('forms.input',[
                                'parentDiv' => 'intro-y col-span-4',
                                'label'     => __('lang.employee_search'),
                                'label_class' => 'text-left flex',
                                'type'  => 'text',
                                'name'  => 'employeeSearchQuery',
                                'value' => $employeeSearchQuery ?? null,
                                'options'   =>[
                                    'wire:model'  => "employeeSearchQuery",
                                    'class'=>"form-control",
                                    'placeholder'   => 'Search for employee'
                                ]
                            ])
                </div>
                @if(count($employeeList) > 0)
                    <div class="grid grid-cols-12 mt-5 ">
                        <ul class="col-span-12 {!! count($employeeList) > 0 ? 'border-2' : '' !!}">
                            @foreach($employeeList as $empl)
                                <li>
                                    <a class="{!! $employee  != null && $employee['id'] == $empl['id'] ? 'bg-gray-400' : ''  !!}"
                                       href="" wire:click.prevent="chooseEmployee({!! $empl['id'] !!})" >{!! $empl['first_name'] . " ".$empl['last_name'] !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    @endif

    <div class="justify-center m-auto pt-10 text-center flex">

        @if($option != "")
            @include('livewire.employee-steps.partials.new_employee')
        @endif
    </div>


    <script>
        window.addEventListener("DOMContentLoaded", function () {
            Livewire.emit("reinitSelect2");
        });
    </script>
</div>
