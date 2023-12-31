# Arduino-mouse-click

[![Latest Unstable Version](https://poser.pugx.org/Nouvu/Arduino-mouse-click/v)](https://packagist.org/packages/nouvu/Arduino-mouse-click)
[![License](https://poser.pugx.org/nouvu/Arduino-mouse-click/license)](https://packagist.org/packages/nouvu/Arduino-mouse-click)
[![Foo](https://img.shields.io/badge/README-ENGLISH-blueviolet.svg?style=flat-square)](https://github-com.translate.goog/MouseZver/Arduino-mouse-click?_x_tr_sl=ru&_x_tr_tl=en)

Новая версия: [USB HID](https://github.com/MouseZver/Arduino-hid)

Подключение:

> composer require nouvu/arduino-mouse-click

Библиотека для эмуляции физического нажатия кнопок R и L мыши с помощью Arduino Nano v3 контроллера.

Реализация подходит для тех кто ищет автоматизацию при прослушивания устройств вводов на уровне DirectInput и не может достичь виртуальной эмуляции с помощью высокоуровненой WinApi в таких приложениях, как "Аллоды Онлайн".

```
Если вам нужна полная эмуляция Клавиатуры и Мыши ( HID Input ), то см. в сторону Arduino Leonardo.
Arduino NANO не поддерживает нативно.
```

---

Вам потребуется приобрести контроллер:

> Arduino NANO V3.0 Atmega328 CH340 (пины припаяны)

-   Далее прошить контроллер [скетчем](https://github.com/MouseZver/Arduino-mouse-click/blob/master/ArduinoSketch/mouse.ino)
-   Прикрепить два провода к клик кнопкам на плате мыши, пример схемы:

![Image alt](https://github.com/MouseZver/Arduino-mouse-click/blob/master/ArduinoSketch/mouse.drawio.png)

---

PHP код:

```php
// port COM1
$mouse = new Nouvu\ArduinoNanoV3\Mouse( 1 );

// loop R button click
while ( true )
{
	$mouse -> rightClick();

	sleep ( 1 );
}
```

Методы:

-   leftClick - клик левой кнопкой.
-   rightClick - клик правой кнопкой.
-   leftDown - нажать левой кнопкой.
-   rightDown - нажать правой кнокой.
-   leftUp - отпустить левую кнопку.
-   rightUp - отпустить правую кнопку.
-   reset - отпустить обе кнопки.
-   send - отправить в контроллер сообщение/команду.
-   close - прекратить слушать порт, освободить.

Для перемещения курсора подойдет WinApi эмуляция [Windows-Nircmd](https://github.com/MouseZver/Windows-Nircmd) setcursor, movecursor.

---

LICENSE MIT
