<?php

class EUCountriesListBuilder
{
	public static function getSelectList($language)
	{
		$array = [
			'Австрія' => 'Austria',
			'Бельгія' => 'Belgium',
			'Болгарія' => 'Bulgaria',
			'Греція' => 'Greece',
			'Данія' => 'Denmark',
			'Естонія' => 'Estonia',
			'Ірландія' => 'Ireland',
			'Іспанія' => 'Spain',
			'Італія' => 'Italy',
			'Кіпр' => 'Cyprus',
			'Латвія' => 'Latvia',
			'Литва' => 'Lithuania',
			'Люксембург' => 'Luxembourg',
			'Мальта' => 'Malta',
			'Нідерланди' => 'Netherlands',
			'Німеччина' => 'Germany',
			'Польща' => 'Poland',
			'Португалія' => 'Portugal',
			'Румунія' => 'Romania',
			'Словаччина' => 'Slovakia',
			'Словенія' => 'Slovenia',
			'Угорщина' => 'Hungary',
			'Фінляндія' => 'Finland',
			'Франція' => 'France',
			'Хорватія' => 'Croatia',
			'Чехія' => 'Czech Republic',
			'Швеція' => 'Sweden'
		];
		
		$result = '';
		
		if ($language == 'see_ua_val_en') {
			foreach ($array as $ua => $en) {
				$result .= '<option value="'.$en.'">' . $ua . '</option>';
			}
		}
		
		if ($language == 'see_en_val_ua') {
			foreach ($array as $ua => $en) {
				$result .= '<option value="'.$ua.'">' . $en . '</option>';
			}
		}
		
		if ($language == 'ua') {
			foreach ($array as $ua => $en) {
				$result .= '<option value="'.$ua.'">' . $ua . '</option>';
			}
		}
		
		if ($language == 'en') {
			foreach ($array as $ua => $en) {
				$result .= '<option value="'.$en.'">' . $en . '</option>';
			}
		}
		
		return $result;
	}
}


/*
USE:
$htmlOptions = EUCountriesListBuilder::getSelectList('see_ua_val_en');
$htmlSelect = '<select class="select_list_custom" id="select_list_eu_countries">' . $htmlOptions . '</select>';

RESULT:
<select class="select_list_custom" id="select_list_eu_countries">
	<option value="Austria">Австрія</option>
	<option value="Belgium">Бельгія</option>
	...
	<option value="Czech Republic">Чехія</option>
	<option value="Sweden">Швеція</option>
</select>
*/
