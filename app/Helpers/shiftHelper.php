<?php

if (!function_exists('parseShifts')) {

    function parseShifts($shiftGroups,$weekStart,$hourFormat) {

            $daysOfWeeks = ['Sunday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Monday'];
        if ($weekStart){
            $daysOfWeeks = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        }

        $result = [];
        foreach($daysOfWeeks as $dayOfWeek) {
            $shiftNumber = 1;
            foreach($shiftGroups as $shiftGroup) {
                foreach($shiftGroup['values'] as $shiftGroupValue) {
                        if ( ! $shiftGroupValue['days'][$dayOfWeek]) {
                            continue;
                        }

                        $startTime = \DateTime::createFromFormat( $hourFormat, $shiftGroupValue['start_time'])->format( 'H:i') ;
                        $endTime = \DateTime::createFromFormat( $hourFormat, $shiftGroupValue['end_time'])->format( 'H:i');


                        if ($startTime > $endTime){

                            //Old Shift until 12AM
                            $shiftDetails['name'] = $shiftGroup['name'];
                            $shiftDetails['shiftNumber'] = $shiftNumber;
                            $shiftDetails['startHour'] = $startTime;// \DateTime::createFromFormat( 'H:i A', $shiftGroupValue['start_time'])->format( 'H:i') ;
                            $shiftDetails['endHour'] = '00:00'; // \DateTime::createFromFormat( 'H:i A', $shiftGroupValue['end_time'])->format( 'H:i');

                            $shiftDetails['numberOfHours'] = hoursBetweenHours(
                                $startTime,
                                '00:00'
                            );
                            $result[$dayOfWeek][] = $shiftDetails;
                            //END OLD SHIFT UNTIL 12AM
                            //NEW SHIFT NEXT DAY
                            $shiftDetails['name'] = $shiftGroup['name'];
                            $shiftDetails['shiftNumber'] = $shiftNumber;
                            $shiftDetails['startHour'] = '00:00';// \DateTime::createFromFormat( 'H:i A', $shiftGroupValue['start_time'])->format( 'H:i') ;
                            $shiftDetails['endHour'] = $endTime; // \DateTime::createFromFormat( 'H:i A', $shiftGroupValue['end_time'])->format( 'H:i');

                            $shiftDetails['numberOfHours'] = hoursBetweenHours(
                                '00:00',
                                $endTime
                            );
                            $result[getNextDay($dayOfWeek)][] = $shiftDetails;
                            //END NEW SHIFT NEXT DAY
                        }else{
                            $shiftDetails['name'] = $shiftGroup['name'];
                            $shiftDetails['shiftNumber'] = $shiftNumber;
                            $shiftDetails['startHour'] =  $shiftGroupValue['start_time'] ;
                            $shiftDetails['endHour'] =  $shiftGroupValue['end_time'];

                            $shiftDetails['numberOfHours'] = hoursBetweenHours(
                                $startTime ,
                                $endTime
                            );
                            $result[$dayOfWeek][] = $shiftDetails;
                        }
                        $shiftNumber++;
                }
            }
        }

        foreach ($daysOfWeeks as $daysOfWeek){
            if(!isset( $result[$daysOfWeek])){
                continue;
            }
            $x = array_column($result[$daysOfWeek], 'startHour');

            array_multisort($x, SORT_ASC, $result[$daysOfWeek]);


        }

        foreach($result as $day => $shifts) {

                foreach($shifts as $index => $shift) {
                    if ( 0 === $index ) {
                        $strToTimeStart = strtotime($shifts[$index]['startHour']);
                        $strToTimeEnd = strtotime('00:00');

                        if ($strToTimeStart !== $strToTimeEnd) {

                            $hoursOverlap = ($strToTimeEnd - $strToTimeStart) / 60;

                            if ( $hoursOverlap < 0) {

                                $emptyShift['name'] = 'empty';
                                $emptyShift['startHour'] = '00:00';
                                $emptyShift['endHour'] = $shifts[$index]['startHour'];

                                $noOfH = hoursBetweenHours(
                                    '00:00',
                                    $shifts[$index]['startHour']

                                );
                                $emptyShift['numberOfHours'] =  ($noOfH < 0) ? $noOfH * -1: $noOfH;
                                $result[$day][] = $emptyShift;
                            }
                        }
                        continue;
                    }

                    $strToTimeStart = strtotime($shifts[$index]['startHour']);
                    $strToTimeEnd = strtotime($shifts[$index-1]['endHour']);

                    if ($strToTimeStart !== $strToTimeEnd) {

                        $hoursOverlap = ($strToTimeEnd - $strToTimeStart) / 60;

                        if ( $hoursOverlap < 0) {

                            $emptyShift['name'] = 'empty';
                            $emptyShift['startHour'] = $shifts[$index-1]['endHour'];
                            $emptyShift['endHour'] = $shifts[$index]['startHour'];

                            $noOfH = hoursBetweenHours(
                                $shifts[$index]['startHour'],
                                $shifts[$index-1]['endHour']
                            );
                            $emptyShift['numberOfHours'] =  ($noOfH < 0) ? $noOfH * -1: $noOfH;
                            $result[$day][] = $emptyShift;
                        } else if ($hoursOverlap > 0) {
                            $result[$day][$index]['overlaps'] = $hoursOverlap / 60;
                        }
                    }
                }
            $x = array_column($result[$day], 'startHour');
            array_multisort($x, SORT_ASC, $result[$day]);
        }


        return $result;

    }
}

