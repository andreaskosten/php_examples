<?php

/**
 * Реализую так, что сам факт создания объекта этого класса ( $exit = Exiter(params...); ) будет приводить к выходу из сценария:
 * 1) если $status == 1 - добавляем к финальному массиву переданный в конструктор массив
 * 2) если $status == 0 - просто выход с описанием ошибки
 */

class Exiter
{
    public function __construct($status, $description, $array = [])
    {
        $finalArray = [];
        if (!empty($array)) {
            $finalArray = $array;
        }

        if ($status == 0 || $status == 1) {
            $finalArray['status'] = $status;
            $finalArray['description'] = $description;
        } else {
            exit('ERROR, status is incorrect in __construct of Exiter');
        }

        exit(json_encode($finalArray));
    }
}


/*
1. пример "хорошего" выхода:
$exitData['color_1'] = 'blue';
$exitData['color_2'] = 'yellow';
$exit = new Exiter(1, 'colors_extracted', $exitData);
// >> {"color_1":"blue","color_2":"yellow","status":1,"description":"colors_extracted"}

2. пример "плохого" выхода:
$exit = new Exiter(0, 'database_error');
// >> {"status":0,"description":"database_error"}
*/
