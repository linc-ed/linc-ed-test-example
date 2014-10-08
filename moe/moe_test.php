<?php



class MOECodes {

	
		//static variable adds all moe fields as key=‘Field Name from Ministry’, value =‘Field name used in db.
	public static $fieldList = array(
				
				'9' =>  'first_schooling',
				'10' =>  'ethnic_origin',
				'11' =>  'ethnic_origin2', 
				'12' =>  'ethnic_origin3',  
				'16' =>  'ORS and Section 9', 
				'17' =>  'funding_year_level',  
				'18' =>  'TYPE',  
				'19' =>  'previous_school', 
				'20' =>  'zoning',  
				'21' =>  'citizenship', 
				'22' =>  'FEE', 
				'23' =>  'FTE', 
				'24' =>  'MAORI',  
				'26' =>  'NQF QUAL',  
				'27' =>  'REASON', 
				'28' =>  'ECE',  
				'29' =>  'PACIFIC MEDIUM -LANGUAGE', 
				'30' =>  'PACIFIC MEDIUM - LEVEL',  
				'31' =>  'SUBJECT 1',  
				'32' =>  'MODE OF INSTRUCTION SUBJECT 1',  
				'33' =>  'HOURS PER YEAR SUBJECT 1',  
				'34' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 1',  
				'35' =>  'SUBJECT 2',  
				'36' =>  'MODE OF INSTRUCTION SUBJECT 2',  
				'37' =>  'HOURS PER YEAR SUBJECT 2',  
				'38' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 2', 
				'39' =>  'SUBJECT 3',  
				'40' =>  'MODE OF INSTRUCTION SUBJECT 3',  
				'41' =>  'HOURS PER YEAR SUBJECT 3',  
				'42' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 3',  
				'43' =>  'SUBJECT 4',  
				'44' =>  'MODE OF INSTRUCTION SUBJECT 4',  
				'45' =>  'HOURS PER YEAR SUBJECT 4',  
				'46' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 4',  
				'47' =>  'SUBJECT 5',  
				'48' =>  'MODE OF INSTRUCTION SUBJECT 5', 
				'49' =>  'HOURS PER YEAR SUBJECT 5',  
				'50' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 5',  
				'51' =>  'SUBJECT 6',  
				'52' =>  'MODE OF INSTRUCTION SUBJECT 6', 
				'53' =>  'HOURS PER YEAR SUBJECT 6',  
				'54' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 6',  
				'55' =>  'SUBJECT 7',  
				'56' =>  'MODE OF INSTRUCTION SUBJECT 7',  
				'57' =>  'HOURS PER YEAR SUBJECT 7', 
				'58' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 7', 
				'59' =>  'SUBJECT 8',  
				'60' =>  'MODE OF INSTRUCTION SUBJECT 8',  
				'61' =>  'HOURS PER YEAR SUBJECT 8', 
				'62' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 8',  
				'63' =>  'SUBJECT 9',  
				'64' =>  'MODE OF INSTRUCTION SUBJECT 9',  
				'65' =>  'HOURS PER YEAR SUBJECT 9',  
				'66' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 9', 
				'67' =>  'SUBJECT 10', 
				'68' =>  'MODE OF INSTRUCTION SUBJECT 10',  
				'69' =>  'HOURS PER YEAR SUBJECT 10', 
				'70' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 10',  
				'71' =>  'SUBJECT 11', 
				'72' =>  'MODE OF INSTRUCTION SUBJECT 11',  
				'73' =>  'HOURS PER YEAR SUBJECT 11', 
				'74' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 11',  
				'75' =>  'SUBJECT 12',  
				'76' =>  'MODE OF INSTRUCTION SUBJECT 12',  
				'77' =>  'HOURS PER YEAR SUBJECT 12', 
				'78' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 12',  
				'79' =>  'SUBJECT 13',  
				'80' =>  'MODE OF INSTRUCTION SUBJECT 13',  
				'81' =>  'HOURS PER YEAR SUBJECT 13',  
				'82' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 13',  
				'83' =>  'SUBJECT 14', 
				'84' =>  'MODE OF INSTRUCTION SUBJECT 14',  
				'85' =>  'HOURS PER YEAR SUBJECT 14', 
				'86' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 14',  
				'87' =>  'SUBJECT 15',  
				'88' =>  'MODE OF INSTRUCTION SUBJECT 15',  
				'89' =>  'HOURS PER YEAR SUBJECT 15', 
				'90' =>  'INSTRUCTIONAL YEAR LEVEL SUBJECT 15', 
				'91' =>  'TUITION WEEKS',  
				'92' =>  'NON-NQF QUAL',  
				'93' =>  'UE',  
				'94' =>  'EXCHANGE SCHEME',  
				'95' =>  'BOARDING STATUS',  
				'96' =>  'Address1', 
				'97' =>  'Address2', 
				'98' =>  'Address3', 
				'99' =>  'Address4', 
				'100' =>  'ELIGIBILITY CRITERIA', 
				'101' =>  'VERIFICATION DOCUMENT', 
				'102' =>  'SERIAL NUMBER',  
				'103' =>  'current_year_level', 
				'104' =>  'POST-SCHOOL ACTIVITY',  
				'106' =>  'middle_name',  
				'107' =>  'preferred_name', 
				'108' =>  'preferred_last_name', 
				'109' =>  'EXPIRY DATE', 
				'110' =>  'STP', 
				'111' =>  'WITHHOLD CONTACT DETAILS',
				'112' =>  'Phone',  
				'113' =>  'mobile_phone',  
				'114' =>  'ALTERNATIVE PHONE NUMBER', 
				'115' =>  'email_address', 
				'116' =>  'contact_1_last_name', 
				'117' =>  'contact_1_first_name',  
				'118' =>  'contact_1_address1',  
				'119' =>  'contact_1_address2',  
				'120' =>  'contact_1_address3',  
				'121' =>  'contact_1_address4', 
				'122' =>  'contact_1_address5',  
				'123' =>  'contact_1_mobile',  
				'124' =>  'contact_2_last_name', 
				'125' =>  'contact_2_first_name',  
				'126' =>  'contact_2_address1', 
				'127' =>  'contact_2_address2',  
				'128' =>  'contact_2_address3',  
				'129' =>  'contact_2_address4', 
				'130' =>  'contact_2_address5', 
				'131' =>  'contact_2_mobile', 
				'2000' =>  'contact_1_type',  
				'2001' =>  'contact_2_type',  
				'2002' =>  'liveswith',  
				'2003' =>  'caregiver_comment',  
				'2004' =>  'access_arrangements',  
				'2005' =>  'digital_safety',  
				'2006' =>  'digital_comment',  
				'2007' =>  'trip_permission_term_1', 
				'2008' =>  'trip_permission_term_2',  
				'2009' =>  'emergency1_first',  
				'2010' =>  'emergency1_last', 
				'2011' =>  'emergency1_phone',  
				'2012' =>  'emergency1_mobile',  
				'2013' =>  'emergency2_first',  
				'2014' =>  'emergency2_last',  
				'2015' =>  'emergency2_phone',  
				'2016' =>  'emergency2_mobile',  
				'2017' =>  'medical_notes', 
				'2018' =>  'medical_condition',  
				'2019' =>  'medical_treatment',  
				'2020' =>  'allergy', 
				'2021' =>  'esol_number',  
				'2022' =>  'critical_info',  
				'2023' =>  'trip_permission_term_3',  
				'2024' =>  'trip_permission_term_4',  
				'2025' =>  'camp_permission',  
				'2026' =>  'swimming_permission',  
				'2027' =>  'contact_1_email', 
				'2028' =>  'contact_2_email', 
				'2029' =>  'religious_education',  
				'2030' =>  'trip_permission',  
				'2031' =>  'immunisations',  
				'2032' =>  'contact_3_email',  
				'2033' =>  'contact_3_first_name',  
				'2034' =>  'contact_3_last_name',  
				'2035' =>  'contact_3_type',  
				'2036' =>  'contact_3_address1',  
				'2037' =>  'contact_3_address2',  
				'2038' =>  'contact_3_address3',  
				'2039' =>  'contact_3_address4',  
				'2040' =>  'contact_3_address5',  
				'2041' =>  'contact_3_phone',  
				'2042' =>  'contact_3_mobile', 
				'2043' =>  'emergency1_comment',  
				'2044' =>  'emergency2_comment'
				);


	
public function countryCodes(){
	

$codes = array (
"AFG"=>"Afghanistan",
"ALB"=>"Albania",
"DZA"=>"Algeria",
"AND"=>"Andorra",
"AGO"=>"Angola",
"ATG"=>"Antigua and Barbuda",
"ARG"=>"Argentina",
"ARM"=>"Armenia",
"AUS"=>"Australia",
"AUT"=>"Austria",
"AZE"=>"Azerbaijan",
"BHS"=>"Bahamas",
"BHR"=>"Bahrain",
"BGD"=>"Bangladesh",
"BRB"=>"Barbados",
"BLR"=>"Belarus",
"BEL"=>"Belgium",
"BLZ"=>"Belize",
"BEN"=>"Benin",
"BTN"=>"Bhutan",
"BOL"=>"Bolivia, Plurinational State of",
"BIH"=>"Bosnia and Herzegovina",
"BWA"=>"Botswana",
"BRA"=>"Brazil",
"BRN"=>"Brunei Darussalam",
"BGR"=>"Bulgaria",
"BFA"=>"Burkina Faso",
"BDI"=>"Burundi",
"KHM"=>"Cambodia",
"CMR"=>"Cameroon",
"CAN"=>"Canada",
"CPV"=>"Cape Verde",
"CAF"=>"Central African Republic",
"TCD"=>"Chad",
"CHL"=>"Chile",
"CHN"=>"China",
"COL"=>"Colombia",
"COM"=>"Comoros",
"COG"=>"Congo",
"COD"=>"Congo, the Democratic Republic of the",
"CRI"=>"Costa Rica",
"CIV"=>"Côte d'Ivoire",
"HRV"=>"Croatia",
"CUB"=>"Cuba",
"CYP"=>"Cyprus",
"CZE"=>"Czech Republic",
"DNK"=>"Denmark",
"DJI"=>"Djibouti",
"DMA"=>"Dominica",
"DOM"=>"Dominican Republic",
"ECU"=>"Ecuador",
"EGY"=>"Egypt",
"SLV"=>"El Salvador",
"GNQ"=>"Equatorial Guinea",
"ERI"=>"Eritrea",
"EST"=>"Estonia",
"ETH"=>"Ethiopia",
"FJI"=>"Fiji",
"FIN"=>"Finland",
"FRA"=>"France",
"GAB"=>"Gabon",
"GMB"=>"Gambia",
"GEO"=>"Georgia",
"DEU"=>"Germany",
"GHA"=>"Ghana",
"GRC"=>"Greece",
"GRD"=>"Grenada",
"GTM"=>"Guatemala",
"GIN"=>"Guinea",
"GNB"=>"Guinea-Bissau",
"GUY"=>"Guyana",
"HTI"=>"Haiti",
"VAT"=>"Holy See (Vatican City State)",
"HND"=>"Honduras",
"HUN"=>"Hungary",
"ISL"=>"Iceland",
"IND"=>"India",
"IDN"=>"Indonesia",
"IRN"=>"Iran, Islamic Republic of",
"IRQ"=>"Iraq",
"IRL"=>"Ireland",
"ISR"=>"Israel",
"ITA"=>"Italy",
"JAM"=>"Jamaica",
"JPN"=>"Japan",
"JOR"=>"Jordan",
"KAZ"=>"Kazakhstan",
"KEN"=>"Kenya",
"KIR"=>"Kiribati",
"KOR"=>"Korea, Republic of",
"KWT"=>"Kuwait",
"KGZ"=>"Kyrgyzstan",
"LAO"=>"Lao People's Democratic Republic",
"LVA"=>"Latvia",
"LBN"=>"Lebanon",
"LSO"=>"Lesotho",
"LBR"=>"Liberia",
"LBY"=>"Libya",
"LIE"=>"Liechtenstein",
"LTU"=>"Lithuania",
"LUX"=>"Luxembourg",
"MKD"=>"Macedonia, The Former Yugoslav Republic of",
"MDG"=>"Madagascar",
"MWI"=>"Malawi",
"MYS"=>"Malaysia",
"MDV"=>"Maldives",
"MLI"=>"Mali",
"MLT"=>"Malta",
"MHL"=>"Marshall Islands",
"MRT"=>"Mauritania",
"MUS"=>"Mauritius",
"MEX"=>"Mexico",
"FSM"=>"Micronesia, Federated States of",
"MDA"=>"Moldova, Republic of",
"MCO"=>"Monaco",
"MNG"=>"Mongolia",
"MNE"=>"Montenegro",
"MAR"=>"Morocco",
"MOZ"=>"Mozambique",
"MMR"=>"Myanmar",
"NAM"=>"Namibia",
"NRU"=>"Nauru",
"NPL"=>"Nepal",
"NLD"=>"Netherlands",
"NZL"=>"New Zealand",
"NIC"=>"Nicaragua",
"NER"=>"Niger",
"NGA"=>"Nigeria",
"NOR"=>"Norway",
"OMN"=>"Oman",
"PAK"=>"Pakistan",
"PLW"=>"Palau",
"PSE"=>"Palestinian Territory, Occupied",
"PAN"=>"Panama",
"PNG"=>"Papua New Guinea",
"PRY"=>"Paraguay",
"PER"=>"Peru",
"PHL"=>"Philippines",
"POL"=>"Poland",
"PRT"=>"Portugal",
"QAT"=>"Qatar",
"ROU"=>"Romania",
"RUS"=>"Russian Federation",
"RWA"=>"Rwanda",
"KNA"=>"Saint Kitts and Nevis",
"LCA"=>"Saint Lucia",
"VCT"=>"Saint Vincent and the Grenadines",
"WSM"=>"Samoa",
"SMR"=>"San Marino",
"STP"=>"Sao Tome and Principe",
"SAU"=>"Saudi Arabia",
"SEN"=>"Senegal",
"SRB"=>"Serbia",
"SYC"=>"Seychelles",
"SLE"=>"Sierra Leone",
"SGP"=>"Singapore",
"SVK"=>"Slovakia",
"SVN"=>"Slovenia",
"SLB"=>"Solomon Islands",
"SOM"=>"Somalia",
"ZAF"=>"South Africa",
"SSD"=>"South Sudan",
"ESP"=>"Spain",
"LKA"=>"Sri Lanka",
"SDN"=>"Sudan",
"SUR"=>"Suriname",
"SWZ"=>"Swaziland",
"SWE"=>"Sweden",
"CHE"=>"Switzerland",
"SYR"=>"Syrian Arab Republic",
"TWN"=>"Taiwan, Province of China",
"TJK"=>"Tajikistan",
"TZA"=>"Tanzania, United Republic of",
"THA"=>"Thailand",
"TLS"=>"Timor-Leste",
"TGO"=>"Togo",
"TON"=>"Tonga",
"TTO"=>"Trinidad and Tobago",
"TUN"=>"Tunisia",
"TUR"=>"Turkey",
"TKM"=>"Turkmenistan",
"TUV"=>"Tuvalu",
"UGA"=>"Uganda",
"UKR"=>"Ukraine",
"ARE"=>"United Arab Emirates",
"GBR"=>"United Kingdom",
"USA"=>"United States",
"URY"=>"Uruguay",
"UZB"=>"Uzbekistan",
"VUT"=>"Vanuatu",
"VEN"=>"Venezuela, Bolivarian Republic of",
"VNM"=>"Viet Nam",
"ESH"=>"Western Sahara",
"YEM"=>"Yemen",
"ZMB"=>"Zambia",
"ZWE"=>"Zimbabwe",
);	

return $codes;
	
}

public function checkKey($value, $array){
	
	return array_key_exists($value, $array);
	
}

public function studentTypeArray(){
	
$code = array('FF'=>'FF', 'AE'=>'AE', 'EX'=>'EX', 'AD'=>'AD', 'RA'=>'RA', 'RE'=>'RE', 'EM'=>'EM', 'SA'=>'SA', 'NA'=>'NA', 'NF'=>'NF', 'SF'=>'SF', 'TPREOM'=>'TPREOM', 'TPRAOM'=>'TPRAOM', 'TPAD'=>'TPAD', 'TPRE'=>'TPRE', 'TPRAE'=>'TPRAE'	);

return $code;
}

public function ethnicityCodes($value=0){

$code = array('111'=>
'NZ European',
'121'=>
'British / Irish',
'122'=>
'Dutch',
'123'=>
'Greek',
'124'=>
'Polish',
'125'=>
'South Slav',
'126'=>
'Italian',
'127'=>
'German',
'128'=>
'Australian',
'129'=>
'Other European',
'211'=>
'NZ Maori',
'311'=>
'Samoan',
'321'=>
'Cook Islands Maori',
'331'=>
'Tongan',
'341'=>
'Niuean',
'351'=>
'Tokelauan',
'361'=>
'Fijian',
'371'=>
'Other Pacific Peoples',
'411'=>
'Filipino',
'412'=>
'Cambodian',
'413'=>
'Vietnamese',
'414'=>
'Other Southeast Asian',
'421'=>
'Chinese',
'431'=>
'Indian',
'441'=>
'Sri Lankan',
'442'=>
'Japanese',
'443'=>
'Korean',
'444'=>
'Other Asian',
'511'=>
'Middle Eastern',
'521'=>
'Latin American',
'531'=>
'African',
'611'=>
'Other ethnicity',
'999'=>
'Not stated');
	
	if ($value>0){	
	return array_search($value, $code);
}
else {
	return $code;	
}
}


public function iwi_codes(){

$iwi = array( '0100' =>'Te Tai Tokerau/Tāmaki-makaurau (Northland/Auckland) Region, not further defined',
'0101' =>'Te Aupōuri',
'0102' =>'Ngāti Kahu',
'0103' =>'Ngāti Kurī',
'0104' =>'Ngāpuhi',
'0105' =>'Ngāpuhi ki Whaingaroa-Ngāti Kahu ki Whaingaroa',
'0106' =>'Te Rarawa',
'0107' =>'Ngāi Takoto',
'0108' =>'Ngāti Wai',
'0109' =>'Ngāti Whātua',
'0110' =>'Te Kawerau',
'0111' =>'Te Uri-o-Hau',
'0112' =>'Te Roroa',
'0200' =>'Hauraki (Coromandel) Region, not further defined',
'0201' =>'Ngāti Hako',
'0202' =>'Ngāti Hei',
'0203' =>'Ngāti Maru (Marutuahu)',
'0204' =>'Ngāti Paoa',
'0205' =>'Patukirikiri',
'0206' =>'Ngāti Porou ki Harataunga ki Mataora',
'0207' =>'Ngāti Pūkenga ki Waiau',
'0208' =>'Ngāti Rāhiri Tumutumu',
'0209' =>'Ngāi Tai (Hauraki)',
'0210' =>'Ngāti Tamaterā',
'0211' =>'Ngāti Tara Tokanui',
'0212' =>'Ngāti Whanaunga',
'0300' =>'Waikato/Te Rohe Pōtae (Waikato/King Country) Region, not further defined',
'0301' =>'Ngāti Haua (Waikato)',
'0302' =>'Ngāti Maniapoto',
'0303' =>'Ngāti Raukawa (Waikato)',
'0304' =>'Waikato',
'0400' =>'Te Arawa/Taupō (Rotorua/Taupō) Region, not further defined',
'0401' =>'Ngāti Pikiao (Te Arawa)',
'0402' =>'Ngāti Rangiteaorere (Te Arawa)',
'0403' =>'Ngāti Rangitihi (Te Arawa)',
'0404' =>'Ngāti Rangiwewehi (Te Arawa)',
'0405' =>'Tapuika (Te Arawa)',
'0406' =>'Tarāwhai (Te Arawa)',
'0407' =>'Tūhourangi (Te Arawa)',
'0408' =>'Uenuku-Kōpako (Te Arawa)',
'0409' =>'Waitaha (Te Arawa)',
'0410' =>'Ngāti Whakaue (Te Arawa)',
'0411' =>'Ngāti Tūwharetoa',
'0412' =>'Ngāti Tahu-Ngāti Whaoa (Te Arawa)',
'0500' =>'Tauranga Moana/Mātaatua (Bay of Plenty) Region, not further defined',
'0501' =>'Ngāti Pūkenga',
'0502' =>'Ngaiterangi',
'0503' =>'Ngāti Ranginui',
'0504' =>'Ngāti Awa',
'0505' =>'Ngāti Manawa',
'0506' =>'Ngāi Tai (Tauranga Moana/Mātaatua)',
'0507' =>'Tūhoe',
'0508' =>'Whakatōhea',
'0509' =>'Te Whānau-a-Apanui',
'0510' =>'Ngāti Whare',
'0600' =>'Te Tai Rāwhiti (East Coast) Region, not further defined',
'0601' =>'Ngāti Porou',
'0602' =>'Te Aitanga-a-Māhaki',
'0603' =>'Rongowhakaata',
'0604' =>'Ngāi Tāmanuhiri',
'0700' =>'Te Matau-a-Māui/Wairarapa (Hawkes Bay/Wairarapa) Region, not further defined',
'0701' =>'Rongomaiwahine (Te Māhia)',
'0702' =>'Ngāti Kahungunu ki Te Wairoa',
'0703' =>'Ngāti Kahungunu ki Heretaunga',
'0704' =>'Ngāti Kahungunu ki Wairarapa',
'0705' =>'Ngāti Kahungunu, region unspecified',
'0706' =>'Rangitāne (Te Matau-a-Māui/Hawkes Bay/Wairarapa)',
'0707' =>'Ngāti Kahungunu ki Te Whanganui-a-Orotu',
'0708' =>'Ngāti Kahungunu ki Tamatea',
'0709' =>'Ngāti Kahungunu ki Tamakinui a Rua',
'0710' =>'Ngāti Pāhauwera',
'0711' =>'Ngāti Rākaipaaka',
'0800' =>'Taranaki (Taranaki) Region, not further defined',
'0801' =>'Te Atiawa (Taranaki)',
'0802' =>'Ngāti Maru (Taranaki)',
'0803' =>'Ngāti Mutunga (Taranaki)',
'0804' =>'Ngā Rauru',
'0805' =>'Ngā Ruahine',
'0806' =>'Ngāti Ruanui',
'0807' =>'Ngāti Tama (Taranaki)',
'0808' =>'Taranaki',
'0809' =>'Tangāhoe',
'0810' =>'Pakakohi',
'0900' =>'Whanganui/Rangitīkei (Wanganui/Rangitīkei) Region, not further defined',
'0901' =>'Ngāti Apa (Rangitīkei)',
'0902' =>'Te Ati Haunui-a-Pāpārangi',
'0903' =>'Ngāti Haua (Taumarunui)',
'0904' =>'Ngāti Hauiti',
'1000' =>'Manawatū/Horowhenua/Te Whanganui-a-Tara(Manawatū/Horowhenua/Wellington)Regionnfd',
'1001' =>'Te Atiawa (Te Whanganui-a-Tara/Wellington)',
'1002' =>'Muaūpoko',
'1003' =>'Rangitāne (Manawatū)',
'1004' =>'Ngāti Raukawa (Horowhenua/Manawatū)',
'1005' =>'Ngāti Toarangatira (Te Whanganui-a-Tara/Wellington)',
'1006' =>'Te Atiawa ki Whakarongotai',
'1007' =>'Ngāti Tama ki Te Upoko o Te Ika (Te Whanganui-a-Tara/Wellington)',
'1008' =>'Ngāti Kauwhata ',
'1100' =>'Te Waipounamu/Wharekauri (South Island/Chatham Islands) Region, nfd',
'1101' =>'Te Atiawa (Te Waipounamu/South Island)',
'1102' =>'Ngāti Koata',
'1103' =>'Ngāti Kuia',
'1104' =>'Kāti Māmoe',
'1105' =>'Moriori',
'1106' =>'Ngāti Mutunga (Wharekauri/Chatham Islands)',
'1107' =>'Rangitāne (Te Waipounamu/South Island)',
'1108' =>'Ngāti Rārua',
'1109' =>'Ngāi Tahu / Kāi Tahu',
'1110' =>'Ngāti Tama (Te Waipounamu/South Island)',
'1111' =>'Ngāti Toarangatira (Te Waipounamu/South Island)',
'1112' =>'Waitaha (Te Waipounamu/South Island)',
'1113' =>'Ngāti Apa ki Te Rā Tō',
'2001' =>'Tainui',
'2002' =>'Te Arawa',
'2003' =>'Tākitimu',
'2004' =>'Aotea',
'2005' =>'Mātaatua',
'2006' =>'Mahuru',
'2007' =>'Māmari',
'2008' =>'Ngātokimatawhaorua',
'2009' =>'Nukutere',
'2010' =>'Tokomaru',
'2011' =>'Kurahaupō',
'2012' =>'Muriwhenua',
'2013' =>'Hauraki / Pare Hauraki',
'2014' =>'Tūranganui a Kiwa',
'2015' =>'Te Tauihu o Te Waka a Māui',
'2016' =>'Tauranga Moana',
'2017' =>'Horouta',
'2101' =>'Te Atiawa, region unspecified',
'2102' =>'Ngāti Haua, region unspecified',
'2103' =>'Ngāti Maru, region unspecified',
'2104' =>'Ngāti Mutunga, region unspecified',
'2105' =>'Rangitāne, region unspecified',
'2106' =>'Ngāti Raukawa, region unspecified',
'2107' =>'Ngāti Tama, region unspecified',
'2108' =>'Ngāti Toa, region unspecified',
'2109' =>'Waitaha, region unspecified',
'2110' =>'Ngāti Apa, area unspecified',
'2111' =>'Ngāi Tai, area unspecified',
'2200' =>'Hapū Affiliated to More Than One Iwi',
'9999' =>'Not Stated');

	return $iwi;
	
}

public function subjectCodes(){
	
	$codes = array (
	'CHIN'=>'Chinese', 
'COMM'=>'Communication skills', 
'COOK '=>'Cook Island Maori', 
'ENGL'=>'English', 
'ENSL'=>'English as a second language', 
'REME'=>'English (Remedial)', 
'FREN'=>'French ', 
'GERM'=>'German', 
'INDO'=>'Indonesian', 
'JAPA'=>'Japanese', 
'KORE'=>'Korean', 
'LATI'=>'Latin', 
'NIUE'=>'Niuean', 
'OLAN'=>'Other languages ', 
'PLAN'=>'Pacific Language studies ', 
'RUSS'=>'Russian', 
'SAMO'=>'Samoan', 
'SPAN'=>'Spanish', 
'MAOR'=>'Te Reo Maori', 
'RANG'=>'Te Reo Rangatira', 
'TOKE'=>'Tokelauan', 
'TONG '=>'Tongan ', 
'MATH'=>'Mathematics', 
'MATC'=>'Mathematics with Calculus', 
'MATS'=>'Mathematics with Statistics', 
'REMM'=>'Mathematics (Remedial)', 
'ACCO'=>'Accounting', 
'SCIE'=>'Science', 
'AGHO'=>'Agriculture/ Horticulture', 
'BIOL'=>'Biology/ Biological Science', 
'CHEM'=>'Chemistry', 
'EAAS'=>'Earth Science/Astronomy', 
'HUMB'=>'Human Biology ', 
'PHYS'=>'Physics',  
'TECN'=>'Technology', 
'BITE'=>'Biotechnology', 
'COSC'=>'Computer science/programming', 
'COMP'=>'Computer studies', 
'DEST'=>'Design, Drawing and Graphics', 
'ELTE'=>'Electronics and Control', 
'FOTE'=>'Food Technology', 
'GRAP'=>'Graphics', 
'INTE'=>'Info. & Communication Tech', 
'MTEC'=>'Materials Technology ', 
'STME'=>'Structures and Mechanisms', 
'TIMA'=>'Text & Information Management', 
'CLTX'=>'Textiles/Clothing',  
'ARTA'=>'The Arts', 
'ARTD '=>'Art Design', 
'ARTH'=>'Art History', 
'DANC'=>'Dance', 
'DRAM'=>'Drama', 
'MUSC'=>'Music/Music Studies', 
'MUSP'=>'Music Practical/Performance', 
'ARPA'=>'Painting', 
'APER'=>'Performing Arts', 
'ARTP'=>'Photography', 
'ARPR'=>'Printmaking', 
'ARTS'=>'Sculpture', 
'ARTC'=>'Visual Arts',  
'SOST'=>'Social Studies', 
'CLST'=>'Classics/Classical Studies', 
'CMTY'=>'Community Studies', 
'ECON'=>'Economics', 
'GEOG'=>'Geography', 
'HIST'=>'History', 
'LACU'=>'Language & cultural studies', 
'MAOS'=>'Maori Studies', 
'MEST'=>'Media Studies', 
'SOSC'=>'Other Social Sciences', 
'HEPH'=>'Health and Physical Education', 
'HEED'=>'Health', 
'HOME'=>'Home Economics', 
'OUED '=>'Outdoor Education', 
'PHED'=>'Physical Education', 
'SPOR'=>'Sports Studies',  
'BUSS'=>'Commerce related ', 
'FARM'=>'Farming', 
'FISH'=>'Fishing', 
'FOTY'=>'Forestry', 
'INTR'=>'Industrial Trades ', 
'INTS'=>'Integrated Studies', 
'LAWS'=>'Legal/Law related studies', 
'LIFE '=>'Life skills/Personal development ', 
'REST'=>'Religious education/studies', 
'REMS'=>'Remedial Studies', 
'STPR'=>'Secondary Tertiary Programme', 
'SETR'=>'Service Trades ', 
'SPPR'=>'Special Needs Programme', 
'STDY'=>'Study skills', 
'TRAN'=>'Transition/pre-employment', 
'THTR'=>'Travel, Hospitality, Tourism', 
	);
	
	return $codes;
	
	
}

public function NQF_codes(){

$codes = array();

$codes[56]=array ('314'=>
'30+ Credits at Level 3 or above');

$codes[55] = array('214'=>
'30+ Credits at Level 2 or above');
$codes[54] = array(
'128'=>
'40+ Credits at any Level including Level 1 literacy & numeracy credits');
$code[53]= array(
'126'=>
'40+ Credits at any Level without Level 1 literacy & numeracy credits');
$codes[52]= array(
'116'=>
'14-39 Credits at any Level including Level 1 literacy & numeracy credits');
$codes[51]= array(
'114'=>
'14-39 Credits at any Level without Level 1 literacy & numeracy credits');
$codes[43]= array(
'402'=>
'National Certificate at Level 4');
$codes[40]= array(
'400'=>
'NZ Scholarship award (3 or more scholarship subjects)');
$codes[37]= array(
'345'=>
'NCEA Level 3 (with Excellence)');
$codes[36]= array(
'344'=>
'NCEA Level 3 (with Merit)');
$codes[35]= array(
'343'=>
'NCEA Level 3 (Achieved)');
$codes[34]= array(
'342'=>
'NCEA Level 3');
$codes[33]= array(
'340'=>
'Other Level 3 NQF Qualification');
$codes[30]= array(
'106'=>
'1-13 Credits at Level 3');
$codes[27]= array('245'=>
'NCEA Level 2 (with Excellence)');
$codes[26]= array(
'244'=>
'NCEA Level 2 (with Merit)');
$codes[25]= array(
'243'=>
'NCEA Level 2 (Achieved)');
$codes[24]= array(
'242'=>
'NCEA Level 2');
$codes[20]= array(
'104'=>
'1-13 Credits at Level 2');
$codes[17]= array(
'145'=>
'NCEA Level 1 (with Excellence)');
$codes[16]= array(
'144'=>
'NCEA Level 1 (with Merit)');
$codes[15]= array(
'143'=>
'NCEA Level 1 (Achieved)');
$codes[14]= array(
'142'=>
'NCEA Level 1');
$codes[13]= array( '140'=>
'Other Level 1 NQF qualification');
$codes[10]= array(
'102'=>
'1-13 Credits at Level 1');
$codes[04]= array(
'240'=>
'Other Level 2 NQF Qualification');
$codes[00]= array(
'100'=>
'No Formal Attainment');
	
	return  $codes;
}

public function NON_NQF_codes(){
	
	$codes = array();
	
	$codes[124] = array('60' => 'International Baccalaureate (prep year) Year 11');
	$codes[224] = array('61'=>'International Baccalaureate Year 12');
	$codes[324] = array('62'=>'International Baccalaureate Year 13 or UE');
	$codes[118] = array('70'=>'Cambridge International Exams Year 11');
	$codes[218] = array('71'=>'Cambridge International Exams Year 12');
	$codes[318] = array('72'=>'Cambridge International Exams Year 13 or UE');
	$codes[122] = array('80'=>'Accelerated Christian Education Year 11');
	$codes[222] = array('81'=>'Accelerated Christian Education Year 12');
	$codes[322] = array('82'=>'Accelerated Christian Education Year 13 or UE');
	$codes[120] = array('90'=>'Other Overseas Awards Year 11');
	$codes[220] = array('91'=>'Other Overseas Awards Year 12');
	$codes[320] = array('92'=>'Other Overseas Awards Year 13');
	$codes[100] = array('00'=>'No formal Attainment');
	
	return $codes;
}

public function ECE_codes(){

	$codes = array ("EKR"=>"Attended Kohanga Reo", 
	"EPC"=> "Attended Playcentre",
	"EKE"=> "Attended Kindergarten or Education & Care",
	"EHB"=> "Attended Home Based Service",
	"EPG"=> "Attended Playgroup or Pacific Islands EC group",
	"ECO"=> "Attended the Correspondence School - Te Aho o Te Kura Pounamu",
	"EOS"=> "Attended, but only outside New Zealand",
	"ETU"=> "Attended, but don't know what type of service",
	"ENA"=> "Did not attend",
	"EUN"=> "Unable to establish if attended or not");	
	
	return $codes;
	
}

}


?>