if ( ! function_exists('hourExistsInInterval')) {
    function hourExistsInInterval($hour, $intervalArray) {
        foreach($intervalArray as $ar) {
            if ($ar === $hour) {
                return true;
            }
        }
        return false;
    }
}

if ( ! function_exists ( 'hoursBetweenHours') ) {
    function hoursBetweenHours($start, $end) {




        $diff = (strtotime($end) - strtotime($start)) / 3600;
        if ( "00:00" == $end) {
            $diff = ($diff < 0) ? -1  * $diff: $diff;
            return 24 - $diff;
        }
        return $diff;
    }
}

if ( ! function_exists ( 'convertHour') ) {
    function convertHour($hour,$hourFormat) {

        $dt = \DateTime::createFromFormat( $hourFormat, $hour);
        return $dt->format($hourFormat);
    }
}

if ( !function_exists('getNextDay')){
    function getNextDay($key) {
        switch ($key) {
            case "Monday":
                return "Tuesday";
            case "Tuesday":
                return "Wednesday";
            case "Wednesday":
                return "Thursday";
            case "Thursday":
                return "Friday";
            case "Friday" :
                return "Saturday";
            case "Saturday" :
                return "Sunday";
            case "Sunday" :
                return "Monday";

        }
    }
}


if ( ! function_exists ( 'shifts') ) {
     function shifts($entity,$days){

        if (!$entity->ShiftGroups->count()){
            return [
                [
                    'name' => "Day Shift",
                    'shift_group_id' => null,
                    'values'   => [
                        [
                            'schedule_id'   => null,
                            'start_time' => null,
                            'end_time' => null,
                            'days' => $days
                        ],
                    ],
                ],

            ];
        }

        $arr = array();


        foreach ($entity->shiftGroups as $shiftGroup){
            $values = array();
            foreach ($shiftGroup->Schedules as $schedule){

                $queryDays = [
                    'Monday' => $schedule->mon,
                    'Tuesday' =>  $schedule->tue,
                    'Wednesday' =>  $schedule->wed,
                    'Thursday' =>  $schedule->thu,
                    'Friday' =>  $schedule->fri,
                    'Saturday' =>  $schedule->sat,
                    'Sunday' =>  $schedule->sun,
                ];
                if (array_key_first($days) == 'Sunday'){
                    $queryDays = [
                        'Sunday' =>  $schedule->sun,
                        'Tuesday' =>  $schedule->tue,
                        'Wednesday' =>  $schedule->wed,
                        'Thursday' =>  $schedule->thu,
                        'Friday' =>  $schedule->fri,
                        'Saturday' =>  $schedule->sat,
                        'Monday' => $schedule->mon,
                    ];
                }


                $values[] = [
                    'start_time'    => $schedule->start_time,
                    'end_time'      => $schedule->end_time,
                    'schedule_id'   => $schedule->id,
                    'days' => $queryDays
                ];
            }
            $arr[]    = [
                'name'  => $shiftGroup->name,
                'shift_group_id' => $shiftGroup->id,
                'values'    => $values
            ];

        }
        return $arr;
    }
}
