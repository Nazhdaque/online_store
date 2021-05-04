<?php
    class Connect {
        public function __construct() {
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$link) {echo 'Соединение с базой данных не установлено.';}
            mysqli_set_charset($link, 'utf8mb4');
            $this->link = $link;
        }

        public function getConnect() {
            return $this->link;
        }
    }