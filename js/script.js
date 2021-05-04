// HAMBURGER
// ==================================================
let opencount = 0;

$('.hamburger').click(function(){
    if (opencount % 2 == 0) {
        $('.nav_panel').animate({
            'left': 0,
            'right': 0
        }, 500);
    } else {
        $('.nav_panel').animate({
            'right': '-100%',
            'left': '120%'
        }, 500);
    }
    opencount++;
});






// FORMFIELDS CHECK
// ==================================================
// newsletter
// =========================
let pattern = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
let russian_alphabet = /[А-Я-Ё]/i;

$('#newsletter').submit(function(e) {
    let formField = $(this).find('[type="text"]');
    let formFieldValue = formField.val();
    let passed = pattern.test(formFieldValue) && (!russian_alphabet.test(formFieldValue));

    if (formFieldValue === '' || formFieldValue.length > 50 || !passed) {
        e.preventDefault();
    }
});

$('#newsletter [type="text"]').keyup(function(e) {
    let formField = $(this);
    let formFieldValue = formField.val();
    let passed = pattern.test(formFieldValue) && (!russian_alphabet.test(formFieldValue));

    if (formFieldValue === '' || formFieldValue.length > 50 || !passed) {
        if (formFieldValue === '') {
            $('.main_page .empty_field').css("display", "block");       // ! //
            $('.main_page .too_long').css("display", "none");
            $('.main_page .incorrect_email').css("display", "none");
        } else if (formFieldValue.length > 50) {
            $('.main_page .empty_field').css("display", "none");
            $('.main_page .too_long').css("display", "block");          // ! //
            $('.main_page .incorrect_email').css("display", "none");
        } else if (!passed) {
            $('.main_page .empty_field').css("display", "none");
            $('.main_page .too_long').css("display", "none");
            $('.main_page .incorrect_email').css("display", "block");   // ! //
        }
        e.preventDefault();
    } else {
        $('.main_page .empty_field').css("display", "none");
        $('.main_page .too_long').css("display", "none");
        $('.main_page .incorrect_email').css("display", "none");
    }
});


// basket form
// =========================
$('#order [type="text"]').keyup(function(e) {
    let formField = $(this);
    let formFieldValue = formField.val();
    let passed = pattern.test(formFieldValue) && (!russian_alphabet.test(formFieldValue));

    formField.prev('.error').remove();
    $(this).closest("div").find("p").css("color", "#303030");

    if (formFieldValue === '' || formFieldValue.length > 50) {
        if (formFieldValue === '') {
            $(this).closest("div").find("p").css("color", "red");
        } else {
            $(this).closest("div").find("p").css("color", "#303030");
        }

        if (formFieldValue.length > 50) {
            formField.closest("div").find("p").after('<span class="error">Пожалуйста, не более 50 символов.</span>');
        }
        e.preventDefault();
    }
});



$('#order [type="email"]').keyup(function(e) {
    let formField = $(this);
    let formFieldValue = formField.val();
    let passed = pattern.test(formFieldValue) && (!russian_alphabet.test(formFieldValue));

    formField.prev('.error').remove();
    $(this).closest("div").find("p").css("color", "#303030");

    if (formFieldValue === '' || formFieldValue.length > 50 || !passed) {
        if (formFieldValue === '') {
            $(this).closest("div").find("p").css("color", "red");
        } else {
            $(this).closest("div").find("p").css("color", "#303030");
        }

        if (formFieldValue.length > 50) {
            formField.closest("div").find("p").after('<span class="error">Пожалуйста, не более 50 символов.</span>');
        } else if (!passed) {
            formField.closest("div").find("p").after('<span class="error">Некорректный email.</span>');
        }
        e.preventDefault();
    }
});



// phone mask
// =========================
jQuery(function($) {
    $('[type="tel"]').mask("+7 999 999-99-99");
});






// CATALOG SELECT
// ==================================================
$('.catalog .select > div:first-child').click(function() {
    $(this).next().toggle();
    if (this.classList.contains('closed')) {
        this.classList.remove('closed');
        this.classList.add('opened');
    } else {
        this.classList.remove('opened');
        this.classList.add('closed');
    }
})










// AJAX  
// ==================================================
function renderGoods() {   
    let xhr = new XMLHttpRequest(); // XMLHttpRequest() — объект для отправки запроса из js на сервер; Создаем новый экземпляр этого класса;
    let url = 'http://store.com/inc/good.php'; // указываем, куда отправлять запрос;
    let str_get = window.location.search; // получаем значение св-ва search у объекта window.location: window.location.search возвращает GET-параметры из адресной строки на текущей странице, если они есть; берем эти GET-параметры и записываем в переменную;
    url = url + str_get; // конкатенируем к адресу и получаем готовую ссылку;
    xhr.open('GET', url, true); // запускаем метод open (устанавливаем соединение), указываем параметры запроса: тип (GET / POST), адрес (куда отправляются данные), тип запроса (синхронный (false) или асинхронный (true)); асинхронный - т.е. не связанный с процессом загрузки основной страницы.
    // xhr.setRequestHeader('Content-type', 'application/x-form-urlencode'); // задаем заголовки для нашего запроса, указываем тип контента (для POST-запросов)
    xhr.onreadystatechange = function() { // когда будет получен ответ от сервера на наш запрос, эта функция будет выводить ответ сервера. 
        if (xhr.readyState == 4 && xhr.status == 200) { // Если ответ сервера: readyState == 4 (запрос выполнен) и status == 200 (статус запроса - "ошибок нет"),
            document.getElementById('catalog').innerHTML = xhr.responseText; // вставляем на страницу товары: записываем в #catalog то, что лежит по url; ответ сервера запишется в xhr.responseText и мы его вставим в заранее подготовленную верстку; т.е. товары подгружаются с помощью js, а не в момент загрузки страницы
        }
    }
    xhr.send(null); // отправляем запрос
}

