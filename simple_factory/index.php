<?php
/**
 * Порождающие. Простая фабрика.
 * Простая фабрика генерирует экземпляр для клиента без предоставления какой-либо логики экземпляра.
 *
 * Основная цель этого шаблона — инкапсулировать процедуру создания различных классов в одной функции,
 * которая в зависимости от переданного ей контекста возвращает необходимый объект.
 * */


//interface Door
//{
//    public function getWidth(): float;
//    public function getHeight(): float;
//}
//
//class WoodenDoor implements Door
//{
//    protected $width;
//    protected $height;
//
//    public function __construct(float $width, float $height)
//    {
//        $this->width = $width;
//        $this->height = $height;
//    }
//
//    public function getWidth(): float
//    {
//        return $this->width;
//    }
//
//    public function getHeight(): float
//    {
//        return $this->height;
//    }
//}
//class DoorFactory
//{
//    public static function makeDoor($width, $height): Door
//    {
//        return new WoodenDoor($width, $height);
//    }
//}
//
//$door = DoorFactory::makeDoor(100, 200);
//echo 'Width: ' . $door->getWidth();
//echo 'Height: ' . $door->getHeight();

/**
 * Фабрика обычно используется для создания различных вариантов базового класса.
 * Допустим, у вас есть класс кнопки — Button — и три варианта — ImageButton, InputButton и FlashButton.
 * С помощью фабрики вы можете создавать различные варианты кнопок в зависимости от ситуации.
*/

abstract class Button {
    protected $_html;

    public function getHtml()
    {
        return $this->_html;
    }
}

class ImageButton extends Button {
    protected $_html = "..."; // HTML-код кнопки-картинки
}

class InputButton extends Button {
    protected $_html = "..."; // HTML-код обычной кнопки (<input type="button" />);
}

class FlashButton extends Button {
    protected $_html = "..."; // HTML-код Flash-кнопки
}

class ButtonFactory
{
    public static function createButton($type)
    {
        $baseClass = 'Button';
        $targetClass = ucfirst($type).$baseClass;

        if (class_exists($targetClass) && is_subclass_of($targetClass, $baseClass)) {
            return new $targetClass;
        } else {
            throw new Exception("The button type '$type' is not recognized.");
        }
    }
}

$buttons = array('image','input','flash');
foreach($buttons as $b) {
    echo ButtonFactory::createButton($b)->getHtml();
}
