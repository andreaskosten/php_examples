/*
DEMO:
echo '<br>' . getMonthName('07', 'full', 'ua'); // липня
echo '<br>' . getMonthName('07', 'full', 'ru'); // июля
echo '<br>' . getMonthName('07', 'full', 'en'); // July
echo '<br>';
echo '<br>' . getMonthName('07', 'short', 'ua'); // лип
echo '<br>' . getMonthName('07', 'short', 'ru'); // июл
echo '<br>' . getMonthName('07', 'short', 'en'); // Jul
echo '<br>';
echo '<br>' . getMonthName('07.', 'short', 'en'); // error
echo '<br>';
echo '<br>' . getMonthName('07', 'LONG', 'en'); // error_arr
*/

function getMonthName(string $monthSign, string $mode, string $lang='ua'): string
{
    if ($mode === 'full') {
        if ($lang === 'ua') {
            $arrayMonth = [
                '01' => 'січня',
                '02' => 'лютого',
                '03' => 'березня',
                '04' => 'квітня',
                '05' => 'травня',
                '06' => 'червня',
                '07' => 'липня',
                '08' => 'серпня',
                '09' => 'вересня',
                '10' => 'жовтня',
                '11' => 'листопада',
                '12' => 'грудня'
            ];
        } elseif ($lang === 'ru') {
            $arrayMonth = [
                '01' => 'января',
                '02' => 'февраля',
                '03' => 'марта',
                '04' => 'апреля',
                '05' => 'мая',
                '06' => 'июня',
                '07' => 'июля',
                '08' => 'августа',
                '09' => 'сентября',
                '10' => 'октября',
                '11' => 'ноября',
                '12' => 'декабря'
            ];
        } elseif ($lang === 'en') {
            $arrayMonth = [
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December'
            ];
        }
    }
    
    elseif ($mode === 'short') {
        if ($lang === 'ua') {
            $arrayMonth = [
                '01' => 'січ',
                '02' => 'лют',
                '03' => 'бер',
                '04' => 'кві',
                '05' => 'тра',
                '06' => 'чер',
                '07' => 'лип',
                '08' => 'сер',
                '09' => 'вер',
                '10' => 'жов',
                '11' => 'лис',
                '12' => 'гру'
            ];
        } elseif ($lang === 'ru') {
            $arrayMonth = [
                '01' => 'янв',
                '02' => 'фев',
                '03' => 'мар',
                '04' => 'апр',
                '05' => 'мая',
                '06' => 'июн',
                '07' => 'июл',
                '08' => 'авг',
                '09' => 'сен',
                '10' => 'окт',
                '11' => 'ноя',
                '12' => 'дек'
            ];
        } elseif ($lang === 'en') {
            $arrayMonth = [
                '01' => 'Jan',
                '02' => 'Febr',
                '03' => 'Mar',
                '04' => 'Apr',
                '05' => 'May',
                '06' => 'Jun',
                '07' => 'Jul',
                '08' => 'Aug',
                '09' => 'Sep',
                '10' => 'Oct',
                '11' => 'Nov',
                '12' => 'Dec'
            ];
        }
    }
    
    if (empty($arrayMonth)) {
        return 'error_arr';
    }
    
    if (array_key_exists($monthSign, $arrayMonth)) {
        return $arrayMonth[$monthSign];
    } else {
        return 'error';
    }
}
