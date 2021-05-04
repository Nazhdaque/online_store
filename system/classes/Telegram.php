<?php
    class Telegram extends Unit {
        public $data;
        public $token;

        public function __construct($token) {
            $this->token = $token;
        }

        public function setTable() {
            return 'core_orders';
        }
        
        public function getLastData() {
            $connect = new Connect();
            $last_id = mysqli_insert_id($connect->getConnect());
            $query = "SELECT * FROM ".$this->setTable()." ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($connect->getConnect(), $query);
            $row = mysqli_fetch_assoc($result);
            $this->data = $row;
            // return $this->data;
        }

        public function getField($field) {
            if (!$this->data) {   
                $this->getLastData();
            }
            return ($this->data)[$field];
        }
        
        public function create_message() {
            $order_id = $this->getField('id');
            $customer_name = $this->getField('name');
            $customer_phone = $this->getField('phone');
            $customer_email = $this->getField('email');
            $order_list = json_decode($this->getField('order_list'));

            echo (date("Y-m-d")).' в '.(date("H:i:s")).' клиент '.$customer_name.' создал заказ c id '.$order_id.'.<br>Контактная информация: '.$customer_phone.', '.$customer_email.'.<br>Состав заказа: ';

            $connect = new Connect();
            $query = "SELECT `id`, `name`, `email`, `order_list`, `order_status`, `created_at`, `processed_at` FROM `core_orders`";
            $result = mysqli_query($connect->getConnect(), $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $list = json_decode($row["order_list"]); 
                $order = [$row['id']=>[$list]];

                $connect = new Connect();
                $query = "SELECT `delivery_type`.`price`, `core_orders`.`delivery_type`
                            FROM `delivery_type`
                            RIGHT JOIN `core_orders`
                            ON `delivery_type`.`value` = `core_orders`.`delivery_type`
                            WHERE `core_orders`.`id` = {$row['id']}";
                $row2 = mysqli_query($connect->getConnect(), $query);
                $delivery = mysqli_fetch_assoc($row2);
                $delivery_price = $delivery['price'];
                $delivery_type = $delivery['delivery_type'];
                        
                foreach ($order as $key => $val) {
                    $order_item_total = [];
                    foreach ($list as $goods_id => $size_amount_arr) {
                    $good = new Good($goods_id);
                    $price = $good->getField('price');
                        foreach ($size_amount_arr as $size_id => $amount) {
                            $cost = $price * $amount;
                            $order_item_total[] = $cost;
                        }
                    }
                    if ($delivery_type == 'undefined'){
                    $delivery_price = 'не выбрано';
                    $total = array_sum($order_item_total);
                    } else {
                    $total = array_sum($order_item_total) + $delivery_price;
                    }
                }
            }        

            foreach ($order as $key => $val) {
                foreach ($order_list as $goods_id => $size_amount_arr) {
                    foreach ($size_amount_arr as $size_id => $amount) {
                        $good = new Good($goods_id);
                        $goods_id = $good->getField('id');
                        $title = $good->getField('title');
                        $price = $good->getField('price');
                        $cost = $price * $amount;

                        $size = new Size($size_id);
                        $size = $size->getField('size');
                        echo '[ <a href="http://store.com/card.php?id='.$goods_id.'" target="_blank" rel="noopener noreferrer">'.$title.'</a> ]<br>
                        Размер: .......... '.$size.'<br>
                        Количество: ... '.$amount.'<br>
                        Стоимость: ..... '.$price.' * '.$amount.' = '.$cost.'<br>
                        ===========================<br>';
                    }
                }
                echo 
                'Доставка: ....... '.$delivery_price.'<br>
                Итого: ............. '.$total;
            }
        }

        public function send_message($chat_id) {
            $token = $this->token;
            $text = $this->create_message();
            $url = "$token/sendMessage?chat_id=$chat_id&text=$text&parse_mode=HTML";
            file_get_contents($url);
        }

        public function send_photo($chat_id, $photo) {
            $token = $this->token;
            $url = "$token/sendPhoto?chat_id=$chat_id&photo=$photo&parse_mode=HTML";
            file_get_contents($url);
        }

        public function send_location($chat_id, $latitude, $longitude) {
            $token = $this->token;
            $url = "$token/sendLocation?chat_id=$chat_id&latitude=$latitude&longitude=$longitude&parse_mode=HTML";
            file_get_contents($url);
        }
    }