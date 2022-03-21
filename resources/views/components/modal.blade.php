<div x-data="{ show: @entangle($attributes->wire('model')) }" x-cloak>

    <div  x-show="show"
          x-on:keydown.escape.window="show = false"

          id="header-footer-modal-preview" class="modal overflow-y-auto show " tabindex="-1" aria-hidden="true" style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 10000;position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            z-index:1000;">
        <div class="modal-dialog modal-xl">

            <div class="modal-content">

                <!-- BEGIN: Modal Header -->
                {!! $slot !!}
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>



</div>

