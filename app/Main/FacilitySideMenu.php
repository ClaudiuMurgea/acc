<?php

namespace App\Main;

use App\Models\Facility;

class FacilitySideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function menu($parameters)
    {
        return [
           /* 'company_dashboard' => [
                'icon' => 'fa-solid fa-house-chimney',
                'title' => 'Company Dashboard',
                'can_see'   => 'Company Admin',
                'route_name' => 'company.dashboard',
                'params' => [
                    Facility::find($parameters['facility'])->company_id
                ],
            ],*/
            'dashboard' => [
                'icon' => 'fa-solid fa-building',
                'title' => 'Facility Dashboard',
                'route_name' => 'facility.dashboard',
                'params' => [
                    $parameters['facility'] ?? ''
                ],


            ],

            'configuration' => [
                'icon' => 'fa-solid fa-gear',
                'title' => 'Configuration',
                'sub_menu' => [
                    'facility-units' => [
                        'icon' => '',
                        'route_name' => 'facility.units',
                        'params' => [
                            $parameters['facility'] ?? ''
                        ],
                        'title' => 'Facility Units'
                    ],
                    'facility-departments' => [
                        'icon' => '',
                        'route_name' => 'facility.departments',
                        'params' => [
                            $parameters['facility'] ?? ''
                        ],
                        'title' => 'Facility Departments'
                    ],

                ]
            ],

            'devider',

        ];
    }
}
