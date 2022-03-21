<div class="intro-y col-span-6 overflow-auto lg:overflow-visible">
    <table class="table table-report -mt-2">
        <tbody>
        @foreach($facility->Units as $unit)
            <tr class="intro-x">
                <td class="w-10">
                    <div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <div class=" rounded-full" style="background-color: {{ $unit->color }};height: 100%"></div>
                        </div>

                    </div>
                </td>
                <td>
                    <a href="#" class="font-medium whitespace-nowrap">{!! $unit->name !!}</a>
                </td>
                <td class="table-report__action w-20">
                    <div class="flex items-center">
                        <a class="flex items-center mr-3 text-warning" href="#"  wire:click="$emitUp('show','showEdit',{!! $unit->id !!})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Edit
                        </a>
                        <a class="flex items-center mr-3 text-primary" href="{{ route('facility.planner', $unit->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Planner
                        </a>
                        <a class="flex items-center mr-3 text-success" href="{{ route('facility.schedule', $unit->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Assignment
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mb-2">
    <a href="#" wire:click="show('showCreate')" class="btn btn-primary shadow-md mr-2" >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="plus" class="lucide lucide-plus w-4 h-4" data-lucide="plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        {!! __('lang.add',['what' => 'Unit']) !!}
    </a>
</div>
