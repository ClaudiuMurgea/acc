@if($sortable)
    <script src="/dist/js/livewire-sortable.js"></script>
@endif

<script src="/dist/js/dayjs.min.js"></script>

<script type="module" src="/dist/js/datePickerInitLivewire.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/select2/select2.full.min.js')}}" defer></script>

<script>
    Livewire.on('shiftSelected', shiftGroupId => {
        let clicked = document.querySelector('#shift-' + shiftGroupId);


        clicked.classList.add('border-1', 'border-primary', 'text-gray-700')
        /* console.log("shasfsadf" + shiftGroupId)*/
    })



    Livewire.on('reinitSelect2', function (){


        $('.select2').each(function() {

            $(this).select2({
                theme: "bootstrap",
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select '+this.getAttribute('label')
                },


            })

            $(this).on('change',function (e){

                Livewire.emit($(this).attr('functionToEmit'),$(this).select2("val"),$(this).attr('wire:model'))
            });
        })
    });





</script>
