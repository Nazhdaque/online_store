<?php
    class Size extends Unit {   
        public function setTable() {
            return 'sizes';
        }

        public function getSizesInStock() {
            $connect = new Connect();
            $query = "SELECT `sizes`.*, goods_sizes.good_id 
                        FROM `sizes` 
                        RIGHT JOIN `goods_sizes` 
                        ON `sizes`.`id` = `goods_sizes`.`size_id` 
                        RIGHT JOIN `core_goods` 
                        ON `core_goods`.`id` = `goods_sizes`.`good_id` 
                        WHERE `category_id` ".((isset($_GET['category_id'])) ? "= {$_GET['category_id']}" : "> 0")."
                        GROUP BY `id` 
                        ORDER BY `sizes`.`id` ASC ";
            $result = mysqli_query($connect->getConnect(), $query);
            return $result; 
        }
    }