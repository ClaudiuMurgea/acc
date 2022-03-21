Livewire.on('initTime', () => {

    initTime()

})

function initTime(){
    console.log(timeFormat)
    $('input.timepicker').each(function() {
        $(this).timepicker({
            timeFormat: timeFormat,

            interval: 60,
            open: function () {
                if ($(this).hasClass("disabled") || $(this).attr("readonly")) {
                    $(this).timepicker("close");
                }
            },
            change: function(time,ev) {
                console.log(time)
                var element = $(this), text;
                // get access to this Timepicker instance
                var timepicker = element.timepicker();
                text = timepicker.format(time);
                Livewire.emit('setTime',$(this).attr('wire:model'),text)
                // @this.set($(this).attr('wire:model'), text);
            },
        });
    })

}
