<?php
namespace forTraining\Interfaces;
// в интерфейсе могут находиться только константы и абстрактные методы (без реализации);
// в интерфейсах возможно множественное наследование в отличие от классов;
interface UnitActions {
    public function getField($field);
}