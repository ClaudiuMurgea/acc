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
                        {{--FARA ASTA--}}
                        <x-color-picker wire:model="color"/>
                        @error('color')
                        <div class="pristine-error text-danger mt-2">
                            <small>
                                {{$message}}
                            </small>
                        </div>
                        @enderror
                        {{--FARA ASTA --}}
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

                    <button wire:click="$emitUp('show','showList')" class="btn btn-default mt-5">Cancel</button>
                    <button wire:click="save" class="btn btn-primary mt-5 ml-5">Save Unit</button>



            </div>
        </div>
        <!-- END: Vertical Form -->

    </div>

