<div class="w-full">
    <h1 class="font-semibold w-20 mt-10">PTO Planner</h1>

    <div class="w-full flex mt-8 mx-0 px-0">

        <div class="mr-4 flex flex-col">
            <label for="action" class="font-normal">Absence Code</label>
            
            <datalist id="list">
                <option value="foo">
                <option value="bar">
            </datalist>
            
            <input  type="text" list="list" maxlength="50" autocomplete="off" spellcheck="off" placeholder="Birthday(BDY)"
                    class="text-xs border rounded border-gray-300 text-gray-300  mt-1"
                    name="bdy" 
            >
        </div>

        <div class="mr-4 flex flex-col">
            <label for="action" class="font-normal">Action</label>
            <datalist id="list">
                <option value="foo">
                <option value="bar">
            </datalist>

            <input  type="text" list="list"  maxlength="50" autocomplete="off" spellcheck="off" placeholder="Add PTO"
                    class="text-xs border rounded border-gray-300 text-gray-300 mt-1" 
                    name="action"
            >
        </div>

        <div class="grid grid-cols-1 row-span-2 mr-6">
            <div class="row-start-1">
            </div>
            <button class="row-start-2 w-24 text-xs bg-orange-500 text-white rounded">Edit Planner</button>
        </div>

        <div class="grid grid-cols-1 row-span-2">
            <div class="row-start-1">
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span class="ml-1 underline font-normal">Edit Absence Codes</span>   
            </div>
        </div>

        {{-- Month Switcher --}}
        <div class="grid row-span-2 justify-end right-0 absolute mr-14 movedown">
            <div class="flex items-center input-group">
                <div class="flex items-center input-group">

                    <div class="input-group-append" wire:click="prevDate">
                        <div id="whitebackground1" style="height:50px" class="input-group-text rounded-l-md" data-toggle="tooltip" data-placement="left" title="Previous">
                            <div class="arrow-left mt-2.5"></div>
                        </div>
                    </div>

                    <input class="p-3 text-center text-blue-500 font-bold" type="month" id="datepicker" name="start"min="2018-03" value="2022-12">

                    <div class="input-group-append">
                        <div id="whitebackground2" style="height:50px" class="input-group-text rounded-r-md bg-white" data-toggle="tooltip" data-placement="right" title="Next">
                            <div class="arrow-right mt-2.5"></div>
                        </div>
                    </div>
                </div>   
            </div>   
        </div>   
    </div>

    {{-- Table Starts --}}
    <table class="w-full bg-white">
        <div class="wide mt-4">
        <thead class="w-full">
            <tr class="text-xs">
                <th colspan="1" class="font-semibold text-left border-r-2 border-gray-300 pb-2  pl-5 pr-16">EPLOYEES</th>
                <th colspan="1" class="text-white tinysize border-t greencolor p-0 md:px-0.5 xl:px-1 2xl:px-2">Week2</th>
                @for($i = 1; $i <= $monthTotalDays; $i++)
                    @if ($i % 7 == 0 && $i )
                        <th colspan="7" class="w-3/12 text-center tinysize2 border-t  @if($i % 14 == 0) text-white greencolor @endif "> 
                            Week @if($i % 14 == 0) 2 @else 1 @endif
                        </th>
                    @endif
                @endfor
                <th colspan="2" class="text-center tinysize border-t  md:px-0.5 xl:px-1 2xl:px-2">Week1</th>
            </tr>
        </thead>

        <tbody>
            <tr class="w-full">
                <td class="text-xs text-left font-semibold border-r-2 border-gray-300 pl-5">
                    <span class="flex flex-row">
                    NAME
                    <span class="flex flex-col space-y-0.5 translate-y-0.5 ml-1">
                        <div class="triangle-up"></div>
                        <div class="triangle-down"></div>
                    </span>
                    </span>
                </td>
                @for($i = 1; $i <= $monthTotalDays; $i++)
                    <td class="w-fit border">
                        <div class="flex flex-col tinysize font-medium">
                            @if ($i !== 30 || $i !== 31)
                                <div class="tinysize translate-y-2">DEC</div>
                                <div>{{ $i }}</div>
                            @else
                                <div class="tinysize translate-y-2">DEC</div>
                                <div>{{ $i }}</div>
                            @endif
                        </div>
                    </td>  
                @endfor
            </tr>

            <tr>
                <td class="text-xs text-left font-semibold text-blue-400 border-r-2 border-gray-300 pl-5">Torres, Henry</td>
                @for($i = 1; $i <= $monthTotalDays; $i++)
                    @if($pto == false)
                        <td class=" border
                                    md:h-6 
                                    xl:h-8 
                                    2xl:h-10   
                                    @if(in_array($i ,$dayOff)) graycolor @endif"
                        >
                            <div class="flex flex-col font-medium">
                                <div></div>
                            </div>
                        </td>  
                    @else
                        <td class=" border
                                    md:h-6 
                                    xl:h-8 
                                    2xl:h-10"
                        >
                            <div class='flex items-center justify-center'>
                                <button class=" tinysize font-bold 
                                                border border-blue-700 rounded py-1 px-2 
                                                md:px-0
                                                xl:px-1
                                                2xl:px-2" 
                                        title="Personal Time Off"
                                >
                                    PTO
                                </button>
                            </div>
                        </td>
                    @endif
                @endfor
            </tr>
        </tbody>
    </table>
    
    <script>
    $( "#datepicker" ).datepicker();

    $("#prev").click(function(){
        var date = $('#datepicker').datepicker('getDate', '-1d'); 
        date.setDate(date.getDate()-1); 
        $('#datepicker').datepicker('setDate', date);
    })

    $("#next").click(function(){
            var date = $('#datepicker').datepicker('getDate', '+1d'); 
        date.setDate(date.getDate()+1); 
        $('#datepicker').datepicker('setDate', date);
    })
    </script>
</div>
