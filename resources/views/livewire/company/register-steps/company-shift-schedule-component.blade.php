<div wire:ignore>
    @include('company.steps.stepsCounter',['data' => $data])
    {{--@dd($days)--}}


    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 p-2 py-4 ">
        <div class="flex flex-col sm:flex-row items-center ">
            <h2 class="font-medium text-base mr-auto"> {!! __('lang.standard_shift_schedule') !!}</h2>

        </div>

        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Basic Table -->
            <div class="rounded shadow">
                <div class=" m-auto mt-6">

                    <table class="w-full  table-collapse max-w-full">
                        <thead class="border-b-2">
                        <tr>
                            <th class="whitespace-nowrap w-1 p-5">Day</th>
                            <th id="tableWidth">
                                @for($i=0; $i<=23;$i++)
                                    <div class="shift cellHeader p-2" style="background-color: #ccc;">
                                        {{($i == 0 || $i == 12) ? ('12'. $i < 12 ? '12am' : '12pm') : ($i < 12 ? $i.'am' : ($i%12).'pm') }}
                                    </div>
                                @endfor
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($days as $day => $shifts)
                            <tr class="border-b-2 py-4">
                                <td class="px-0 text-center py-4" style="min-width: 120px">
                                    {{$day}}
                                </td>
                                <td >
                                    @foreach($shifts as $key => $shift)
                                        <div class="shift cell
                            @if(isset($shift['overlaps'])) overlap{{$shift['overlaps']}} @endif
                                        @if (($shift['name'] == 'empty')) empty-bg  @else background-{!! $shift['shiftNumber'] !!} @endif
                                            "
                                             data-o="{!! isset($shift['overlaps']) ? $shift['overlaps'] :'' !!}"
                                             data-h="{{$shift['numberOfHours']}}"
                                        >

                                            @if($shift['name'] !== "empty")

                                                {{$shift['startHour'] . ' - ' . $shift['endHour']}} | {{$shift['name']}}
                                            @endif
                                        </div>

                                    @endforeach
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Basic Table -->


        </div>


        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            @include('forms.buttons',[
                        'parentDiv' => 'intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5',
                        'buttons'   =>[
                                         [
                                              'label'      => 'Prev',
                                              'options'   =>[
                                                      'wire:click'  => '$emit("changeStep",5)',
                                                      'class'=>"btn btn-default w-24 ml-2",
                                                 ]
                                        ],
                                     [
                                          'label'      => 'Next',

                                          'options'   =>[
                                              'wire:click'  => "save()",
                                              'class'=>"btn btn-primary w-24 ml-2",

                                          ]
                                      ]
                            ]
                      ])

        </div>
    </div>


</div>
<script>


    let box = document.getElementById('tableWidth') ;

    let tdWidth = (box.offsetWidth - 20) / 24

    console.log("Full width" + box.offsetWidth)
    console.log("UNIT " + tdWidth)

    let cells = document.getElementsByClassName('cell')
    for (let cell of cells) {
        var style='';

        style += 'width:'+ tdWidth * cell.getAttribute('data-h')+'px;';
        let overlap = cell.getAttribute('data-o');

        if(overlap > 0){
            style += 'margin-left:-'+ tdWidth * cell.getAttribute('data-o')+'px;';
            style += 'opacity: 0.9;'
        }
        cell.setAttribute('style',style)

    }
    let cellHeaders = document.getElementsByClassName('cellHeader')
    for (let headerCell of cellHeaders) {
        var style='';

        style += 'width:'+ tdWidth +'px;';




        headerCell.setAttribute('style',style)

    }




</script>

<style>

    table {
        padding:0px;
    }

    .shift {
        display:block;
        border-radius: 5px;
        float:left;
        height:40px;
        padding: 10px;
        text-align: start;
        font-size: 0.8rem;
    }

    .magenta{
        background-color: magenta;

    }

    .lime {
        background-color: lime;

    }

    .empty {
        border-inline:1px solid #ccc;
        color: #ccc;
        opacity:0.7;
    }

    .background-1 {
        background-color: #DBECFE;
        border:1px solid #37AEFF;
    }

    .background-2 {
        background-color: #FFDBE7;
        border: 1px solid #FF37B4;
    }

    .background-3 {
        background-color: #F8DBFF;
        border: 1px solid #9737FF;

    }
    .background-4 {
        background-color: rgb(197, 255, 68);
        border: 1px solid #91C713;
    }
    .background-5 {
        background-color: #ffe896;
        border: 1px solid #FBC500;
    }
    .background-6 {
        background-color: #ff9898;
        border: 1px solid #D32929;
    }

    .empty-bg {
        background-color: #fff;
    }

</style>
</div>

