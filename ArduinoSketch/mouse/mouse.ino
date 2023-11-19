#define MOUSE_BUTTON_LEFT_CLICK "command:mouse:click:left"
#define MOUSE_BUTTON_RIGHT_CLICK "command:mouse:click:right"
#define MOUSE_BUTTON_LEFT_DOWN "command:mouse:releaseAll:left"
#define MOUSE_BUTTON_RIGHT_DOWN "command:mouse:releaseAll:right"
#define MOUSE_BUTTON_LEFT_UP "command:mouse:press:left"
#define MOUSE_BUTTON_RIGHT_UP "command:mouse:press:right"
#define MOUSE_BUTTONS_RESET "command:mouse:releaseAll:0"

#define DELAY_CLICK 50
#define __WAIT__ 50

#define PIN_D2 2
#define PIN_D3 3
#define PIN_D4 4

void setup()
{
	Serial.begin(9600);

	Serial.println("Hello! 🙂");

	pinMode(PIN_D2, OUTPUT);
	pinMode(PIN_D3, OUTPUT);
	pinMode(PIN_D4, OUTPUT);

	digitalWrite(PIN_D2, 1);
	digitalWrite(PIN_D3, 1);
	digitalWrite(PIN_D4, 0);
}

void loop()
{
	if (Serial.available() > 0)
	{
		digitalWrite(LED_BUILTIN, HIGH);
		
		String result = Serial.readStringUntil( '\n' );
		mouseAction(result);
		result = "";
		
		digitalWrite(LED_BUILTIN, LOW);
		delay(10);
	}
}

void mouseAction(String s)
{
	if ( s == MOUSE_BUTTON_LEFT_CLICK ) // Клик левой кнопкой
	{
		digitalWrite(PIN_D2, 0);
		delay(DELAY_CLICK);
		digitalWrite(PIN_D2, 1);
		Serial.println("MOUSE_BUTTON_LEFT_CLICK");
	}
	else if ( s == MOUSE_BUTTON_RIGHT_CLICK ) // Клик правой кнопкой
	{
		digitalWrite(PIN_D3, 0);
		delay(DELAY_CLICK);
		digitalWrite(PIN_D3, 1);
		Serial.println("MOUSE_BUTTON_RIGHT_CLICK");
	}
	else if ( s == MOUSE_BUTTON_LEFT_DOWN ) // Удерживать левую кнопку
	{
		digitalWrite(PIN_D2, 0);
		Serial.println("MOUSE_BUTTON_LEFT_DOWN");
	}
	else if ( s == MOUSE_BUTTON_RIGHT_DOWN ) // Удерживать правую кнопку
	{
		digitalWrite(PIN_D3, 0);
		Serial.println("MOUSE_BUTTON_RIGHT_DOWN");
	}
	else if ( s == MOUSE_BUTTON_LEFT_UP ) // Отпустить левую кнопку
	{
		digitalWrite(PIN_D2, 1);
		Serial.println("MOUSE_BUTTON_LEFT_UP");
	}
	else if ( s == MOUSE_BUTTON_RIGHT_UP ) // Отпустить правую кнопку
	{
		digitalWrite(PIN_D3, 1);
		Serial.println("MOUSE_BUTTON_RIGHT_UP");
	}
	else if ( s == MOUSE_BUTTONS_RESET ) // Сброс состояний левой/правой кнопки
	{
		digitalWrite(PIN_D2, 1);
		digitalWrite(PIN_D3, 1);
		Serial.println("MOUSE_BUTTONS_RESET");
	}
	else
	{
		// игнорировать CR+LF
		// if (byte(c) != 13 && byte(c) != 10){}
		// либо переключить монитор порта "Нет конца строки"
		Serial.println(s);
		digitalWrite(PIN_D4, 1);
		delay(__WAIT__);
		digitalWrite(PIN_D4, 0);
	}
		
}