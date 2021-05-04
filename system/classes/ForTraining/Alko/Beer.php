<?php  // позднестатическое связывание
    class Beer
    {
        const NAME = 'Beer!';

        public static function getName()
        {   // self всегда возвращает то, что было описано в классе-родителе, т.е. там, где он был создан
            // поэтому будет beer beer
            return self::NAME;
        }

        public static function getStaticName()
        {   // static возвращает то, что было описано в вызываемом классе
            return static::NAME;
        }
    }

// статические св-ва и методы принадлежат классам, а не объектам
// вызываются от имени класса в контексте (в коде, вне класса) через ::
// создаем статические св-ва и методы с помощью ключевого слова static
// константы - статические переменные
// обращение внутри класса к статическим св-вам и методам можно с помощью static и self
// static указывает на тот класс, от которого вызывается
// self указывает на тот класс, внутри которого создан метод
// для чего: чтобы из класса-потомка, в котором есть перезаписанные св-ва, методы, константы из класса-родителя, 
// иметь возможность обратиться к этим св-вам, методам, константам класса-родителя.