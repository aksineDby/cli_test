<?php

// 1 2 3 4 same hello world true false
$main_array = ['vasya', 'pupkin', 'apple', 23, 41, 55, 1, 2, true];
$nextLine = PHP_EOL;

// var_export($argv);
const BOOLEANS_AS_SRING = ['true' => true, 'false' => false];

$sendedArguments = [];
$sendedIntegerValues = [];
foreach ($argv as $k => $value) {
    if ($k === 0) continue;
    $lowerValue = strtolower($value);

    if (isset(BOOLEANS_AS_SRING[$lowerValue])) $value = BOOLEANS_AS_SRING[$lowerValue];
    elseif (is_numeric($value)) {
        $value = (int) $value;
        /* step 7 */
        $sendedIntegerValues[] = $value;
    }

    $sendedArguments[] = $value;
}

function echoLog($value) {
    echo $value . PHP_EOL; 
};

/* 1) Убедиться что в $main_array нету булевского значение true */
echoLog('Step 1. Predefined values has true?');
$booleanTrueIsExists = false;
array_walk($main_array, function($v) use (&$booleanTrueIsExists) {
    if ($v === true) $booleanTrueIsExists = true;
});
echoLog($booleanTrueIsExists ? 'Yes' : 'No');

/* 2) Убедиться что во входящих параметрах есть булевского значение true (если оно было введено) */
echoLog('Step 2. Passed values has true?');
$booleanTrueIsExists = false;
array_walk($main_array, function($v) use (&$booleanTrueIsExists) {
    if ($v === true) $booleanTrueIsExists = true;
});
echoLog($booleanTrueIsExists ? 'Yes' : 'No');
unset($booleanTrueIsExists);

/* 3) Объединить массив и входящие параметры */
echoLog('Step 3. All values:');
echoLog(var_export(array_merge($main_array, $sendedArguments),1));

/* 4) Определить каких данных нету в $main_array но они есть во входящих параметрах */
echoLog('Step 4. Unique passed values:');
echoLog(var_export(array_diff($sendedArguments, $main_array),1));

/* 5) Определить какие данные есть в $main_array и во входящих параметрах */
echoLog('Step 5. Intersecting values:');
echoLog(var_export(array_intersect($main_array, $sendedArguments),1));

/* 6) Все строковые значения в $main_array перевести в верхний регистр символов */
echoLog('Step 6. New values of $main_array');
array_walk($main_array, function(&$v){
    if (is_string($v)) $v = strtoupper($v);
});
echoLog(var_export($main_array,1));

/* 7) Получить массив чисел из входящих параметров если были введены цифры */
echoLog('Step 7. Sended integer values:');
echoLog(var_export($sendedIntegerValues,1));

/* 8) Отсортировать $main_array таким образом чтобы цифры стали первыми элементами массива */
echoLog('Step 8. Sorted $main_array:');
usort($main_array, function($a, $b){
    if ((!is_int($a) && !is_int($b)) || (is_int($a) && is_int($a))) return 0;
    elseif (is_int($a) && !is_int($b)) return -1;
    elseif (!is_int($a) && is_int($b)) return 1;
    else throw new Exception('wow, its magic');
});
echoLog(var_export($main_array,1));
