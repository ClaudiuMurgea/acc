<div class="intro-y col-span-12 lg:col-span-6">
    <!-- BEGIN: Single Item -->
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5  bg-primary text-white">
            <h2 class="font-medium text-base mr-auto">{!! $title !!}</h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto  sm:mt-0">


                @if($showModal)
                <a class="text-primary btn btn-sm  bg-white hover:bg-white w-24 inline-block "  x-data="{companyId : 1}" x-on:click="window.livewire.emitTo('modals.holiday-modal','show',{!! $companyId !!})"  href="#" >{!! __('lang.add',['what' => 'Holiday']) !!}</a>
                @endif
            </div>
        </div>
        <div class="p-5" wire:key="{!! 'table'.$title !!}">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Date</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Holiday</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-right">Subscribe</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($holidays as $holiday)
                            <tr>
                                <td class="border-b whitespace-nowrap">{!! \Carbon\Carbon::parse($holiday->date)->format(env('DATE_FORMAT')) !!}</td>
                                <td class="border-b whitespace-nowrap">{!! $holiday->label !!}</td>
                                <td class="border-b whitespace-nowrap text-right">
                                    @include('forms.switch',[
                                           'value' => 1 ,
                                           'parentDiv' => 'form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0 float-right',
                                           'name' => 'checkbox',
                                           'options'   =>[
                                               'wire:click'  => "subscribeHoliday($holiday->id)",
                                               'class'=>"form-check-input mr-0 ml-3",
                                               'wire:key'       => random_int(1,125555555555),
                                               'checked'    => in_array($holiday->id,$subscribedHolidays) ? true : false,
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
