Livewire.on('loadGlobalPicker', () => {
    registerDatePickers();
})

function registerDatePickers() {
    var datePickers = document.getElementsByClassName('datepicker');
    if (datePickers.length === 0) {
        return;
    }
    for(var i=0;i<datePickers.length; i++) {
        initializeLitepiscker(datePickers[i],datePickers[i].getAttribute('eventtoemit'),datePickers[i].getAttribute('currentmodel'))
    }

}

function initializeLitepiscker(element,eventName,model){
    let options = {
        autoApply: true,
        singleMode: false,
        numberOfColumns: 1,
        numberOfMonths: 1,
        showWeekNumbers: false,
        format: "MM/DD/YYYY",

        dropdowns: {
            minYear: element.getAttribute("min") != null ? new Date(element.getAttribute("min")).getFullYear() : new Date().getFullYear() ,
            maxYear:  element.getAttribute("max") != null ? new Date(element.getAttribute("max")).getFullYear() : new Date().getFullYear() + 2,
            months: true,
            years: true,
        },

    };
    if (element.dataset.singleMode) {
        options.singleMode = true;
        options.numberOfColumns = 1;
        options.numberOfMonths = 1;
    }

    if (element.dataset.format) {
        options.format = datePickers[i].dataset.format;
    }


    new Litepicker({
        element: element,
        ...options,
        setup: (picker, ) => {
            picker.on('selected', (date, ) => {
                Livewire.emit(eventName,date.format('MM/DD/YYYY'),model);
            });
        }
    });
}
