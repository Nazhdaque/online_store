<?php

    abstract class Unit {
        private $id;
        private $data;
        
        public function __construct($id = null) {
            $this->id = $id;
        }

        public function getTable($table) {
            $this->table = $table;
        }
        
        public function setTable() {
            return $this->table;
        }

        public function getElements() {
            $connect = new Connect();
            $result = mysqli_query($connect->getConnect(), 'SELECT * FROM '.$this->setTable());
            return $result; 
        }
        
        public function getData() {
            $connect = new Connect();
            $result = mysqli_query($connect->getConnect(), "SELECT * FROM ".$this->setTable()." WHERE id=".$this->id);
            $row = mysqli_fetch_assoc($result);
            $this->data = $row; // кешируем
        }

        public function getField($field) {
            if (!$this->data) {
                $this->getData();
            }
            return ($this->data)[$field];
        }
        
        public function title() {
            return $this->getField('title');
        }

        public function photo() {
            return $this->getField('photo');
        }









        
        // // магический метод - вызывается автоматически при создании экземпляра класса
        // //  = null - параметр в скобках факультативный (не обязателен или заранее неизвестен)
        // public function __construct($id = null)
        // {
        //     $this->id = $id;
        // }
        
        // // магический метод - вызывается автоматически при попытке считать непубличное св-во
        // public function __get($name) {
        //     echo 'Произошел доступ к непубличным свойствам!<br>';
        //     return $this->$name;
        // }

        // // магический метод - вызывается автоматически при попытке перезаписать непубличное св-во
        // public function __set($name, $value) {
        //     echo 'Произошла попытка изменить непубличное свойство!<br>';
        //     $this->$name = $value;
        // }

        // тестовый метод "найти статью по заголовку" (посмотреть, как работает = null)
        // public function getElementByTitle($title) {
        //     // копируем все подключение
        //     $link = mysqli_connect('localhost', 'root', '', 'store');
        //     if (!$link) {echo 'Соединение с базой данных не установлено.';}
        //     mysqli_set_charset($link, 'utf8mb4');
        //     $result = mysqli_query($link,"  SELECT id 
        //                                     FROM ".$this->setTable()." 
        //                                     WHERE title='$title'");
        //     $row = mysqli_fetch_assoc($result);
        //     $this->id = $row['id'];
        // }
        
        // public function getId($id) {
        //     $this->id = $id;
        // }
    }