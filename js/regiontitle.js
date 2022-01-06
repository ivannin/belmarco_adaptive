ymaps.ready( function() {
	function getCookie( name ) {
		var matches = document.cookie.match( new RegExp(
			"(?:^|; )" + name.replace( /([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1' ) + "=([^;]*)"
		) );
		return matches ? decodeURIComponent( matches[ 1 ] ) : undefined;
	}

	function setCookie( name, value, options ) {
		options = options || {};

		var expires = options.expires;

		if ( typeof expires == "number" && expires ) {
			var d = new Date();
			d.setTime( d.getTime() + expires * 1000 );
			expires = options.expires = d;
		}
		if ( expires && expires.toUTCString ) {
			options.expires = expires.toUTCString();
		}

		value = encodeURIComponent( value );

		var updatedCookie = name + "=" + value;

		/*for ( var propName in options ) {
			updatedCookie += "; " + propName;
			var propValue = options[ propName ];
			if ( propValue !== true ) {
				updatedCookie += "=" + propValue;
			}
		}*/

		document.cookie = updatedCookie;
	}

	if ( ymaps.geolocation.city != '' ) {
		var region = ymaps.geolocation.city,
			regionHeader = '',
			regionDiscount = '',
			regionDelivery = '',
			regionDealer1 = '',
			regionDealer2 = '';

		cookieValue = getCookie( 'wc_geo_city' );
		console.log( "cookieValue: " + cookieValue );

		if ( cookieValue == undefined ) {
			cookieValue = region;
			setCookie( 'wc_geo_city', cookieValue );
		}

		var el = document.getElementById( 'wc_geo_cityname' );
		if ( el !== null ) {
			el.textContent = cookieValue;
		}
	}
	if ( region == 'Москва' ) {
		regionHeader = "Москве и Московской области";
		regionDiscount = "в Москве";
		regionDelivery = "в Москву и Московскую область";
		regionDealer1 = "Москвы";
		regionDealer2 = "Москвы и Московской области";
	} else if ( region == 'Долгопрудный' ) {
		regionHeader = "Долгопрудному и Московской области";
		regionDiscount = "в Долгопрудном";
		regionDelivery = "в Долгопрудный и Московскую область";
		regionDealer1 = "Долгопрудного";
		regionDealer2 = "Долгопрудного и Московской области";
	} else if ( region == 'Дубна' ) {
		regionHeader = "Дубне и Московской области";
		regionDiscount = "в Дубне";
		regionDelivery = "в Дубну и Московскую область";
		regionDealer1 = "Дубны";
		regionDealer2 = "Дубны и Московской области";
	} else if ( region == 'Пущино' ) {
		regionHeader = "Пущино и Московской области";
		regionDiscount = "в Пущино";
		regionDelivery = "в Пущино и Московскую область";
		regionDealer1 = "Пущино";
		regionDealer2 = "Пущино и Московской области";
	} else if ( region == 'Черноголовка' ) {
		regionHeader = "Черноголовке и Московской области";
		regionDiscount = "Черноголовке";
		regionDelivery = "в Черноголовку и Московскую область";
		regionDealer1 = "Черноголовки";
		regionDealer2 = "Черноголовки и Московской области";
	} else if ( region == 'Мытищи' ) {
		regionHeader = "Мытищам и Московской области";
		regionDiscount = "Мытищах";
		regionDelivery = "в Мытищи и Московскую область";
		regionDealer1 = "Мытищ";
		regionDealer2 = "Мытищ и Московской области";
	} else if ( region == 'Люберцы' ) {
		regionHeader = "Люберцам и Московской области";
		regionDiscount = "Люберцах";
		regionDelivery = "в Люберцы и Московскую область";
		regionDealer1 = "Люберец";
		regionDealer2 = "Люберец и Московской области";
	} else if ( region == 'Одинцово' ) {
		regionHeader = "Одинцово и Московской области";
		regionDiscount = "Одинцово";
		regionDelivery = "в Одинцово и Московскую область";
		regionDealer1 = "Одинцово";
		regionDealer2 = "Одинцово и Московской области";
	} else if ( region == 'Подольск' ) {
		regionHeader = "Подольску и Московской области";
		regionDiscount = "Подольске";
		regionDelivery = "в Подольск и Московскую область";
		regionDealer1 = "Подольска";
		regionDealer2 = "Подольска и Московской области";
	} else if ( region == 'Жуковский' ) {
		regionHeader = "Жуковскому и Московской области";
		regionDiscount = "в Жуковском";
		regionDelivery = "в Жуковский и Московскую область";
		regionDealer1 = "Жуковска";
		regionDealer2 = "Жуковска и Московской области";
	} else if ( region == 'Сергиев Посад' ) {
		regionHeader = "Сергиевому Посаду и Московской области";
		regionDiscount = "в Сергиевом Посаде";
		regionDelivery = "в Сергиев Посад и Московскую область";
		regionDealer1 = "Сергиева Посада";
		regionDealer2 = "Сергиева Пасада и Московской области";
	} else if ( region == 'Балашиха' ) {
		regionHeader = "Балашихе и Московской области";
		regionDiscount = "в Балашихе";
		regionDelivery = "в Балашиху и Московскую область";
		regionDealer1 = "Балашихи";
		regionDealer2 = "Балашихи и Московской области";
	} else if ( region == 'Ногинск' ) {
		regionHeader = "Ногинску и Московской области";
		regionDiscount = "в Ногинске";
		regionDelivery = "в в Ногинск и Московскую область";
		regionDealer1 = "Ногинска";
		regionDealer2 = "Ногинска и Московской области";
	} else if ( region == 'Пушкино' ) {
		regionHeader = "Пушкино и Московской области";
		regionDiscount = "в Пушкино ";
		regionDelivery = "в Пушкино и Московскую область";
		regionDealer1 = "Пушкино";
		regionDealer2 = "Пушкино и Московской области";
	} else if ( region == 'Раменское' ) {
		regionHeader = "Раменскому и Московской области";
		regionDiscount = "в Раменском";
		regionDelivery = "в Раменское и Московскую область";
		regionDealer1 = "Раменского";
		regionDealer2 = "Раменского и Московской области";
	} else if ( region == 'Химки' ) {
		regionHeader = "Химкам и Московской области";
		regionDiscount = "в Химках";
		regionDelivery = "в в Химки и Московскую область";
		regionDealer1 = "Химок";
		regionDealer2 = "Химок и Московской области";
	} else if ( region == 'Щелково' ) {
		regionHeader = "Щелково и Московской области";
		regionDiscount = "в Щелково";
		regionDelivery = "в Щелково и Московскую область";
		regionDealer1 = "Щелкова";
		regionDealer2 = "Щелково Московской области";
	} else if ( region == 'Серпухов' ) {
		regionHeader = "Серпухову и Московской области";
		regionDiscount = "в Серпухове";
		regionDelivery = "в Серпухов и Московскую область";
		regionDealer1 = "Серпухова";
		regionDealer2 = "Серпухово и Московской области";
	} else if ( region == 'Коломна' ) {
		regionHeader = "Коломне и Московской области";
		regionDiscount = "в Коломне";
		regionDelivery = "в Коломну и Московскую область";
		regionDealer1 = "Коломны";
		regionDealer2 = "Коломны и Московской области";
	} else if ( region == 'Орехово-Зуево' ) {
		regionHeader = "Орехово-Зуево и Московской области";
		regionDiscount = "в Орехово-Зуево";
		regionDelivery = "в Орехово-Зуево и Московскую область";
		regionDealer1 = "Орехово-Зуево";
		regionDealer2 = "Орехово-Зуево и Московской области";
	} else if ( region == 'Клин' ) {
		regionHeader = "Клину и Московской области";
		regionDiscount = "в Клину";
		regionDelivery = "в в Клин и Московскую область";
		regionDealer1 = "Клина";
		regionDealer2 = "Клина и Московской области";
	} else if ( region == 'Чехов' ) {
		regionHeader = "Чехову и Московской области";
		regionDiscount = "в Чехове";
		regionDelivery = "в Чехов и Московскую область";
		regionDealer1 = "Чехова";
		regionDealer2 = "Чехово и Московской области";
	} else if ( region == 'Ступино' ) {
		regionHeader = "Ступино и Московской области";
		regionDiscount = "в Ступино";
		regionDelivery = "в Ступино и Московскую область";
		regionDealer1 = "Ступино";
		regionDealer2 = "Ступино и Московской области";
	} else if ( region == 'Красногорск' ) {
		regionHeader = "Красногорску и Московской области";
		regionDiscount = "в Красногорске";
		regionDelivery = "в Красногорск и Московскую область";
		regionDealer1 = "Красногорска";
		regionDealer2 = "Красногорска и Московской области";
	} else if ( region == 'Электросталь' ) {
		regionHeader = "Электростали и Московской области";
		regionDiscount = "в Электростали";
		regionDelivery = "в Электросталь и Московскую область";
		regionDealer1 = "Электростали";
		regionDealer2 = "Электростали и Московской области";
	} else if ( region == 'Королёв' ) {
		regionHeader = "Королёву и Московской области";
		regionDiscount = "в Королёве";
		regionDelivery = "в Королёв и Московскую область";
		regionDealer1 = "Королёва";
		regionDealer2 = "Королёва и Московской области";
	} else if ( region == 'Реутов' ) {
		regionHeader = "Реутову и Московской области";
		regionDiscount = "в Реутове";
		regionDelivery = "в Реутов и Московскую область";
		regionDealer1 = "Реутова";
		regionDealer2 = "Реутова и Московской области";
	} else if ( region == 'Видное' ) {
		regionHeader = "Видное и Московской области";
		regionDiscount = "в Видном";
		regionDelivery = "в Видное и Московскую область";
		regionDealer1 = "Видного";
		regionDealer2 = "Видного и Московской области";
	} else if ( region == 'Железнодорожный' ) {
		regionHeader = "Железнодорожному и Московской области";
		regionDiscount = "в Железнодорожном";
		regionDelivery = "в Железнодорожный и Московскую область";
		regionDealer1 = "Железнодорожного";
		regionDealer2 = "Железнодорожного и Московской области";
	} else if ( region == 'Домодедово' ) {
		regionHeader = "Домодедово и Московской области";
		regionDiscount = "в Домодедово";
		regionDelivery = "в Домодедово и Московскую область";
		regionDealer1 = "Домодедово";
		regionDealer2 = "Домодедово и Московской области";
	} else if ( region == 'Солнечногорск' ) {
		regionHeader = "Солнечногорску и Московской области";
		regionDiscount = "в Солнечногорске";
		regionDelivery = "в Солнечногорск и Московскую область";
		regionDealer1 = "Солнечногорска";
		regionDealer2 = "Солнечногорска и Московской области";
	} else if ( region == 'Дмитров' ) {
		regionHeader = "Дмитрове и Московской области";
		regionDiscount = "в Дмитрове";
		regionDelivery = "в Дмитров и Московскую область";
		regionDealer1 = "Дмитрова";
		regionDealer2 = "Дмитрова и Московской области";
	} else if ( region == 'Павловский Посад' ) {
		regionHeader = "Павловскому Посаду и Московской области";
		regionDiscount = "в Павловском Посаде";
		regionDelivery = "в Павловский Посаде и Московскую область";
		regionDealer1 = "Павловского Посада";
		regionDealer2 = "Павловского Пасада и Московской области";
	} else if ( region == 'Симферополь' ) {
		regionHeader = "Симферополю и Республике Крым";
		regionDiscount = "в Симферополе";
		regionDelivery = "в Симферополь и Республику Крым";
		regionDealer1 = "Симферополя";
		regionDealer2 = "Симферополя и Республики Крым";
	} else if ( region == 'Севастополь' ) {
		regionHeader = "Севастополю и Республике Крым";
		regionDiscount = "в Севастополе";
		regionDelivery = "в Севастополь и Республику Крым";
		regionDealer1 = "Севастополя";
		regionDealer2 = "Севастополя и Республики Крым";
	} else if ( region == 'Ялта' ) {
		regionHeader = "Ялте и Республике Крым";
		regionDiscount = "в Ялте";
		regionDelivery = "в Ялту и Республику Крым";
		regionDealer1 = "Ялты";
		regionDealer2 = "Ялты и Республики Крым";
	} else if ( region == 'Керчь' ) {
		regionHeader = "Керчь и Республике Крым";
		regionDiscount = "в Керче";
		regionDelivery = "в Керчь и Республику Крым";
		regionDealer1 = "Керчи";
		regionDealer2 = "Керчи и Республики Крым";
	} else if ( region == 'Феодосия' ) {
		regionHeader = "Феодосии и Республике Крым";
		regionDiscount = "в Феодосии";
		regionDelivery = "в Феодосию и Республику Крым";
		regionDealer1 = "Феодосии";
		regionDealer2 = "Феодосии и Республики Крым";
	} else if ( region == 'Евпатория' ) {
		regionHeader = "Евпатории и Республике Крым";
		regionDiscount = "в Евпатории";
		regionDelivery = "в Евпаторию и Республику Крым";
		regionDealer1 = "Евпатория";
		regionDealer2 = "Евпатория и Республики Крым";
	} else if ( region == 'Алушта' ) {
		regionHeader = "Алуште и Республике Крым";
		regionDiscount = "в Алуште";
		regionDelivery = "в Алушту и Республику Крым";
		regionDealer1 = "Алушты";
		regionDealer2 = "Алушты и Республики Крым";
	} else if ( region == 'Магадан' ) {
		regionHeader = "Магадану и Магаданской области";
		regionDiscount = "в Магадану";
		regionDelivery = "в Магадан и  Магаданскую область";
		regionDealer1 = "Магадана";
		regionDealer2 = "Магадана и Магаданской области";
	} else if ( region == 'Петропавловск-Камчатский' ) {
		regionHeader = "Петропавловск-Камчатскому и Камчатскому краю";
		regionDiscount = "в Петропавловске-Камчатском";
		regionDelivery = "в Петропавловск-Камчатский и Камчатский край";
		regionDealer1 = "Петропавловска-Камчатска";
		regionDealer2 = "Петропавловска-Камчатска и Камчатского края";
	} else if ( region == 'Биробиджан' ) {
		regionHeader = "Биробиджану и Еврейской автономной области";
		regionDiscount = "в Биробиджане";
		regionDelivery = "в Биробиджан и Еврейскую автономную область";
		regionDealer1 = "Биробиджана";
		regionDealer2 = "Биробиджана и Еврейского автономного округа";
	} else if ( region == 'Петропавловск-Камчатский' ) {
		regionHeader = "Петропавловск-Камчатскому и Камчатскому краю";
		regionDiscount = "в Петропавловске-Камчатском";
		regionDelivery = "в Петропавловск-Камчатский и Камчатский край";
		regionDealer1 = "Петропавловска-Камчатска";
		regionDealer2 = "Петропавловска-Камчатска и Камчатского края";
	} else if ( region == 'Анадырь' ) {
		regionHeader = "Анадырю и Чукотскому автономному округу";
		regionDiscount = "в Анадыре";
		regionDelivery = "в Анадырь и Чукотский автономный округ";
		regionDealer1 = "Анадыря";
		regionDealer2 = "Анадыря и Чукотского автономного округа";
	} else if ( region == 'Хабаровск' ) {
		regionHeader = "Хабаровску и Хабаровскому краю";
		regionDiscount = "в Хабаровске";
		regionDelivery = "в Хабаровск и Хабаровский край";
		regionDealer1 = "Хабаровска";
		regionDealer2 = "Хабаровска и Хабаровского края";
	} else if ( region == 'Комсомольск-на-Амуре' ) {
		regionHeader = "Комсомольску-на-Амуре и Хабаровскому краю";
		regionDiscount = "в Комсомольске-на-Амуре";
		regionDelivery = "в Комсомольск-на-Амуре и Хабаровский край";
		regionDealer1 = "Комсомольска-на-Амуре";
		regionDealer2 = "Комсомольска-на-Амуре и Хабаровского края";
	} else if ( region == 'Владивосток' ) {
		regionHeader = "Владивостоку и Приморскому краю";
		regionDiscount = "в Владивостоке";
		regionDelivery = "в Владивосток и Приморский край";
		regionDealer1 = "Владивостока";
		regionDealer2 = "Владивостока и Приморского края";
	} else if ( region == 'Находка' ) {
		regionHeader = "Находке и Приморскому краю";
		regionDiscount = "в Находке";
		regionDelivery = "в Находку и Приморский край";
		regionDealer1 = "Находки";
		regionDealer2 = "Находки и Приморского края";
	} else if ( region == 'Уссурийск' ) {
		regionHeader = "Уссурийску и Приморскому краю";
		regionDiscount = "в Уссурийске";
		regionDelivery = "в Уссурийск и Приморский край";
		regionDealer1 = "Уссурийска";
		regionDealer2 = "Уссурийска и Приморского края";
	} else if ( region == 'Благовещенск' ) {
		regionHeader = "Благовещенску и Амурской области";
		regionDiscount = "в Благовещенске";
		regionDelivery = "в Благовещенск и Амурскую область";
		regionDealer1 = "Благовещенска";
		regionDealer2 = "Благовеенска и Амурской области";
	} else if ( region == 'Белогорск' ) {
		regionHeader = "Белогорску и Амурской области";
		regionDiscount = "в Белогорске";
		regionDelivery = "в Белогорск и Амурскую область";
		regionDealer1 = "Белогорска";
		regionDealer2 = "Белогорска и Амурской области";
	} else if ( region == 'Тында' ) {
		regionHeader = "Тынде и Амурской области";
		regionDiscount = "в Тынде";
		regionDelivery = "в Тынду и Амурскую область";
		regionDealer1 = "Тынды";
		regionDealer2 = "Тынды и Амурской области";
	} else if ( region == 'Якутск' ) {
		regionHeader = "Якутску и Дальневосточному округу";
		regionDiscount = "в Якутске";
		regionDelivery = "в Якутск и Дальневосточный округ";
		regionDealer1 = "Якутска";
		regionDealer2 = "Якутска и Дальневосточного округа";
	} else if ( region == 'Южно-Сахалинск' ) {
		regionHeader = "Южно-Сахалинску и Сахалинской области";
		regionDiscount = "в Южно-Сахалинске";
		regionDelivery = "в Южно-Сахалинск и Сахалинскую область";
		regionDealer1 = "Южно-Сахалинска";
		regionDealer2 = "Южно-Сахалинска и Сахалинской области";
	} else if ( region == 'Барнаул' ) {
		regionHeader = "Барнаулу и Алтайскому краю";
		regionDiscount = "в Барнауле";
		regionDelivery = "в Барнаул и Алтайский край";
		regionDealer1 = "Барнаула";
		regionDealer2 = "Барнаула и Алтайского края";
	} else if ( region == 'Бийск' ) {
		regionHeader = "Бийску и Алтайскому краю";
		regionDiscount = "в Бийске";
		regionDelivery = "в Бийск и Алтайский край";
		regionDealer1 = "Бийска";
		regionDealer2 = "Бийска и Алтайского края";
	} else if ( region == 'Рубцовск' ) {
		regionHeader = "Рубцовску и Алтайскому краю";
		regionDiscount = "в Рубцовске";
		regionDelivery = "в Рубцовск и Алтайский край";
		regionDealer1 = "Рубцовска";
		regionDealer2 = "Рубцовска и Алтайског края";
		regionHeader = "Ангарску и Иркутской области";
		regionDiscount = "в Ангарске";
		regionDelivery = "в Ангарск и Иркутскую область";
		regionDealer1 = "Ангарска";
		regionDealer2 = "Ангарска и Иркутской области";
	} else if ( region == 'Братск' ) {
		regionHeader = "Братску и Иркутской области";
		regionDiscount = "в Братске";
		regionDelivery = "в Братск и Иркутскую область";
		regionDealer1 = "Братска";
		regionDealer2 = "Братска и Иркутской области";
	} else if ( region == 'Иркутск' ) {
		regionHeader = "Иркутску и Иркутской области";
		regionDiscount = "в Иркутске";
		regionDelivery = "в в Иркутск и Иркутскую область";
		regionDealer1 = "Иркутска";
		regionDealer2 = "Иркутска и Иркутской области";
	} else if ( region == 'Усть-Илимск' ) {
		regionHeader = "Усть-Илимску и Иркутской области";
		regionDiscount = "в Усть-Илимске";
		regionDelivery = "в в Усть-Илимск и Иркутскую область";
		regionDealer1 = "Усть-Илимска";
		regionDealer2 = "Усть-Илимска и Иркутской области";
	} else if ( region == 'Кемерово' ) {
		regionHeader = " Кемерово и Кемеровской области";
		regionDiscount = "в Кемерово";
		regionDelivery = "в Кемерово и Кемеровскую область";
		regionDealer1 = "Кемерова";
		regionDealer2 = "Кемерова и Кемеровской области";
	} else if ( region == 'Междуреченск' ) {
		regionHeader = "Междуреченску и Кемеровской области";
		regionDiscount = "в Междуреченске";
		regionDelivery = "в Междуреченск и Кемеровскую область";
		regionDealer1 = "Междуреченска";
		regionDealer2 = "Междуреченска и Кемеровской области";
	} else if ( region == 'Новокузнецк' ) {
		regionHeader = "Новокузнецку и Кемеровской области";
		regionDiscount = "в Новокузнецке";
		regionDelivery = "в Новокузнецк и Кемеровскую область";
		regionDealer1 = "Новокузнецка";
		regionDealer2 = "Новокузнецка и Кемеровской области";
	} else if ( region == 'Прокопьевск' ) {
		regionHeader = "Прокопьевску и Кемеровской области";
		regionDiscount = "в Прокопьевске";
		regionDelivery = "в Прокопьевск и Кемеровскую область";
		regionDealer1 = "Прокопьевска";
		regionDealer2 = "Прокопьевска и Кемеровской области";
	} else if ( region == 'Ачинск' ) {
		regionHeader = "Ачинску и Красноярскому краю";
		regionDiscount = "в Ачинске";
		regionDelivery = "в Ачинск и Красноярский край";
		regionDealer1 = "Ачинска";
		regionDealer2 = "Ачинска и Красноярского края";
	} else if ( region == 'Норильск' ) {
		regionHeader = "Норильску и Красноярскому краю";
		regionDiscount = "в Норильске";
		regionDelivery = "в Норильск и Красноярский край";
		regionDealer1 = "Норильска";
		regionDealer2 = "Норильска и Красноярского края";
	} else if ( region == 'Железногорск' ) {
		regionHeader = "Железногорску и Красноярскому краю";
		regionDiscount = "в Железногорске";
		regionDelivery = "в Железногорск и Красноярский край";
		regionDealer1 = "Железногорска";
		regionDealer2 = "Желеногорска и Красноярского края";
	} else if ( region == 'Кайеркан' ) {
		regionHeader = "Кайеркану и Красноярскому краю";
		regionDiscount = "в Кайеркане";
		regionDelivery = "в Кайеркан и Красноярский край";
		regionDealer1 = "Кайеркана";
		regionDealer2 = "Кайеркана и Красноярского края";
	} else if ( region == 'Бердск' ) {
		regionHeader = "Бердску и Новосибирской области";
		regionDiscount = "в Бердске";
		regionDelivery = "в Бердск и Новосибирскую область";
		regionDealer1 = "Бердска";
		regionDealer2 = "Бердска и Новосибирской области";
	} else if ( region == 'Новосибирск' ) {
		regionHeader = "Новосибирску и Новосибирской области";
		regionDiscount = "в Красноярске";
		regionDelivery = "в Красноярск и Красноярский край";
		regionDealer1 = "Новосибирска";
		regionDealer2 = "Новосибирска и Новосибирской области";
	} else if ( region == 'Омск' ) {
		regionHeader = "Омску и Омской области";
		regionDiscount = "в Омске";
		regionDelivery = "в Омск и Омскую область";
		regionDealer1 = "Омска";
		regionDealer2 = "Омска и Омской области";
	} else if ( region == 'Горно-Алтайск' ) {
		regionHeader = "Горно-Алтайску и Республике Алтай";
		regionDiscount = "в Горно-Алтайске";
		regionDelivery = "в Горно-Алтайск и Республику Алтай";
		regionDealer1 = "Горно-Алтайска";
		regionDealer2 = "Горно-Алтайска и Республики Алтай";
	} else if ( region == 'Улан-Удэ' ) {
		regionHeader = "Улан-Удэ и Республике Бурятия";
		regionDiscount = "в Улан-Удэ";
		regionDelivery = "в Улан-Удэ и Республику Бурятию";
		regionDealer1 = "Улан-Удэ";
		regionDealer2 = "Улан-Удэ и Республики Бурятия";
	} else if ( region == 'Кызыл' ) {
		regionHeader = "Кызылу и Республике Тыва";
		regionDiscount = "в Кызыле";
		regionDelivery = "в Кызыл и Республику Тыва";
		regionDealer1 = "Кызыла";
		regionDealer2 = "Кызыла и Республики Тыва";
	} else if ( region == 'Абакан' ) {
		regionHeader = "Абакану и Республике Хакассии";
		regionDiscount = "в Абакане";
		regionDelivery = "в Абакан и Республику Хакассию";
		regionDealer1 = "Абакана";
		regionDealer2 = "Абакана и Республики Хакасия";
	} else if ( region == 'Саяногорск' ) {
		regionHeader = "Саяногорску и Республике Хакассии";
		regionDiscount = "в Саяногорске";
		regionDelivery = "в Саяногорск и Республику Хакассию";
		regionDealer1 = "Саяногорска";
		regionDealer2 = "Саяногорска и Республики Хакасия";
	} else if ( region == 'Томск' ) {
		regionHeader = "Томску и Томской области";
		regionDiscount = "в Томске";
		regionDelivery = "в Томск и Томскую область";
		regionDealer1 = "Томска";
		regionDealer2 = "Томска и Томской области";
	} else if ( region == 'Северск' ) {
		regionHeader = "Северску и Томской области";
		regionDiscount = "в Северске";
		regionDelivery = "в Северск и Томскую область";
		regionDealer1 = "Северска";
		regionDealer2 = "Северска и Томской области";
	} else if ( region == 'Курган' ) {
		regionHeader = "Кургану и Курганской области";
		regionDiscount = "в Кургане";
		regionDelivery = "в Курган и Курганскую область";
		regionDealer1 = "Кургана";
		regionDealer2 = "Кургана и Курганской области";
	} else if ( region == 'Екатеринбург' ) {
		regionHeader = "Екатеринбургу и Свердловской области";
		regionDiscount = "в Екатеринбурге";
		regionDelivery = "в Екатеринбург и Свердловскую область";
		regionDealer1 = "Екатеринбурга";
		regionDealer2 = "Екатеринбурга и Свердловской области";
	} else if ( region == 'Каменск-Уральский' ) {
		regionHeader = "Каменск-Уральскому и Свердловской области";
		regionDiscount = "в Каменск-Уральском";
		regionDelivery = "в Каменск-Уральский и Свердловскую область";
		regionDealer1 = "Каменск-Уральска";
		regionDealer2 = "Каменск-Уральска и Свердловской области";
	} else if ( region == 'Нижнему Тагил' ) {
		regionHeader = "Нижнему Тагилу и Свердловской области";
		regionDiscount = "в Нижнем Тагиле";
		regionDelivery = "в Нижний Тагил и Свердловскую область";
		regionDealer1 = "Нижнего Тагила";
		regionDealer2 = "Нижнего Тагила и Свердловской области";
	} else if ( region == 'Новоуральск' ) {
		regionHeader = "Новоуральску и Свердловской области";
		regionDiscount = "в Новоуральске";
		regionDelivery = "в Новоуральск и Свердловскую область";
		regionDealer1 = "Новоуральска";
		regionDealer2 = "Новоуральска и Свердловской области";
	} else if ( region == 'Первоуральск' ) {
		regionHeader = "Первоуральску и Свердловской области";
		regionDiscount = "в Первоуральске";
		regionDelivery = "в Первоуральск и Свердловскую область";
		regionDealer1 = "Первоуральска";
		regionDealer2 = "Первоуральска и Свердловской области";
	} else if ( region == 'Тюмень' ) {
		regionHeader = "Тюмени и Тюменской области";
		regionDiscount = "в Тюмени";
		regionDelivery = "в Тюмень и Тюменскую область";
		regionDealer1 = "Тюмени";
		regionDealer2 = "Тюмени и Тюменской области";
	} else if ( region == 'Тобольск' ) {
		regionHeader = "Тобольску и Тюменской области";
		regionDiscount = "в Тобольске";
		regionDelivery = "в Тобольск и Тюменскую область";
		regionDealer1 = "Тобольска";
		regionDealer2 = "Тобольска и Тюменской области";
	} else if ( region == 'Ишим' ) {
		regionHeader = "Ишиму и Тюменской области";
		regionDiscount = "в Ишиме";
		regionDelivery = "в Ишим и Тюменскую областьй";
		regionDealer1 = "Ишима";
		regionDealer2 = "Ишима и Тюменской области";
	} else if ( region == 'Ханты-Мансийск' ) {
		regionHeader = "Ханты-Мансийску и Ханты-Мансийскому автономному округу";
		regionDiscount = "в Ханты-Мансийске";
		regionDelivery = "в Ханты-Мансийск и Ханты-Мансийский автономный округ";
		regionDealer1 = "Ханты-Мансийска";
		regionDealer2 = "Ханты-Мансийска и Ханты-Мансийского автономного округа";
	} else if ( region == 'Сургут' ) {
		regionHeader = "Сургуту и Ханты-Мансийскому автономному округу";
		regionDiscount = "в Сургуте";
		regionDelivery = "в Сургут и Ханты-Мансийский автономный округ";
		regionDealer1 = "Сургута";
		regionDealer2 = "Сургута и Ханты-Мансийского автономного округа";
	} else if ( region == 'Нижневартовск' ) {
		regionHeader = "Нижневартовску и Ханты-Мансийскому автономному округу";
		regionDiscount = "в Нижневартовске";
		regionDelivery = "в Нижневартовск  и Ханты-Мансийский автономный округ";
		regionDealer1 = "Нижневартовска";
		regionDealer2 = "Нижневартовска и Ханты-Мансийского автономного округа";
	} else if ( region == 'Челябинск' ) {
		regionHeader = "Челябинску и Челябинской области";
		regionDiscount = "в Челябинске";
		regionDelivery = "в Челябинск и Челябинскую область";
		regionDealer1 = "Челябинска";
		regionDealer2 = "Челябинска и Челябинской области";
	} else if ( region == 'Магнитогорск' ) {
		regionHeader = "Магнитогорску и Челябенской области";
		regionDiscount = "в Магнитогорске";
		regionDelivery = "в Магнитогорск и Челябинскую область";
		regionDealer1 = "Магнитогорска";
		regionDealer2 = "Магнитогорска и Челябинской области";
	} else if ( region == 'Красноярск' ) {
		regionHeader = "Красноярску и Красноярскому краю";
		regionDiscount = "в Красноярске";
		regionDelivery = "в Красноярск и Красноярский край";
		regionDealer1 = "Красноярска";
		regionDealer2 = "Красноярска и Красноярского края";
	} else if ( region == 'Миасс' ) {
		regionHeader = "Миассу и Челябенской области";
		regionDiscount = "в Миасс";
		regionDelivery = "в Миасс и Челябинскую область";
		regionDealer1 = "Миасса";
		regionDealer2 = "Миасса и Челябинской области";
	} else if ( region == 'Златоуст' ) {
		regionHeader = "Златоусту и Челябенской области";
		regionDiscount = "в Златоусте";
		regionDelivery = "в Златоуст и Челябинскую область";
		regionDealer1 = "Златоуста";
		regionDealer2 = "Златоуста и Челябинской области";
	} else if ( region == 'Сатка' ) {
		regionHeader = "Сатке и Челябинской области";
		regionDiscount = "в Сатке";
		regionDelivery = "в Сатку и Челябинскую область";
		regionDealer1 = "Сатки";
		regionDealer2 = "Сатки и Челябинской области";
	} else if ( region == 'Озерск' ) {
		regionHeader = "Озерску и Челябинской области";
		regionDiscount = "в Озерске";
		regionDelivery = "в Озерск и Челябинскую область";
		regionDealer1 = "Озерска";
		regionDealer2 = "Оерска и Челябинской области";
	} else if ( region == 'Снежинск' ) {
		regionHeader = "Снежинску и Челябинской области";
		regionDiscount = "в Снежинске";
		regionDelivery = "в Снежинск и Челябинскую область";
		regionDealer1 = "Снежинска";
		regionDealer2 = "Снежинска и Челябинской области";
	} else if ( region == 'Салехард' ) {
		regionHeader = "Салехарду и Ямало-Ненецкому автономному округу";
		regionDiscount = "в Салехарде";
		regionDelivery = "в Салехард и Ямало-Ненецкий автономный округ";
		regionDealer1 = "Салехарда";
		regionDealer2 = "Салехарда и Ямало-Ненецкого автономного округа";
	} else if ( region == 'Киров' ) {
		regionHeader = "Кирову и Кировской области";
		regionDiscount = "в Кирове";
		regionDelivery = "в Киров и Кировскую область";
		regionDealer1 = "Кирова";
		regionDealer2 = "Кирова и Кировской области";
	} else if ( region == 'Кирово-Чепецк' ) {
		regionHeader = "Кирово-Чепецку и Кировской области";
		regionDiscount = "в Кирово-Чепецке";
		regionDelivery = "в Кирово-Чепецк и Кировскую область";
		regionDealer1 = "Кирова-Чепецка";
		regionDealer2 = "Кирова-Чепецка и Кировской области";
	} else if ( region == 'Йошкар-Ола' ) {
		regionHeader = "Йошкар-Оле и Республике Марий Эл";
		regionDiscount = "в Йошкар-Оле";
		regionDelivery = "в Йошкар-Олу и Республику Марий Эл";
		regionDealer1 = "Йошкар-Олы";
		regionDealer2 = "Йошкал-Олы и Республики Марий Эл";
	} else if ( region == 'Арзамас' ) {
		regionHeader = "Арзамасу и Нижегородской области";
		regionDiscount = "в Арзамасе";
		regionDelivery = "в Арзамас и Нижегородскую область";
		regionDealer1 = "Арзамаса";
		regionDealer2 = "Арзамаса и Нижегородской области";
	} else if ( region == 'Нижний Новгород' ) {
		regionHeader = "Нижнему Новгороду и Нижегородской областии";
		regionDiscount = "в Нижнем Новгороде";
		regionDelivery = "в Нижний Новгород и Нижегородскую область";
		regionDealer1 = "Нижнего Новгорода";
		regionDealer2 = "Нижнего Новгорода и Нижегородской области";
	} else if ( region == 'Саров' ) {
		regionHeader = "Сарову и Нижегородской области";
		regionDiscount = "в Сарове";
		regionDelivery = "в Саров и  Нижегородскую область";
		regionDealer1 = "Сарова";
		regionDealer2 = "Сарова и Нижегородской области";
	} else if ( region == 'Дзержинск' ) {
		regionHeader = "Дзержинску и Нижегородской области";
		regionDiscount = "в Дзержинске";
		regionDelivery = "в Дзержинск и Нижегородскую область";
		regionDealer1 = "Дзержинска";
		regionDealer2 = "Дзержинска и Нижегородской области";
	} else if ( region == 'Сатис' ) {
		regionHeader = "Сатис и Нижегородской области";
		regionDiscount = "в Сатис";
		regionDelivery = "в Сатис и Нижегородскую область";
		regionDealer1 = "Сатиса";
		regionDealer2 = "Сатиса и Нижегородской области";
	} else if ( region == 'Кстово' ) {
		regionHeader = "Кстово и Нижегородской области";
		regionDiscount = "в Кстово";
		regionDelivery = "в Кстово и Нижегородскую область";
		regionDealer1 = "Кстово";
		regionDealer2 = "Кстово и Нижегородской области";
	} else if ( region == 'Выкса' ) {
		regionHeader = "Выкса и Нижегородской области";
		regionDiscount = "в Выксе";
		regionDelivery = "в Выксу и Нижегородскую область";
		regionDealer1 = "Выксы";
		regionDealer2 = "Выксы и Нижегородской области";
	} else if ( region == 'Киров' ) {
		regionHeader = "Кирову и Кировской области";
		regionDiscount = "в Кирове";
		regionDelivery = "в Киров и Кировскую область";
		regionDealer1 = "Оренбурга";
		regionDealer2 = "Оренбурга и Оренбургской области";
	} else if ( region == 'Оренбург' ) {
		regionHeader = "Оренбургу и Оренбургской области";
		regionDiscount = "в Оренбурге";
		regionDelivery = "в Оренбург и Оренбургскую область";
		regionDealer1 = "Орска";
		regionDealer2 = "Орска и Оренбургской области";
	} else if ( region == 'Киров' ) {
		regionHeader = "Кирову и Кировской области";
		regionDiscount = "в Кирове";
		regionDelivery = "в Киров и Кировскую область";
		regionDealer1 = "Кирова";
		regionDealer2 = "Кирова и Кировской области";
	} else if ( region == 'Орск' ) {
		regionHeader = "Орску и Оренбургской области";
		regionDiscount = "в Орске";
		regionDelivery = "в Орск и Оренбургскую область";
		regionDealer1 = "Орска";
		regionDealer2 = "Орска и Оренбургской области";
	} else if ( region == 'Соликамск' ) {
		regionHeader = "Соликамску и Пермскому краю";
		regionDiscount = "в Соликамске";
		regionDelivery = "в Соликамск и Пермский край";
		regionDealer1 = "Соликамска";
		regionDealer2 = "Соликамска м Перского края";
	} else if ( region == 'Уфа' ) {
		regionHeader = "Уфе и Республике Башкортостан";
		regionDiscount = "в Уфе";
		regionDelivery = "в Уфу и Республику Башкортостан";
		regionDealer1 = "Уфы";
		regionDealer2 = "Уфы и Республики Башкортостан";
	} else if ( region == 'Нефтекамск' ) {
		regionHeader = "Нефтекамску и Республике Башкортостан";
		regionDiscount = "в Нефтекамске";
		regionDelivery = "в Нефтекамск и Республику Башкортостан";
		regionDealer1 = "Нефтекамска";
		regionDealer2 = "Нефтекаменска и Республики Башкортостан";
	} else if ( region == 'Стерлитамак' ) {
		regionHeader = "Стерлитамаку и Республике Башкортостан";
		regionDiscount = "в Стерлитамаке";
		regionDelivery = "в Стерлитамак и Республику Башкортостан";
		regionDealer1 = "Стерлитамака";
		regionDealer2 = "Стерлитамака и Республики Башкортостан";
	} else if ( region == 'Саранск' ) {
		regionHeader = "Саранску и Республике Мордовия";
		regionDiscount = "в Саранске";
		regionDelivery = "в Саранск и Республику Мордовия";
		regionDealer1 = "Саранска";
		regionDealer2 = "Саранска и Республики Мордовия";
	} else if ( region == 'Казан' ) {
		regionHeader = "Казани и Республике Татарстан";
		regionDiscount = "в Казани";
		regionDelivery = "в Казань и Республику Татарстан";
		regionDealer1 = "Казани";
		regionDealer2 = "Казани и Республики Татарстан";
	} else if ( region == 'Киров' ) {
		regionHeader = "Кирову и Кировской области";
		regionDiscount = "в Кирове";
		regionDelivery = "в Киров и Кировскую область";
		regionDealer1 = "Кирова";
		regionDealer2 = "Кирова и Кировской области";
	} else if ( region == 'Нижнекамск' ) {
		regionHeader = "Нижнекамску и Республике Татарстан";
		regionDiscount = "в Нижнекамске";
		regionDelivery = "в Нижнекамск и  Республику Татарстан";
		regionDealer1 = "Нижнекамска";
		regionDealer2 = "Нижнекаменска и Республики Татарстан";
	} else if ( region == 'Елабугеа' ) {
		regionHeader = "Елабуге и Республике Татарстан";
		regionDiscount = "в Елабуге";
		regionDelivery = "в Елабугу и  Республику Татарстан";
		regionDealer1 = "Елабуги";
		regionDealer2 = "Елабуги и Республики Татарстан";
	} else if ( region == 'Альметьевск' ) {
		regionHeader = "Альметьевску и Республике Татарстан";
		regionDiscount = "в Альметьевске";
		regionDelivery = "в Альметьевске и Республике Татарстан";
		regionDealer1 = "Альметьевска";
		regionDealer2 = "Альтемьевска и Республики Татарстан";
	} else if ( region == 'Бугульма' ) {
		regionHeader = "Бугульме  и Республике Татарстан";
		regionDiscount = "в Бугульме";
		regionDelivery = "в Бугульму и Республику Татарстан";
		regionDealer1 = "Бугульмы";
		regionDealer2 = "Бугульмы и Республики Татарстан";
	} else if ( region == 'Зеленодольск' ) {
		regionHeader = "Зеленодольску и Республике Татарстан";
		regionDiscount = "в Зеленодольске";
		regionDelivery = "в Зеленодольск и Республику Татарстан";
		regionDealer1 = "Зеленодольска";
		regionDealer2 = "Зеленодольска и Республики Татарстан";
	} else if ( region == 'Чистополь' ) {
		regionHeader = "Чистополю и Республике Татарстан";
		regionDiscount = "в Чистополе";
		regionDelivery = "в  Чистополь и Республику Татарстан";
		regionDealer1 = "Чистополя";
		regionDealer2 = "Чистопля и Республики Татарстан";
	} else if ( region == 'Самара' ) {
		regionHeader = "Самаре и Самарской области";
		regionDiscount = "в Самаре";
		regionDelivery = "в Самару и Самарскую область";
		regionDealer1 = "Самары";
		regionDealer2 = "Самары и Самарской области";
	} else if ( region == 'Тольятти' ) {
		regionHeader = "Тольятти и Самарской области";
		regionDiscount = "в Тольятти";
		regionDelivery = "в Тольятти и Самарскую область";
		regionDealer1 = "Тольятти";
		regionDealer2 = "Тольятти и Самарской области";
	} else if ( region == 'Сызрань' ) {
		regionHeader = "Сызрани и Самарской области";
		regionDiscount = "в Сызрани";
		regionDelivery = "в Сызрань и Самарскую область";
		regionDealer1 = "Сызрани";
		regionDealer2 = "Сызрани и Самарской области";
	} else if ( region == 'Жигулевск' ) {
		regionHeader = "Жигулевску и Самарской области";
		regionDiscount = "в Жигулевске";
		regionDelivery = "в Жигулевск и Самарскую область";
		regionDealer1 = "Жигулевска";
		regionDealer2 = "Жигулевска и Самарской области";
	} else if ( region == 'Саратов' ) {
		regionHeader = "Саратову и Саратовской области";
		regionDiscount = "в Саратове";
		regionDelivery = "в Саратов и Саратовскую область";
		regionDealer1 = "Саратова";
		regionDealer2 = "Саратова и Саратовской области";
	} else if ( region == 'Балаково' ) {
		regionHeader = "Балаково и Саратовской области";
		regionDiscount = "в Балаково";
		regionDelivery = "в Балаково и Саратовскую область";
		regionDealer1 = "Балаково";
		regionDealer2 = "Балаково и Саратовской области";
	} else if ( region == 'Энгельс' ) {
		regionHeader = "Энгельсу и Саратовской области";
		regionDiscount = "в Энгельсе";
		regionDelivery = "в Энгельс и Саратовскую область";
		regionDealer1 = "Энгельса";
		regionDealer2 = "Энгельса и Саратовской области";
	} else if ( region == 'Ижевск' ) {
		regionHeader = "Ижевску и Республике Удмуртия";
		regionDiscount = "в Ижевске";
		regionDelivery = "в Ижевск и Республику Удмуртию";
		regionDealer1 = "Ижевска";
		regionDealer2 = "Ижевска и Республики Удмуртия";
	} else if ( region == 'Глазов' ) {
		regionHeader = "Глазову и Республике Удмуртия";
		regionDiscount = "в Глазове";
		regionDelivery = "в Глазов и Республику Удмуртию";
		regionDealer1 = "Глазова";
		regionDealer2 = "Глазова и Республики Удмуртия";
	} else if ( region == 'Сарапул' ) {
		regionHeader = "Сарапулу и Республике Удмуртия";
		regionDiscount = "в Сарапуле";
		regionDelivery = "в Сарапул и Республику Удмуртию";
		regionDealer1 = "Сарапула";
		regionDealer2 = "Сарапула и Республики Удмуртия";
	} else if ( region == 'Ульяновск' ) {
		regionHeader = "Ульяновску и Ульяновской области";
		regionDiscount = "в Ульяновске";
		regionDelivery = "в Ульяновск и Ульяновскую область";
		regionDealer1 = "Ульяновска";
		regionDealer2 = "Ульяновска и Ульяновской области";
	} else if ( region == 'Димитровград' ) {
		regionHeader = "Димитровграду и Ульяновской области";
		regionDiscount = "в Димитровграде";
		regionDelivery = "в Димитровград и Ульяновскую область";
		regionDealer1 = "Димитровграда";
		regionDealer2 = "Дмитровграда и Ульяновской области";
	} else if ( region == 'Чебоксары' ) {
		regionHeader = "Чебоксарам и Республике Чувашии";
		regionDiscount = "в Чебоксарах";
		regionDelivery = "в Чебоксары и Республику Чувашию";
		regionDealer1 = "Чебоксар";
		regionDealer2 = "Чебоксар и Республики Чувашия";
	} else if ( region == 'Астрахань' ) {
		regionHeader = "Астрахани и Астраханской области";
		regionDiscount = "в Астрахани";
		regionDelivery = "в Астрахань и Астраханскую область";
		regionDealer1 = "Астрахани";
		regionDealer2 = "Астрахани и Астраханской области";
	} else if ( region == 'Волгоград' ) {
		regionHeader = "Волгограду и Волгоградской области";
		regionDiscount = "в Волгограде";
		regionDelivery = "в Волгоград и Волгоградскую область";
		regionDealer1 = "Волгограда";
		regionDealer2 = "Волгограда и Волгоградской области";
	} else if ( region == 'Волжский' ) {
		regionHeader = "Волжскому и Волгоградской области";
		regionDiscount = "в Волжском";
		regionDelivery = "в Волжский и Волгоградскую область";
		regionDealer1 = "Волжского";
		regionDealer2 = "Волжского и Волгоградской области";
	} else if ( region == 'Анапа' ) {
		regionHeader = "Анапе и Краснодарскому краю";
		regionDiscount = "в Анапе";
		regionDelivery = "в Анапу и Краснодарский край";
		regionDealer1 = "Анапы";
		regionDealer2 = "Анапы и Краснодарского края";
	} else if ( region == 'Краснодар' ) {
		regionHeader = "Краснодару и Краснодарскому краю";
		regionDiscount = "в Краснодаре";
		regionDelivery = "в в Краснодар и Краснодарский край";
		regionDealer1 = "Краснодара";
		regionDealer2 = "Краснодара и Краснодарского края";
	} else if ( region == 'Новороссийск' ) {
		regionHeader = "Новороссийску и Краснодарскому краю";
		regionDiscount = "в Новороссийске";
		regionDelivery = "в Новороссийск и Краснодарский край";
		regionDealer1 = "Новороссийска";
		regionDealer2 = "Новороссийска и Краснодарского края";
	} else if ( region == 'Сочи' ) {
		regionHeader = "Сочи и Краснодарскому краю";
		regionDiscount = "в Сочи";
		regionDelivery = "в Сочи и Краснодарский край";
		regionDealer1 = "Сочи";
		regionDealer2 = "Сочи и Краснодарского края";
	} else if ( region == 'Туапсе' ) {
		regionHeader = "Туапсе и Краснодарскому краю";
		regionDiscount = "в Туапсе";
		regionDelivery = "в Туапсе и Краснодарский край";
		regionDealer1 = "Туапсе";
		regionDealer2 = "Туапсе и Краснодарского края";
	} else if ( region == 'Геленджик' ) {
		regionHeader = "Геленджику и Краснодарскому краю";
		regionDiscount = "в Геленджике";
		regionDelivery = "в Геленджик и Краснодарский край";
		regionDealer1 = "Геленджика";
		regionDealer2 = "Геленджика и Краснодарского края";
	} else if ( region == 'Армавир' ) {
		regionHeader = "Армавиру и Краснодарскому краю";
		regionDiscount = "в Армавире";
		regionDelivery = "в Армавир и Краснодарский край";
		regionDealer1 = "Армавира";
		regionDealer2 = "Армавира и Краснодарского края";
	} else if ( region == 'Ейск' ) {
		regionHeader = "Ейску и Краснодарскому краю";
		regionDiscount = "в Ейске";
		regionDelivery = "в Ейск и Краснодарский край";
		regionDealer1 = "Ейска";
		regionDealer2 = "Ейска и Краснодарского края";
	} else if ( region == 'Майкоп' ) {
		regionHeader = "Майкопу и Республике Адыгее";
		regionDiscount = "в Майкопе";
		regionDelivery = "в Майкоп  и Республику Адыгею";
		regionDealer1 = "Майкопа";
		regionDealer2 = "Майкопа и Республики Адыгея";
	} else if ( region == 'Махачкала' ) {
		regionHeader = "Махачкале и Республике Дагестан";
		regionDiscount = "в Махачкале";
		regionDelivery = "в Махачкалу и Республику Дагестан";
		regionDealer1 = "Махачкалы";
		regionDealer2 = "Махачкалы и Республики Дагестан";
	} else if ( region == 'Назрань' ) {
		regionHeader = "Назрани и Республике Ингушетии";
		regionDiscount = "в Назрани";
		regionDelivery = "в Назрань и Республику Ингушетию";
		regionDealer1 = "Назрани";
		regionDealer2 = "Назрани и Республики Ингушения";
	} else if ( region == 'Нальчик' ) {
		regionHeader = "Нальчику и Кабардино-Балкарии";
		regionDiscount = "в Нальчике";
		regionDelivery = "в Нальчик и Кабардино-Балкарию";
		regionDealer1 = "Нальчика";
		regionDealer2 = "Нальчика и Кабардино-Балкарии";
	} else if ( region == 'Элиста' ) {
		regionHeader = "Элисте и Республике Калмыкии";
		regionDiscount = "в Элисте";
		regionDelivery = "в Элисту и Республику Калмыкию";
		regionDealer1 = "Элисты";
		regionDealer2 = "Элисты и Республики Калмыкия";
	} else if ( region == 'Черкесск' ) {
		regionHeader = "Черкесску и Карачаево-Черкесии";
		regionDiscount = "в Черкесске";
		regionDelivery = "в Черкесск и Карачаево-Черкесию";
		regionDealer1 = "Черкесска";
		regionDealer2 = "Черкесска и Карачаево-Черкесии";
	} else if ( region == 'Владикавказ' ) {
		regionHeader = "Владикавказу и Северной Осетии";
		regionDiscount = "в Владикавказе";
		regionDelivery = "в Владикавказ и Северную Осетию";
		regionDealer1 = "Владикавказа";
		regionDealer2 = "Владиказа и Северной Осетии";
	} else if ( region == 'Ростову-на-Дону' ) {
		regionHeader = "Ростову-на-Дону и Ростовской области";
		regionDiscount = "в Ростове-на-Дону";
		regionDelivery = "в Ростов-на-Дону и Ростовскую область";
		regionDealer1 = "Ростова-на-Дону";
		regionDealer2 = "Ростова-на-Дону и Ростовской области";
	} else if ( region == 'Шахты' ) {
		regionHeader = "Шахты и Ростовской области";
		regionDiscount = "в Шахты";
		regionDelivery = "в Шахты и Ростовскую область";
		regionDealer1 = "Шахт";
		regionDealer2 = "Шахт и Ростовской области";
	} else if ( region == 'Новочеркасск' ) {
		regionHeader = "Новочеркасску и Ростовской области";
		regionDiscount = "в Новочеркасске";
		regionDelivery = "в Новочеркасск и Ростовскую область";
		regionDealer1 = "Новочеркасска";
		regionDealer2 = "Новочеркасска и Ростовской области";
	} else if ( region == 'Волгодонск' ) {
		regionHeader = "Волгодонску и Ростовской области";
		regionDiscount = "в Волгодонске";
		regionDelivery = "в Волгодонск и Ростовскую область";
		regionDealer1 = "Волгодонска";
		regionDealer2 = "Волгодонска и Ростовской области";
	} else if ( region == 'Каменск-Шахтинский' ) {
		regionHeader = "Каменск-Шахтинскому и Ростовской области";
		regionDiscount = "в Каменск-Шахтинском";
		regionDelivery = "в Каменск-Шахтинский и Ростовскую область";
		regionDealer1 = "Каменска-Шахтинска";
		regionDealer2 = "Каменка-Шахтинска и Ростовской области";
	} else if ( region == 'Ставрополь' ) {
		regionHeader = "Ставрополю и Ставропольскому краю";
		regionDiscount = "в Ставрополе";
		regionDelivery = "в Ставрополь и Ставропольский край";
		regionDealer1 = "Ставрополя";
		regionDealer2 = "Ставрополя и Ставропольского края";
	} else if ( region == 'Пятигорск' ) {
		regionHeader = "Пятигорску и Ставропольскому краю";
		regionDiscount = "в Пятигорске";
		regionDelivery = "в Пятигорск и Ставропольский край";
		regionDealer1 = "Пятигорска";
		regionDealer2 = "Пятигорска и Ставропольского края";
	} else if ( region == 'Минеральные Воды' ) {
		regionHeader = "г.Минеральные Воды и  Ставропольскому краю";
		regionDiscount = "в Минеральных Водах";
		regionDelivery = "в Минеральные Воды и Ставропольский край";
		regionDealer1 = "Минеральных Вод";
		regionDealer2 = "Минеральных Вод и Ставропольского края";
	} else if ( region == 'Ессентуки' ) {
		regionHeader = "Ессентукам и  Ставропольскому краю";
		regionDiscount = "в Ессентуках";
		regionDelivery = "в Ессентуки и  Ставропольский край";
		regionDealer1 = "Ессентуков";
		regionDealer2 = "Есентков и Ставропольского края";
	} else if ( region == 'Кисловодск' ) {
		regionHeader = "Кисловодску и  Ставропольскому краю";
		regionDiscount = "в Кисловодске";
		regionDelivery = "в Кисловодск и  Ставропольский край";
		regionDealer1 = "Кисловодска";
		regionDealer2 = "Кисловодска и Ставропольского края";
	} else if ( region == 'Невинномысск' ) {
		regionHeader = "Невинномысску и Ставропольскому краю";
		regionDiscount = "в Невинномысске";
		regionDelivery = "в Невинномыск и Ставропольский край";
		regionDealer1 = "Невинномысска";
		regionDealer2 = "Невинномысска и Ставропольского края";
	} else if ( region == 'Грозный' ) {
		regionHeader = "Грозному и Чеченской Республике";
		regionDiscount = "в Грозном";
		regionDelivery = "в Грозный и Чеченскую Республику";
		regionDealer1 = "Грозного";
		regionDealer2 = "Грозного и Чеченской Республики";
	} else if ( region == 'Санкт-Петербург' ) {
		regionHeader = "Санкт-Петербургу и Ленинградской области";
		regionDiscount = "в Санкт-Петербурге";
		regionDelivery = "в Санкт-Петербург и Ленинградскую область";
		regionDealer1 = "Санкт-Петербурга";
		regionDealer2 = "Санкт-Петербурга и Ленинградской области";
	} else if ( region == 'Выборг' ) {
		regionHeader = "Выборгу и Ленинградской области";
		regionDiscount = "в Выборге";
		regionDelivery = "в Выборг и Ленинградскую область";
		regionDealer1 = "Выборга";
		regionDealer2 = "Выборга и Ленинградской области";
	} else if ( region == 'Гатчина' ) {
		regionHeader = "Гатчине и Ленинградской области";
		regionDiscount = "в Гатчине";
		regionDelivery = "в Гатчину и Ленинградскую область";
		regionDealer1 = "Гатчины";
		regionDealer2 = "Гатчины и Ленинградской области";
	} else if ( region == 'Архангельск' ) {
		regionHeader = "Архангельску и Архангельской области";
		regionDiscount = "в Архангельске";
		regionDelivery = "в Архангельск и Архангельскую область";
		regionDealer1 = "Архангельска";
		regionDealer2 = "Архангельска и Архангельской области";
	} else if ( region == 'Северодвинск' ) {
		regionHeader = "Северодвинску и Архангельской области";
		regionDiscount = "в Северодвинске";
		regionDelivery = "в Северодвинск и Архангельскую область";
		regionDealer1 = "Северодвинска";
		regionDealer2 = "Северодвинска и Архангельской области";
	} else if ( region == 'Вологда' ) {
		regionHeader = "Вологде и Вологодскй области";
		regionDiscount = "в Вологде";
		regionDelivery = "в Вологду и Вологодскую область";
		regionDealer1 = "Вологды";
		regionDealer2 = "Вологды и Вологодской области";
	} else if ( region == 'Череповце' ) {
		regionHeader = "Череповцу и Вологодской области";
		regionDiscount = "в Череповце";
		regionDelivery = "в Череповец и Вологодскую область";
		regionDealer1 = "Череповца";
		regionDealer2 = "Череповца и Вологодской области";
	} else if ( region == 'Калининград' ) {
		regionHeader = "Калининграду и Калининградской области";
		regionDiscount = "в Калининграде";
		regionDelivery = "в Калининград и Калининградскую область";
		regionDealer1 = "Калининграда";
		regionDealer2 = "Калининграда и Калининградской области";
	} else if ( region == 'Апатита' ) {
		regionHeader = "Апатиты и Мурманской области";
		regionDiscount = "в  Апатиты";
		regionDelivery = "в Апатиты и Мурманскую область";
		regionDealer1 = "Апатита";
		regionDealer2 = "Апатита и Мурманской области";
	} else if ( region == 'Мурманск' ) {
		regionHeader = "Мурманску и Мурманской области";
		regionDiscount = "в Мурманске";
		regionDelivery = "в Мурманск и Мурманскую область";
		regionDealer1 = "Мурманска";
		regionDealer2 = "Мурманска и Мурманской области";
	} else if ( region == 'Великий Новгород' ) {
		regionHeader = "Великому Новгороду и Новгородской области";
		regionDiscount = "в Великом Новгороде";
		regionDelivery = "в Великий Новгород и Новгородскую область";
		regionDealer1 = "Великого Новгорода";
		regionDealer2 = "Великого Новгорода и Новгородской области";
	} else if ( region == 'Псков' ) {
		regionHeader = "Пскову и Псковской области";
		regionDiscount = "в Пскове";
		regionDelivery = "в Псков и Псковскую область";
		regionDealer1 = "Пскова";
		regionDealer2 = "Пскова и Псковской области";
	} else if ( region == 'Великих Лук' ) {
		regionHeader = "Великие Луки и Псковской области";
		regionDiscount = "в Великие Луки";
		regionDelivery = "в Великие Луки и Псковскую область";
		regionDealer1 = "Великих Лук";
		regionDealer2 = "Великих Лук и Псковской области";
	} else if ( region == 'Петрозаводск' ) {
		regionHeader = "Петрозаводску и Республике Карелии";
		regionDiscount = "в Петрозаводске";
		regionDelivery = "в Петрозаводск и Республику Карелия";
		regionDealer1 = "Петрозаводска";
		regionDealer2 = "Петрозаводска и Республики Карелия";
	} else if ( region == 'Сортавала' ) {
		regionHeader = "Сортавала и Республике  Карелии";
		regionDiscount = "в Сортавала";
		regionDelivery = "в  Сортавала и Республику Карелия";
		regionDealer1 = "Сортавала";
		regionDealer2 = "Сортала и Республики Карелия";
	} else if ( region == 'Сыктывкара' ) {
		regionHeader = "Сыктывкару и Республике Коми";
		regionDiscount = "в Сыктывкаре";
		regionDelivery = "в Сыктывкар и Республику Коми";
		regionDealer1 = "Сыктывкара";
		regionDealer2 = "Сыктывкара и Республики Коми";
	} else if ( region == 'Ухта' ) {
		regionHeader = "по Ухте и Республике Коми";
		regionDiscount = "в Ухте";
		regionDelivery = "в Ухту и Республику Коми";
		regionDealer1 = "Ухты";
		regionDealer2 = "Ухты и Республики Коми";
	} else if ( region == 'Белгород' ) {
		regionHeader = "Белгороду и Белгородской области";
		regionDiscount = "в Белгороде";
		regionDelivery = "в Белгород и Белгородскую область";
		regionDealer1 = "Белгорода";
		regionDealer2 = "Белгорода и Белгородской области";
	} else if ( region == 'Старый Оскол' ) {
		regionHeader = "Старому Осколу и Белгородской области";
		regionDiscount = "в Старом Осколе";
		regionDelivery = "в Старый Оскол и Белгородскую область";
		regionDealer1 = "Старого Оскола";
		regionDealer2 = "Старого Оскола и Белгородской области";
	} else if ( region == 'Брянск' ) {
		regionHeader = "Брянску и Брянской области";
		regionDiscount = "в Брянске";
		regionDelivery = "в Брянск и Брянскую область";
		regionDealer1 = "Брянска";
		regionDealer2 = "Брянска и Брянской области";
	} else if ( region == 'Владимир' ) {
		regionHeader = "Владимиру и Владимирской области";
		regionDiscount = "в Владимире";
		regionDelivery = "в Владимир и Владимирскую область";
		regionDealer1 = "Владимира";
		regionDealer2 = "Владимира и Владимирской области";
	} else if ( region == 'Александров' ) {
		regionHeader = "Александров и  Владимирской области";
		regionDiscount = "в Александрове";
		regionDelivery = "в Александров и Владимирскую область";
		regionDealer1 = "Александрова";
		regionDealer2 = "Александрова и Владимирской области";
	} else if ( region == 'Гусь-Хрустальный' ) {
		regionHeader = "Гусь-Хрустальному и Владимирской области";
		regionDiscount = "в Гусь-Хрустальном";
		regionDelivery = "в Гусь-Хрустальный и Владимирскую область";
		regionDealer1 = "Гусь-Хрустального";
		regionDealer2 = "Гусь-Хрустального и Владимирской области";
	} else if ( region == 'Муром' ) {
		regionHeader = "Мурому и Владимирской области";
		regionDiscount = "в Муроме";
		regionDelivery = "в Муром и Владимирскую область";
		regionDealer1 = "Мурома";
		regionDealer2 = "Мурова и Владимирской области";
	} else if ( region == 'Ковров' ) {
		regionHeader = "Коврову и Владимирской области";
		regionDiscount = "в Коврове";
		regionDelivery = "в в Ковров и Владимирскую область";
		regionDealer1 = "Коврова";
		regionDealer2 = "Коврова и Владимирской области";
	} else if ( region == 'Суздаль' ) {
		regionHeader = "Суздалю и Владимирской области";
		regionDiscount = "в Суздале";
		regionDelivery = "в Суздаль и Владимирскую область";
		regionDealer1 = "Суздали";
		regionDealer2 = "Суздали и Владимирской области";
	} else if ( region == 'Воронеж' ) {
		regionHeader = "Воронежу и Воронежской области";
		regionDiscount = "в Воронеже";
		regionDelivery = "в Воронеж и Воронежскую область";
		regionDealer1 = "Воронежа";
		regionDealer2 = "Воронежа и Воронежской области";
	} else if ( region == 'Иваново' ) {
		regionHeader = "Иваново и Ивановской области";
		regionDiscount = "в Иваново";
		regionDelivery = "в в Иваново и Ивановскую область";
		regionDealer1 = "Иванова";
		regionDealer2 = "Иванова и Ивановской области";
	} else if ( region == 'Калуга' ) {
		regionHeader = "Калуге и Калужской области";
		regionDiscount = "в Калуге";
		regionDelivery = "в Калугу и Калужскую область";
		regionDealer1 = "Калуги";
		regionDealer2 = "Калуги и Калужской области";
	} else if ( region == 'Обнинск' ) {
		regionHeader = "Обнинску и Калужской области";
		regionDiscount = "в Обнинске";
		regionDelivery = "в Обнинск и Калужскую область";
		regionDealer1 = "Обнинска";
		regionDealer2 = "Обнинска и Калужской области";
	} else if ( region == 'Кострома' ) {
		regionHeader = "Костроме и Костромской области";
		regionDiscount = "в Костроме";
		regionDelivery = "в Кострому и Костромскую область";
		regionDealer1 = "Костромы";
		regionDealer2 = "Костромы и Костромской области";
	} else if ( region == 'Курск' ) {
		regionHeader = "Курску и Курской области";
		regionDiscount = "в Курске";
		regionDelivery = "в Курск и Курскую область";
		regionDealer1 = "Курска";
		regionDealer2 = "Курска и Курской области";
	} else if ( region == 'Липецк' ) {
		regionHeader = "Липецку и Липецкойобласти";
		regionDiscount = "в Липецке";
		regionDelivery = "в Липецк и Липецкую область";
		regionDealer1 = "Липецка";
		regionDealer2 = "Липецка и Липецкой области";
	} else if ( region == 'Орел' ) {
		regionHeader = "Орлу и Орловской области";
		regionDiscount = "в Орле";
		regionDelivery = "в Орёл и Орловскую область";
		regionDealer1 = "Орла";
		regionDealer2 = "Орла и Орловской области";
	} else if ( region == 'Рязань' ) {
		regionHeader = "Рязани и Рязанской области";
		regionDiscount = "в Рязани";
		regionDelivery = "в Рязань и Рязанскую область";
		regionDealer1 = "Рязани";
		regionDealer2 = "Рязани и Рязанской области";
	} else if ( region == 'Смоленск' ) {
		regionHeader = "Смоленску и Смоленской области";
		regionDiscount = "в Смоленске";
		regionDelivery = "в Смоленск и Смоленскую область";
		regionDealer1 = "Смоленска";
		regionDealer2 = "Смоленска и Смоленской области";
	} else if ( region == 'Тамбов' ) {
		regionHeader = "Тамбову  и Тамбовской области";
		regionDiscount = "в Тамбове";
		regionDelivery = "в Тамбов и Тамбовскую область";
		regionDealer1 = "Тамбова";
		regionDealer2 = "Тамбова и Тамбовской области";
	} else if ( region == 'Тверь' ) {
		regionHeader = "Твери и Тверской области";
		regionDiscount = "в Твери";
		regionDelivery = "в Тверь и Тверскую область";
		regionDealer1 = "Твери";
		regionDealer2 = "Твери и Тверской области";
	} else if ( region == 'Ржев' ) {
		regionHeader = "Ржеву и Тверской области";
		regionDiscount = "в Ржеве";
		regionDelivery = "в Ржев и Тверскую область";
		regionDealer1 = "Ржева";
		regionDealer2 = "Ржева и Тверской области";
	} else if ( region == 'Тула' ) {
		regionHeader = "Туле и Тульской области";
		regionDiscount = "в Туле";
		regionDelivery = "в Тулу и Тульскую область";
		regionDealer1 = "Тулы";
		regionDealer2 = "Тулы и Тульской области";
	} else if ( region == 'Новомосковск' ) {
		regionHeader = "Новомосковску и Тульской области";
		regionDiscount = "в Новомосковске";
		regionDelivery = "в Новомосковск и Тульскую область";
		regionDealer1 = "Новомосковска";
		regionDealer2 = "Новомосковска и Тульской области";
	} else if ( region == 'Ярославль' ) {
		regionHeader = "Ярославлю и Ярославской области";
		regionDiscount = "в Ярославле";
		regionDelivery = "в Ярославль и Ярославскую область";
		regionDealer1 = "Ярославля";
		regionDealer2 = "Ярославля и Ярославской области";
	} else if ( region == 'Рыбинск' ) {
		regionHeader = "Рыбинску и Ярославской области";
		regionDiscount = "в Рыбинске";
		regionDelivery = "в Рыбинск и Ярославскую область";
		regionDealer1 = "Рыбинска";
		regionDealer2 = "Рыбинска и Ярославской области";
	} else if ( region == 'Ростов' ) {
		regionHeader = "Ростову и Ярославской области";
		regionDiscount = "в Ростове";
		regionDelivery = "в Ростов и Ярославскую область";
		regionDealer1 = "Ростова";
		regionDealer2 = "Ростова и Ярославской области";
	} else if ( region == 'Углич' ) {
		regionHeader = "Угличу и Ярославской области";
		regionDiscount = "в Угличе";
		regionDelivery = "в Углич и Ярославскую область";
		regionDealer1 = "Углича";
		regionDealer2 = "Углича и Ярославской области";
	} else if ( region == 'Чита' ) {
		regionHeader = "Чите и Забайкальскому краю";
		regionDiscount = "в Чите ";
		regionDelivery = "в Читу и Забайкальский край";
		regionDealer1 = "Читы";
		regionDealer2 = "Читы и Забайкальского края";
	} else if ( region == 'Крым' ) {
		regionHeader = "Крымскому ФО";
		regionDiscount = "в Крымском ФО";
		regionDelivery = "в Крымский ФО";
		regionDealer1 = "Крымского ФО";
		regionDealer2 = "Крымского ФО";
	} else {
		regionHeader = "РФ и СНГ";
		regionDiscount = "";
		regionDelivery = "";
		regionDealer1 = "";
		regionDealer2 = "";
	}
} );