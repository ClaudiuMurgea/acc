<div class="intro-y col-span-12 lg:col-span-6">
    <!-- BEGIN: Vertical Form -->
    <div class="intro-y box">
        <div id="vertical-form" class="p-5">

            <div>
                @include('forms.input',[
                   'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                   'label'     =>  __('lang.what_name',['what' => __('lang.unit')]) ,
                   'type'  => 'text',
                   'name'  => 'name',
                   'value' => null ,
                   'options'   =>[
                               'wire:model.defer'  => "name",
                               'class'=>"form-control",
                               'placeholder'   => ''
                        ]
                    ])
            </div>

            <div>
                <x-color-picker wire:model="color" :color="$color"/>
                @error('color')
                <div class="pristine-error text-danger mt-2">
                    <small>
                        {{$message}}
                    </small>
                </div>
                @enderror

            </div>

            <div>
                @include('forms.input',[
                   'parentDiv' => 'intro-y col-span-12 sm:col-span-6',
                   'label'     =>  __('lang.what_description',['what' => __('lang.unit')]) ,
                   'type'  => 'text',
                   'name'  => 'description',
                   'value' => null ,
                   'options'   =>[
                               'wire:model.defer'  => "description",
                               'class'=>"form-control",
                               'placeholder'   => ''
                        ]
                    ])
            </div>

            <button wire:click="$emitUp('show','showList')" class="btn btn-default mt-5">{!! __('lang.cancel') !!}</button>
            <button wire:click="edit" class="btn btn-primary mt-5 ml-5">{!! __('lang.update') !!}</button>

            <button wire:click="delete({!! $unit->id !!})" class="btn btn-danger mt-5 ml-5 float-right">{!! __('lang.delete') !!}</button>


        </div>
    </div>
    <!-- END: Vertical Form -->

</div>

