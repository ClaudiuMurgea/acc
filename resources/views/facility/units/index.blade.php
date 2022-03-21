@extends('../layout/'.$layout)

@section('subhead')
    <title>{!! env('APP_NAME') !!}</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3">
                <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 xl:col-start-1 xl:row-start-2 2xl:col-start-auto 2xl:row-start-auto mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Schedules</h2>
                        <a href="" class="ml-auto text-primary truncate flex items-center">
                            <i data-feather="plus" class="w-4 h-4 mr-1"></i> Add New Schedules
                        </a>
                    </div>
                    <div class="mt-5">
                        <livewire:facility.units.facility-units-component :facilityId=1 />



                    </div>
                </div>
                <!-- END: Schedules -->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-6">

                    <!-- BEGIN: Recent Activities -->

                </div>
            </div>
        </div>
@endsection
