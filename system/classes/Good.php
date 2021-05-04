<?php
    class Good extends Unit {   
        public function setTable() {
            return 'core_goods';
        }
    
        public function price() {
            return $this->getField('price');
        }

        public function getElements() { // ФИЛЬТРЫ
            $connect = new Connect();
            $filter = '';

            if (isset($_GET['category_id'])) { // по разделам Ж / М / Д 
                $category_id = $_GET['category_id'];
                $filter .= " AND category_id = $category_id";
            }

            if (isset($_GET['goods_category_id'])) { // по товарным категориям (группам)
                $goods_category_id = $_GET['goods_category_id'];
                $filter .= " AND goods_category_id = $goods_category_id";
            }

            if (isset($_GET['new_arrival'])) { // по новинкам
                $new_arrival = $_GET['new_arrival'];
                $filter .= " AND new_arrival = $new_arrival";
            }

            if (isset($_GET['from'])) { // по ценовому диапазону
                $from = $_GET['from'];
                $up_to = $_GET['up_to'];
                $filter .= " AND `price` > $from AND `price` < $up_to";
            }

            

            $page = 1; // ПАГИНАЦИЯ // Расчет кол-ва товаров на страницу
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            $per_page = 12;
            $from = ($page - 1) * $per_page;
            
            if (isset($_GET['size'])) { // по размеру
                $size = $_GET['size'];
                $query = "SELECT core_goods.*, goods_sizes.good_id 
                            FROM core_goods 
                            RIGHT JOIN goods_sizes 
                            ON core_goods.id = goods_sizes.good_id 
                            WHERE size_id = $size $filter 
                            LIMIT $from, $per_page";
                $result = mysqli_query($connect->getConnect(), $query);
            } else {
                $result = mysqli_query($connect->getConnect(), "SELECT * FROM ".$this->setTable(). " WHERE id>0 $filter LIMIT $from, $per_page"); // дописываем LIMIT для пагинации
            }
            return $result; 
        }











        // Трерировочные константы
        const AVAILABILITY = 1;

        public static function getQuality() {
            return self::ORIGINAL;
        }

        const ORIGINAL = 1;
        // тренировочный статический метод
        public static function getNote() {
            // здесь внутри класса в этой условной конструкции слово static - ссылка на сам класс (а this - ссылка на экземпляр класса)
            // if (static::ORIGINAL)
            // здесь также вместо static можно написать self
            if (self::ORIGINAL) {
                $note = "Оригинал";
            } else {
                $note = "Реплика";
            }
            echo $note;
        }

        // тренировочный статический метод со статической переменной
        public static $availability = 3;
        public static function getAvailability() {
            return self::$availability;
        }
    }