try {
    document.getElementById('catalog').innerHTML = '<img class="preloader" src="/img/preloader.gif">'; // рисуем прелоадер,
    setTimeout(function() { // делаем задержку, чтобы убедиться, что подгрузка происходит с помощью js, а не в момент загрузки страницы,
        renderGoods(); // выводим на страницу.
    }, 100);
} catch (error) {
    
}


function to_basket() {
    let xhr = new XMLHttpRequest();
    let url = 'http://store.com/handlers/to_basket.php';
    let size_id = document.querySelector('input[name="size"]:checked').value;
    let str_get = window.location.search + '&size_id=' + size_id;
    url = url + str_get;
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('items_in_the_basket').innerHTML = xhr.responseText;
            document.getElementById('items_in_the_basket_2').innerHTML = xhr.responseText;
        }
    }
    xhr.send(null);
}


function plus_basket() {
    let id = event.target.closest('[data-item_id]').getAttribute('data-item_id'); // получаем значение нашего самодельного атрибута data-item_id из basket.php. // .closest('[data-item_id]') - дописали из-за того дива, которым сделана половина крестика отмены
    let size_id = event.target.closest('[data-item_size_id]').getAttribute('data-item_size_id');
    let amount = event.target.closest('.amount').querySelector('.goods_amount');
    amount.innerHTML = Number (amount.innerHTML) + 1; // плюсуем к кол-ву;
    let xhr = new XMLHttpRequest();
    let url = 'http://store.com/handlers/to_basket.php';
    let str_get = '?id=' + id + '&size_id=' + size_id;
    url = url + str_get;
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('items_in_the_basket').innerHTML = xhr.responseText;
            document.getElementById('items_in_the_basket_2').innerHTML = xhr.responseText;
            count_basket(); // пересчет корзины после добавления единицы товара.
        }
    }
    xhr.send(null);
}


function from_basket() {   
    let id = event.target.closest('[data-item_id]').getAttribute('data-item_id'); // получаем значение нашего самодельного атрибута data-item_id из basket.php. // .closest('[data-item_id]') - дописали из-за того дива, которым сделана половина крестика отмены
    let size_id = event.target.closest('[data-item_size_id]').getAttribute('data-item_size_id');
    event.target.closest('.table_row').remove(); // скрываем со страницы товар с этим id
    let xhr = new XMLHttpRequest();
    let url = 'http://store.com/handlers/from_basket.php';
    let str_get = '?id=' + id + '&size_id=' + size_id;
    url = url + str_get;
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('items_in_the_basket').innerHTML = xhr.responseText;
            document.getElementById('items_in_the_basket_2').innerHTML = xhr.responseText;
            count_basket();
        }
    }
    xhr.send(null);
}


function minus_basket() {   
    let id = event.target.closest('[data-item_id]').getAttribute('data-item_id'); // получаем значение нашего самодельного атрибута data-item_id из basket.php. // .closest('[data-item_id]') - дописали из-за того дива, которым сделана половина крестика отмены
    let size_id = event.target.closest('[data-item_size_id]').getAttribute('data-item_size_id');
    let amount = event.target.closest('.amount').querySelector('.goods_amount');
    if (amount.innerHTML == 1) { // если товар в корзине один, 
        event.target.closest('.table_row').remove(); // скрываем со страницы товар с этим id;
    } else { // если товаров больше одного,
        amount.innerHTML = Number (amount.innerHTML) - 1; // вычитаем из количества товаров единицу;
    }
    let xhr = new XMLHttpRequest();
    let url = 'http://store.com/handlers/minus_basket.php';
    let str_get = '?id=' + id + '&size_id=' + size_id;
    url = url + str_get;
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('items_in_the_basket').innerHTML = xhr.responseText;
            document.getElementById('items_in_the_basket_2').innerHTML = xhr.responseText;
            count_basket(); // пересчет корзины после удаления единицы товара.
        }
    }
    xhr.send(null);
}


function count_basket() {   
    let xhr = new XMLHttpRequest();
    let url = 'http://store.com/handlers/count_basket.php';
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('count_basket').innerHTML = xhr.responseText;
            document.getElementById('cost').innerHTML = xhr.responseText + ' руб.';
            total_price();
        }
    }
    xhr.send(null);
}




function delivery_price() {
    let delivery_price = document.querySelector('select[name="delivery_type"] option:checked').getAttribute('data-cost');
    document.getElementById('delivery_price').innerHTML = delivery_price + ' руб.';
    total_price();
}

function total_price() {
    let del_price = parseInt(document.querySelector('select[name="delivery_type"] option:checked').getAttribute('data-cost'));
    let sum = parseInt(document.getElementById('cost').innerHTML);
    let total = del_price + sum;
    document.getElementById('total_price').innerHTML = total + ' руб.';
}

window.onload = function() {
    delivery_price();
    total_price();
};


$('.orange_button').click(function(){
    $('.orange_button').css('background-color', '#303030');
    setTimeout(function(){
        $('.orange_button').css('background-color', '#f68236');
    }, 50);
})