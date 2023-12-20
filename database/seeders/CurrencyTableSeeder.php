<?php
use Illuminate\Database\Seeder;
class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    //   App\Currency::create([
    //   'parent_id' =>'0',
    // ]);
     // App\Currency::table('currencies')->truncate();
        App\Currency::create([
                       'code'=>'AED',
                       'name'=>'United Arab Emirates Dirham',
                       'symbol'=>'د.إ',
                       'html_entity'=>'',
                     ]);
          App\Currency::create([
                       'code'=>'AFN',
                       'name'=>'Afghan Afghani',
                       'symbol'=>'؋',
                       'html_entity'=>'',
                       ]);
          App\Currency::create([
                       'code'=>'ALL',
                       'name'=>'Albanian Lek',
                       'symbol'=>'L',
                       'html_entity'=>''
                       ]);
          App\Currency::create([
                       'code'=>'AMD',
                       'name'=>'Armenian Dram',
                       'symbol'=>'դր.',
                       'html_entity'=>'',
                    ]);
            App\Currency::create([
                       'code'=>'ANG',
                       'name'=>'Netherlands Antillean Gulden',
                       'symbol'=>'ƒ',
                       'html_entity'=>'&#x0192;',
                    ]);
            App\Currency::create([
                       'code'=>'AOA',
                       'name'=>'Angolan Kwanza',
                       'symbol'=>'Kz',
                       'html_entity'=>'',
                    ]);
              App\Currency::create([
                       'code'=>'ARS',
                       'name'=>'Argentine Peso',
                       'symbol'=>'$',
                       'html_entity'=>'&#x20B1;',
                    ]);
              App\Currency::create([
                       'code'=>'AUD',
                       'name'=>'Australian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                App\Currency::create([
                       'code'=>'AWG',
                       'name'=>'Aruban Florin',
                       'symbol'=>'ƒ',
                       'html_entity'=>'&#x0192;',
                    ]);
                App\Currency::create([
                       'code'=>'AZN',
                       'name'=>'Azerbaijani Manat',
                       'symbol'=>'null',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BAM',
                       'name'=>'Bosnia and Herzegovina Convertible Mark',
                       'symbol'=>'КМ',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BBD',
                       'name'=>'Barbadian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                  App\Currency::create([
                       'code'=>'BDT',
                       'name'=>'Bangladeshi Taka',
                       'symbol'=>'৳',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BGN',
                       'name'=>'Bulgarian Lev',
                       'symbol'=>'лв',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BHD',
                       'name'=>'Bahraini Dinar',
                       'symbol'=>'ب.د',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BIF',
                       'name'=>'Burundian Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BMD',
                       'name'=>'Bermudian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                  App\Currency::create([
                       'code'=>'BND',
                       'name'=>'Brunei Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                  App\Currency::create([
                       'code'=>'BOB',
                       'name'=>'Bolivian Boliviano',
                       'symbol'=>'Bs.',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BRL',
                       'name'=>'Brazilian Real',
                       'symbol'=>'R$',
                       'html_entity'=>'R$',
                    ]);
                  App\Currency::create([
                       'code'=>'BSD',
                       'name'=>'Bahamian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                  App\Currency::create([
                       'code'=>'BTN',
                       'name'=>'Bhutanese Ngultrum',
                       'symbol'=>'Nu.',
                       'html_entity'=>'',
                    ]);
                  App\Currency::create([
                       'code'=>'BWP',
                       'name'=>'Botswana Pula',
                       'symbol'=>'P',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'BYR',
                       'name'=>'Belarusian Ruble',
                       'symbol'=>'Br',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'BZD',
                       'name'=>'Belize Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                      App\Currency::create([
                       'code'=>'CAD',
                       'name'=>'Canadian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'CDF',
                       'name'=>'Congolese Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'CHF',
                       'name'=>'Swiss Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'CLF',
                       'name'=>'Unidad de Fomento',
                       'symbol'=>'UF',
                       'html_entity'=>'&#x20B1;',
                    ]);
                    App\Currency::create([
                       'code'=>'CLP',
                       'name'=>'Chilean Peso',
                       'symbol'=>'$',
                       'html_entity'=>'&#36;',
                    ]);
                    App\Currency::create([
                       'code'=>'CNY',
                       'name'=>'Chinese Renminbi Yuan',
                       'symbol'=>'¥',
                       'html_entity'=>'&#20803;',
                    ]);
                    App\Currency::create([
                       'code'=>'COP',
                       'name'=>'Colombian Peso',
                       'symbol'=>'$',
                       'html_entity'=>'&#x20B1;',
                    ]);
                    App\Currency::create([
                       'code'=>'CRC',
                       'name'=>'Costa Rican Colón',
                       'symbol'=>'₡',
                       'html_entity'=>'&#x20A1;',
                    ]);
                    App\Currency::create([
                       'code'=>'CUC',
                       'name'=>'Cuban Convertible Peso',
                       'symbol'=>'$',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'CUP',
                       'name'=>'Cuban Peso',
                       'symbol'=>'$',
                       'html_entity'=>'&#x20B1;',
                    ]);
                    App\Currency::create([
                       'code'=>'CVE',
                       'name'=>'Cape Verdean Escudo',
                       'symbol'=>'$',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'CZK',
                       'name'=>'Czech Koruna',
                       'symbol'=>'Kč',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'DJF',
                       'name'=>'Djiboutian Franc',
                       'symbol'=>'Fdj',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'DKK',
                       'name'=>'Danish Krone',
                       'symbol'=>'kr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'DOP',
                       'name'=>'Dominican Peso',
                       'symbol'=>'$',
                       'html_entity'=>'&#x20B1;',
                    ]);
                    App\Currency::create([
                       'code'=>'DZD',
                       'name'=>'Algerian Dinar',
                       'symbol'=>'د.ج',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'EGP',
                       'name'=>'Egyptian Pound',
                       'symbol'=>'ج.م',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'ERN',
                       'name'=>'Eritrean Nakfa',
                       'symbol'=>'Nfk',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'ETB',
                       'name'=>'Ethiopian Birr',
                       'symbol'=>'Br',
                       'html_entity'=>'',
                    ]);
                      App\Currency::create([
                       'code'=>'EUR',
                       'name'=>'Euro',
                       'symbol'=>'€',
                       'html_entity'=>'&#x20AC;',
                    ]);
                    App\Currency::create([
                       'code'=>'FJD',
                       'name'=>'Fijian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'FKP',
                       'name'=>'Falkland Pound',
                       'symbol'=>'£',
                       'html_entity'=>'&#x00A3;',
                    ]);
                      App\Currency::create([
                       'code'=>'GBP',
                       'name'=>'British Pound',
                       'symbol'=>'£',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'GEL',
                       'name'=>'Georgian Lari',
                       'symbol'=>'ლ',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'GHS',
                       'name'=>'Ghanaian Cedi',
                       'symbol'=>'₵',
                       'html_entity'=>'&#x20B5;',
                    ]);
                    App\Currency::create([
                       'code'=>'GIP',
                       'name'=>'Gibraltar Pound',
                       'symbol'=>'£',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'GMD',
                       'name'=>'Gambian Dalasi',
                       'symbol'=>'D',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'GNF',
                       'name'=>'Guinean Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'GTQ',
                       'name'=>'Guatemalan Quetzal',
                       'symbol'=>'Q',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'GYD',
                       'name'=>'Guyanese Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'HKD',
                       'name'=>'Hong Kong Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'HNL',
                       'name'=>'Honduran Lempira',
                       'symbol'=>'L',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'HRK',
                       'name'=>'Croatian Kuna',
                       'symbol'=>'kn',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'HTG',
                       'name'=>'Haitian Gourde',
                       'symbol'=>'G',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'HUF',
                       'name'=>'Hungarian Forint',
                       'symbol'=>'Ft',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'IDR',
                       'name'=>'Indonesian Rupiah',
                       'symbol'=>'Rp',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'ILS',
                       'name'=>'Israeli New Sheqel',
                       'symbol'=>'₪',
                       'html_entity'=>'&#x20AA;',
                    ]);
                    App\Currency::create([
                       'code'=>'INR',
                       'name'=>'Indian Rupee',
                       'symbol'=>'₹',
                       'html_entity'=>'&#x20b9;',
                    ]);
                    App\Currency::create([
                       'code'=>'IQD',
                       'name'=>'Iraqi Dinar',
                       'symbol'=>'ع.د',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'IRR',
                       'name'=>'Iranian Rial',
                       'symbol'=>'﷼',
                       'html_entity'=>'&#xFDFC;',
                    ]);
                    App\Currency::create([
                       'code'=>'ISK',
                       'name'=>'Icelandic Króna',
                       'symbol'=>'kr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'JMD',
                       'name'=>'Jamaican Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'JOD',
                       'name'=>'Jordanian Dinar',
                       'symbol'=>'د.ا',
                       'html_entity'=>'',
                    ]);
                      App\Currency::create([
                       'code'=>'JPY',
                       'name'=>'Japanese Yen',
                       'symbol'=>'¥',
                       'html_entity'=>'&#x00A5;',
                    ]);
                    App\Currency::create([
                       'code'=>'KES',
                       'name'=>'Kenyan Shilling',
                       'symbol'=>'KSh',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'KGS',
                       'name'=>'Kyrgyzstani Som',
                       'symbol'=>'som',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'KHR',
                       'name'=>'Cambodian Riel',
                       'symbol'=>'៛',
                       'html_entity'=>'&#x17DB;',
                    ]);
                    App\Currency::create([
                       'code'=>'KMF',
                       'name'=>'Comorian Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'KPW',
                       'name'=>'North Korean Won',
                       'symbol'=>'₩',
                       'html_entity'=>'&#x20A9;',
                    ]);
                    App\Currency::create([
                       'code'=>'KRW',
                       'name'=>'South Korean Won',
                       'symbol'=>'₩',
                       'html_entity'=>'&#x20A9;',
                    ]);
                    App\Currency::create([
                       'code'=>'KWD',
                       'name'=>'Kuwaiti Dinar',
                       'symbol'=>'د.ك',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'KYD',
                       'name'=>'Cayman Islands Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'KZT',
                       'name'=>'Kazakhstani Tenge',
                       'symbol'=>'〒',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'LAK',
                       'name'=>'Lao Kip',
                       'symbol'=>'₭',
                       'html_entity'=>'&#x20AD;',
                    ]);
                    App\Currency::create([
                       'code'=>'LBP',
                       'name'=>'Lebanese Pound',
                       'symbol'=>'ل.ل',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'LKR',
                       'name'=>'Sri Lankan Rupee',
                       'symbol'=>'₨',
                       'html_entity'=>'&#x0BF9;',
                    ]);
                    App\Currency::create([
                       'code'=>'LRD',
                       'name'=>'Liberian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'LSL',
                       'name'=>'Lesotho Loti',
                       'symbol'=>'L',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'LTL',
                       'name'=>'Lithuanian Litas',
                       'symbol'=>'Lt',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'LVL',
                       'name'=>'Latvian Lats',
                       'symbol'=>'Ls',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'LYD',
                       'name'=>'Libyan Dinar',
                       'symbol'=>'ل.د',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MAD',
                       'name'=>'Moroccan Dirham',
                       'symbol'=>'د.م.',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MDL',
                       'name'=>'Moldovan Leu',
                       'symbol'=>'L',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MGA',
                       'name'=>'Malagasy Ariary',
                       'symbol'=>'Ar',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MKD',
                       'name'=>'Macedonian Denar',
                       'symbol'=>'ден',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MMK',
                       'name'=>'Myanmar Kyat',
                       'symbol'=>'K',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MNT',
                       'name'=>'Mongolian Tögrög',
                       'symbol'=>'₮',
                       'html_entity'=>'&#x20AE;',
                    ]);
                    App\Currency::create([
                       'code'=>'MOP',
                       'name'=>'Macanese Pataca',
                       'symbol'=>'P',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MRO',
                       'name'=>'Mauritanian Ouguiya',
                       'symbol'=>'UM',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MUR',
                       'name'=>'Mauritian Rupee',
                       'symbol'=>'₨',
                       'html_entity'=>'&#x20A8;',
                    ]);
                    App\Currency::create([
                       'code'=>'MVR',
                       'name'=>'Maldivian Rufiyaa',
                       'symbol'=>'MVR',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MWK',
                       'name'=>'Malawian Kwacha',
                       'symbol'=>'MK',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MXN',
                       'name'=>'Mexican Peso',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'MYR',
                       'name'=>'Malaysian Ringgit',
                       'symbol'=>'RM',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'MZN',
                       'name'=>'Mozambican Metical',
                       'symbol'=>'MTn',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'NAD',
                       'name'=>'Namibian Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'NGN',
                       'name'=>'Nigerian Naira',
                       'symbol'=>'₦',
                       'html_entity'=>'&#x20A6;',
                    ]);
                    App\Currency::create([
                       'code'=>'NIO',
                       'name'=>'Nicaraguan Córdoba',
                       'symbol'=>'C$',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'NOK',
                       'name'=>'Norwegian Krone',
                       'symbol'=>'kr',
                       'html_entity'=>'kr',
                    ]);
                    App\Currency::create([
                       'code'=>'NPR',
                       'name'=>'Nepalese Rupee',
                       'symbol'=>'₨',
                       'html_entity'=>'&#x20A8;',
                    ]);
                    App\Currency::create([
                       'code'=>'NZD',
                       'name'=>'New Zealand Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'OMR',
                       'name'=>'Omani Rial',
                       'symbol'=>'ر.ع.',
                       'html_entity'=>'&#xFDFC;',
                    ]);
                    App\Currency::create([
                       'code'=>'PAB',
                       'name'=>'Panamanian Balboa',
                       'symbol'=>'B/.',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'PEN',
                       'name'=>'Peruvian Nuevo Sol',
                       'symbol'=>'S/.',
                       'html_entity'=>'S/.',
                    ]);
                    App\Currency::create([
                       'code'=>'PGK',
                       'name'=>'Papua New Guinean Kina',
                       'symbol'=>'K',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'PHP',
                       'name'=>'Philippine Peso',
                       'symbol'=>'₱',
                       'html_entity'=>'&#x20B1;',
                    ]);
                    App\Currency::create([
                       'code'=>'PKR',
                       'name'=>'Pakistani Rupee',
                       'symbol'=>'₨',
                       'html_entity'=>'&#x20A8;',
                    ]);
                    App\Currency::create([
                       'code'=>'PLN',
                       'name'=>'Polish Złoty',
                       'symbol'=>'zł',
                       'html_entity'=>'z&#322;',
                    ]);
                    App\Currency::create([
                       'code'=>'PYG',
                       'name'=>'Paraguayan Guaraní',
                       'symbol'=>'₲',
                       'html_entity'=>'&#x20B2;',
                    ]);
                    App\Currency::create([
                       'code'=>'QAR',
                       'name'=>'Qatari Riyal',
                       'symbol'=>'ر.ق',
                       'html_entity'=>'&#xFDFC;',
                    ]);
                    App\Currency::create([
                       'code'=>'RON',
                       'name'=>'Romanian Leu',
                       'symbol'=>'Lei',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'RSD',
                       'name'=>'Serbian Dinar',
                       'symbol'=>'РСД',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'RUB',
                       'name'=>'Russian Ruble',
                       'symbol'=>'р.',
                       'html_entity'=>'&#x0440;&#x0443;&#x0431;',
                    ]);
                    App\Currency::create([
                       'code'=>'RWF',
                       'name'=>'Rwandan Franc',
                       'symbol'=>'FRw',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SAR',
                       'name'=>'Saudi Riyal',
                       'symbol'=>'ر.س',
                       'html_entity'=>'&#xFDFC;',
                    ]);
                    App\Currency::create([
                       'code'=>'SBD',
                       'name'=>'Solomon Islands Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'SCR',
                       'name'=>'Seychellois Rupee',
                       'symbol'=>'₨',
                       'html_entity'=>'&#x20A8;',
                    ]);
                    App\Currency::create([
                       'code'=>'SDG',
                       'name'=>'Sudanese Pound',
                       'symbol'=>'£',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SEK',
                       'name'=>'Swedish Krona',
                       'symbol'=>'kr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SGD',
                       'name'=>'Singapore Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'SHP',
                       'name'=>'Saint Helenian Pound',
                       'symbol'=>'£',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'SKK',
                       'name'=>'Slovak Koruna',
                       'symbol'=>'Sk',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SLL',
                       'name'=>'Sierra Leonean Leone',
                       'symbol'=>'Le',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SOS',
                       'name'=>'Somali Shilling',
                       'symbol'=>'Sh',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SRD',
                       'name'=>'Surinamese Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SSP',
                       'name'=>'South Sudanese Pound',
                       'symbol'=>'£',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'STD',
                       'name'=>'São Tomé and Príncipe Dobra',
                       'symbol'=>'Db',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'SVC',
                       'name'=>'Salvadoran Colón',
                       'symbol'=>'₡',
                       'html_entity'=>'&#x20A1;',
                    ]);
                    App\Currency::create([
                       'code'=>'SYP',
                       'name'=>'Syrian Pound',
                       'symbol'=>'£S',
                       'html_entity'=>'&#x00A3;',
                    ]);
                    App\Currency::create([
                       'code'=>'SZL',
                       'name'=>'Swazi Lilangeni',
                       'symbol'=>'L',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'THB',
                       'name'=>'Thai Baht',
                       'symbol'=>'฿',
                       'html_entity'=>'&#x0E3F;',
                    ]);
                    App\Currency::create([
                       'code'=>'TJS',
                       'name'=>'Tajikistani Somoni',
                       'symbol'=>'ЅМ',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'TMT',
                       'name'=>'Turkmenistani Manat',
                       'symbol'=>'T',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'TND',
                       'name'=>'Tunisian Dinar',
                       'symbol'=>'د.ت',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'TOP',
                       'name'=>'Tongan Paʻanga',
                       'symbol'=>'T$',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'TRY',
                       'name'=>'Turkish Lira',
                       'symbol'=>'TL',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'TTD',
                       'name'=>'Trinidad and Tobago Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'TWD',
                       'name'=>'New Taiwan Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'TZS',
                       'name'=>'Tanzanian Shilling',
                       'symbol'=>'Sh',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'UAH',
                       'name'=>'Ukrainian Hryvnia',
                       'symbol'=>'₴',
                       'html_entity'=>'&#x20B4;',
                    ]);
                    App\Currency::create([
                       'code'=>'UGX',
                       'name'=>'Ugandan Shilling',
                       'symbol'=>'USh',
                       'html_entity'=>'',
                    ]);
                      App\Currency::create([
                       'code'=>'USD',
                       'name'=>'United States Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'UYU',
                       'name'=>'Uruguayan Peso',
                       'symbol'=>'$',
                       'html_entity'=>'&#x20B1;',
                    ]);
                    App\Currency::create([
                       'code'=>'UZS',
                       'name'=>'Uzbekistani Som',
                       'symbol'=>'null',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'VEF',
                       'name'=>'Venezuelan Bolívar',
                       'symbol'=>'Bs F',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'VND',
                       'name'=>'Vietnamese Đồng',
                       'symbol'=>'₫',
                       'html_entity'=>'&#x20AB;',
                    ]);
                    App\Currency::create([
                       'code'=>'VUV',
                       'name'=>'Vanuatu Vatu',
                       'symbol'=>'Vt',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'WST',
                       'name'=>'Samoan Tala',
                       'symbol'=>'T',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'XAF',
                       'name'=>'Central African Cfa Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'XAG',
                       'name'=>'Silver (Troy Ounce)',
                       'symbol'=>'oz t',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'XAU',
                       'name'=>'Gold (Troy Ounce)',
                       'symbol'=>'oz t',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'XCD',
                       'name'=>'East Caribbean Dollar',
                       'symbol'=>'$',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'XDR',
                       'name'=>'Special Drawing Rights',
                       'symbol'=>'SDR',
                       'html_entity'=>'$',
                    ]);
                    App\Currency::create([
                       'code'=>'XOF',
                       'name'=>'West African Cfa Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'XPF',
                       'name'=>'Cfp Franc',
                       'symbol'=>'Fr',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'YER',
                       'name'=>'Yemeni Rial',
                       'symbol'=>'﷼',
                       'html_entity'=>'&#xFDFC;',
                    ]);
                    App\Currency::create([
                       'code'=>'ZAR',
                       'name'=>'South African Rand',
                       'symbol'=>'R',
                       'html_entity'=>'&#x0052;',
                    ]);
                    App\Currency::create([
                       'code'=>'ZMK',
                       'name'=>'Zambian Kwacha',
                       'symbol'=>'ZK',
                       'html_entity'=>'',
                    ]);
                    App\Currency::create([
                       'code'=>'ZMW',
                       'name'=>'Zambian Kwacha',
                       'symbol'=>'ZK',
                       'html_entity'=>'',
                    ]);
        // Uncomment the below to run the seeder
        // App\Currency::table('currencies')->insert($currencies);
    }
    }
