<div class="container w-1/2">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 0 !important;
        }
    </style>

    <div class="grid grid-cols-3 gap-4 gap-y-5 mt-5">
        @include('forms.input',[
                    'parentDiv' => 'intro-y ',
                    'label'     => __('lang.payroll_no') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'payroll_no',
                    'value' => $employee->payroll_no ?? ($payroll_no ?? null),
                    'options'   =>[
                        'wire:model.defer'  => "payroll_no",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.payroll_no')
                    ]
                ])

        @include('forms.input',[
           'parentDiv' => 'intro-y ',
           'label'     => __('lang.title') ,
           'label_class' => 'text-left flex',
           'type'  => 'text',
           'name'  => 'title',
           'value' => $employee->title ?? ($title ?? null),
           'options'   =>[
               'wire:model.defer'  => "title",
               'class'=>"form-control",
               'placeholder'   => __('lang.title')
           ]
       ])

        @include('forms.input',[
            'parentDiv' => 'intro-y ',
            'label'     => __('lang.first_name') ,
            'label_class' => 'text-left flex',
            'type'  => 'text',
            'name'  => 'first_name',
            'value' => $employee->first_name ?? ($first_name ?? null),
            'options'   =>[
                'wire:model.defer'  => "first_name",
                'class'=>"form-control",
                'placeholder'   => 'Employee First Name'
            ]
        ])

        @include('forms.input',[
            'parentDiv' => 'intro-y ',
            'label'     => __('lang.last_name') ,
            'label_class' => 'text-left flex',
            'type'  => 'text',
            'name'  => 'last_name',
            'value' => $employee->last_name ?? ($last_name ?? null),
            'options'   =>[
                'wire:model.defer'  => "last_name",
                'class'=>"form-control",
                'placeholder'   => 'Employee Last Name'
            ]
        ])

        @include('forms.select',[
                    'parentDiv' => "intro-y",
                    'label_class' => 'form-label text-left flex',
                    'label' =>  __('lang.facility'),
                    'name' => 'facility_id',
                    'values' => $facilitiesList,
                    'options' => [
                        'name' => 'facility_id',
                        'id' => 'select2-facility_id',
                        'wire:model.defer'    => 'facility_id',
                        'functionToEmit'    => 'updateFacility_id',
                        'data-placeholder' => 'Select a facility',
                        'class' => 'select2',
                    ],
                    'selected' => $employee->facility_id ?? ($facility_id ?? 0),
                    'listOptions' => [
                      //  0 => [ "disabled" => true ]
                    ]
                ])

        @include('forms.date',[
                    'parentDiv' => '',
                    'label'     => __('lang.date_of_birth') ,
                     'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'date_of_birth',
                    'value' => $employee->date_of_birth ?? ( $date_of_birth ?? null ),
                    'icon'  => '<i class="fas fa-calendar"></i>',
                    'options'   =>[
                        'wire:model.defer'  => "date_of_birth",
                        'class'=>"datepicker form-control pl-12",
                        'data-single-mode' => "true",
                        'eventToEmit' => 'setDOB',
                        'currentmodel' => 'date_of_birth',
                        'wire:key'      => 'date_of_birth',
                        'min' => '1900-01-01',
                    ]
                ])

        @include('forms.date',[
            'parentDiv' => '',
            'label'     => __('lang.date_of_hire') ,
             'label_class' => 'text-left flex',
            'type'  => 'text',
            'name'  => 'date_of_hire',
            'value' => $employee->date_of_hire ?? ( $date_of_hire ?? null),
            'icon'  => '<i class="fas fa-calendar"></i>',
            'options'   =>[
                'wire:model.defer'  => "date_of_hire",
                'class'=>"datepicker form-control pl-12",
                'data-single-mode' => "true",
                'eventToEmit' => 'setDOH',
                'currentmodel' => 'date_of_hire',
                'wire:key'      => 'date_of_hire'
            ]
        ])

        @include('forms.input',[
            'parentDiv' => 'intro-y',
            'label'     => __('lang.social_security') ." #",
            'label_class' => 'text-left flex',
            'type'  => 'text',
            'name'  => 'social_security',
            'value' => $employee->social_security ?? ($social_security ?? null),
            'options'   =>[
                'wire:model.defer'  => "social_security",
                'class'=>"form-control",
                'placeholder'   => 'Social Security #'
            ]
        ])

        @include('forms.input',[
            'parentDiv' => 'intro-y',
            'label'     => __('lang.address') ,
            'label_class' => 'text-left flex',
            'type'  => 'text',
            'name'  => 'address',
            'value' => $employee->address ?? ($address ?? null),
            'options'   =>[
                'wire:model.defer'  => "address",
                'class'=>"form-control",
                'placeholder'   => 'Address'
            ]
        ])
    </div>

    <div class="grid grid-cols-3 gap-4 gap-y-5 mt-5">

        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.country'),
            'name' => 'country_id',
            'values' => $countryList,
            'options' => [
                'name' => 'country_id',
                'id' => 'select2-country_id',
                'wire:model.defer'    => 'country_id',
                'functionToEmit'    => 'updateCountry_id',
                'data-placeholder' => 'Select a country',
                'class' => 'select2',
            ],
            'selected' => $employee->country_id ?? ($country_id ?? 0),
            'listOptions' => [
              //  0 => [ "disabled" => true ]
            ]
        ])

        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.state'),
            'name' => 'state_id',
            'values' => $statesList ?? [],
            'options' => [
                'name' => 'state_id',
                'id' => 'select2-state_id',
                'wire:model.defer'    => 'state_id',
                'functionToEmit'    => 'updateState_id',
                'data-placeholder' => 'Select a state',
                'class' => 'select2',
            ],
            'selected' => $employee->state_id ?? $state_id,
            'listOptions' => [
                //0 => [ "disabled" => true ]
            ]
        ])

        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.city'),
            'name' => 'city_id',
            'values' => $citiesList ?? [],
            'options' => [
                'name' => 'city_id',
                'id' => 'select2-city_id',
                'wire:model.defer'    => 'city_id',
                'functionToEmit'    => 'updateCity_id',
                'data-placeholder' => 'Select a city',
                'class' => 'select2',
            ],
            'selected' => $employee->city_id ?? $city_id,
            'listOptions' => [
                //0 => [ "disabled" => true ]
            ]
        ])
    </div>

    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
        @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-3',
                    'label'     => __('lang.zip_code') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'zip_code',
                    'value' => $employee->zip_code ?? ($zip_code ?? null),
                    'options'   =>[
                        'wire:model.defer'  => "zip_code",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.zip_code'),
                    ]
                ])

        @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-3',
                    'label'     => __('lang.phone') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'phone',
                    'value' => $employee->phone ?? $phone,
                    'options'   =>[
                        'wire:model.defer'  => "phone",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.phone'),

                    ]
                ])

        @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-3',
                    'label'     => __('lang.mobile_phone') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'mobile_phone',
                    'value' => $employee->mobile_phone ?? $mobile_phone,
                    'options'   =>[
                        'wire:model.defer'  => "mobile_phone",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.mobile_phone'),

                    ]
                ])
        @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-3',
                    'label'     => __('lang.other_phone') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'alt_phone',
                    'value' => $employee->alt_phone ?? $alt_phone,
                    'options'   =>[
                        'wire:model.defer'  => "alt_phone",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.other_phone')
                    ]
                ])
        @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-3',
                    'label'     => __('lang.email') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'email',
                    'value' => $employee->email1 ?? $email,
                    'options'   =>[
                        'wire:model.defer'  => "email",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.email')
                    ]
                ])
        @include('forms.input',[
                    'parentDiv' => 'intro-y col-span-3',
                    'label'     => __('lang.alt_email') ,
                    'label_class' => 'text-left flex',
                    'type'  => 'text',
                    'name'  => 'alt_email',
                    'value' => $employee->email2 ?? $alt_email,
                    'options'   =>[
                        'wire:model.defer'  => "alt_email",
                        'class'=>"form-control",
                        'placeholder'   => __('lang.email')
                    ]
                ])
    </div>

    <div class="grid grid-cols-3 gap-4 gap-y-5 mt-5">
        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.department'),
            'name' => 'department_id',
            'values' => $departmentList ?? [],
            'options' => [
                'name' => 'department_id',
                'id' => 'select2-department_id',
                'wire:model.defer'    => 'department_id',
                'functionToEmit'    => 'updateDepartment_id',
                'class' => 'select2',
            ],
            'selected' => $employee->department_id ?? ($department_id ?? 0),
            'listOptions' => [
               // 0 => [ "disabled" => true ]
            ]
        ])
        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.position'),
            'name' => 'position_id',
            'values' => $positionsList ?? [],
            'options' => [
                'name' => 'position_id',
                'id' => 'select2-position_id',
                'wire:model.defer'    => 'position_id',
                'functionToEmit'    => 'updatePosition_id',
                'data-placeholder' => 'Select a position',
                'class' => 'select2',
            ],
            'selected' => $employee->position_id ?? ($position_id ?? 0),
            'listOptions' => [
               // 0 => [ "disabled" => true ]
            ]
        ])
        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label' =>  __('lang.days_worked'),
            'name' => 'employee_type_id',
            'values' => $employeeTypes ?? [],
            'options' => [
                'name' => 'employee_type_id',
                'id' => 'select2-employee_type_id',
                'wire:model.defer'    => 'employee_type_id',
                'functionToEmit'    => 'updateEmployee_type_id',
                'data-placeholder' => 'Select days worked',
                'class' => 'select2',
            ],
            'selected' => $employee->employee_type_id ?? $employee_type_id,
            'listOptions' => [
               // 0 => [ "disabled" => true ]
            ]
        ])
    </div>

    <div class="grid grid-cols-3 gap-4 gap-y-5 mt-5">
        <div>
            <label for="rate_of_pay" class="form-label text-left block">{!! __('lang.rate_of_pay') !!}</label>
            <div class="">
                @include('forms.input',[
                    'parentDiv' => '',
                    'parentDivStyle' => 'text-align: left;display: inline-block;width:60%;',
                    'label'     => false,
                    'type'  => 'text',
                    'name'  => 'rate_of_pay',
                    'show_error' => false,
                    'value' => $employee->rate_of_pay ?? ($rate_of_pay ?? ''),
                    'options'   =>[
                        'wire:model.defer'  => "rate_of_pay",
                        'class'=>"px-3 py-2 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-full pr-10",
                        'placeholder'   => __('lang.rate_of_pay'),
                        'style' => 'border-radius: 0.25rem 0 0 0.25rem;height:40px;'
                    ]
                ])
                <div style="text-align: left;display: inline-block;margin-left: -5px;width: 40%;">
                    @include('forms.select',[
                        'parentDiv' => "",
                        'label_class' => '',
                        'label' =>  false,
                        'name' => 'rate_of_pay_option',
                        'values' => $rate_of_pay_options,
                        'show_error' => false,
                        'options' => [
                            'name' => 'rate_of_pay_option',
                            'id' => 'select2-rate_of_pay_option',
                            'wire:model.defer'    => 'rate_of_pay_option',
                            'functionToEmit'    => 'updateRate_of_pay_option_id',
                            'class' => 'select2',
                            'data-with_search' => false,
                        ],
                        'selected' => $employee->rate_of_pay_option ?? $rate_of_pay_option,
                    ])
                </div>

            </div>
            @if($errors->has('rate_of_pay') || $errors->has('rate_of_pay_option'))
                @error('rate_of_pay')
                <div class="pristine-error text-danger mt-2">
                    <small>
                        {{$message}}
                    </small>
                </div>
                @enderror
                @error('rate_of_pay_option')
                <div class="pristine-error text-danger mt-2">
                    <small>
                        {{$message}}
                    </small>
                </div>
                @enderror
            @endif
        </div>

        @include('forms.select',[
            'parentDiv' => "intro-y",
            'label_class' => 'form-label text-left flex',
            'label'     => __('lang.rate_approved_by') ,
            'name' => 'approved_by',
            'values' => $approvedbyList,
            'options' => [
                'name' => 'approved_by',
                'id' => 'select2-approved_by',
                'wire:model.defer'  => "approved_by",
                'functionToEmit'    => 'updateRateApprovedBy',
                'data-placeholder' => 'Rate approved by',
                'class' => 'select2',
            ],
            'selected' => $employee->approved_by ?? $approved_by,
            'listOptions' => [
                //0 => [ "disabled" => true ]
            ]
        ])
    </div>

    <div class="grid grid-cols-12 gap-0 mt-5">
        <label for="benefits" class="form-label text-left block col-span-12">{!! __('lang.benefits') !!}</label>
        <div class="text-left col-span-12 mb-4 ">
            <p style="font-size: 12px;">Select all that apply</p>
        </div>
        <div class="flex ">
            @foreach($benefitsList as $_benefit)
                <a href="" wire:click.prevent="$emit('addBenefit', {!! $_benefit['id'] !!}, '{!! $_benefit["name"] !!}')"
                   class="inline-block items-center justify-center px-4 py-1 mx-2 text-xs font-bold leading-none text-indigo-100 rounded benefit-badge {!! in_array($_benefit['id'], array_keys($benefitsSelected))? 'selected' : '' !!}">{!! $_benefit['name'] !!}</a>
            @endforeach

        </div>
    </div>

    <div class="flex mt-5 mb-6">
        @foreach($benefitsSelected as $bid => $benefitInput)
            @php
                $n = strtolower(join("_", preg_split('/\s+/', $benefitInput['name'] )));
            @endphp

            @include('forms.input',[
                'parentDiv' => 'intro-y mr-5 col-span-2',
                'label'     => $benefitInput['name'],
                'label_class' => 'text-left flex',
                'type'  => 'text',
                'name'  => $benefitInput['name'],
                'value' => $benefitInput[$bid]['value'] ?? null,
                'options'   => [
                    'wire:model.defer'  => 'days.'.$bid.'.'.$n,
                    'class'=>"form-control",
                    'placeholder'   => $benefitInput['name'],
                ]
            ])
        @endforeach

    </div>

    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-6">
        <button type="submit" class="btn btn-primary col-span-2" wire:click="">Add Rotation</button>
        <button type="submit" class="btn btn-info col-span-2" wire:click="save()">Save</button>
    </div>

</div>
