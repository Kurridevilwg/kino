<?
include_once './layouts/head.php';
include './models/adminFunctions.php';
include './controllers/allProducts.php';
?>
<title>Каталог</title>
</head>

<body>
    <div class="flex flex-col min-h-screen w-full">
        <?
        include_once './layouts/header.php';
        ?>
        <main class="w-full grow">
            <h2>Корзина</h2>
            <? if (!empty($_SESSION['cart'])) : ?>
                <table class="table-fixed">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Картинка</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Редактировать</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        foreach ($_SESSION['cart'] as $id => $item) :
                        ?>
                            <tr>
                                <td><?= $item['title'] ?></td>
                                <td><img style="width: 100px;" src='./assets/img/products/<?= $item['img'] ?>'></td>
                                <td><?= $item['price'] ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td class="p-3 h-[fit-content]">
                                    <div class="flex flex-col items-center justify-center md:flex-row gap-2">
                                        <a href="#" id="addFromCardElem" onclick="addFromCard(<?= $id ?>)" class="p-2 bg-[#339900] text-white  rounded text-[12px]">Добавить</a>
                                        <a href="#" id="removeFromCardElem" onclick="removeFromCard(<?= $id ?>)" class="p-2 bg-[#339900] text-white  rounded text-[12px]">Удалить</a>
                                        <a href="#" id="removeAllFromCardElem" onclick="removeAllFromCard(<?= $id ?>, <?= $item['qty'] ?>)" class="p-2 bg-[#339900] text-white  rounded text-[12px]">Удалить все</a>
                                    </div>
                                </td>
                            </tr>
                        <? endforeach; ?>
                    </tbody>
                </table>
            <? else : ?>
                <p>Корзина пуста</p>
            <? endif; ?>
            <form id="order_form">
                <select name="payment" id="">
                    <option value="Картой при получении">Картой при получении</option>
                    <option value="Наличкой">Наличкой</option>
                </select>
                <input type="text" name="address" placeholder="Улица доставки">
                <input type="text" name="check_password" placeholder="Введите ваш пароль">
                <button type="submit">Купить</button>
            </form>
            <p id="error_order"></p>
        </main>
        <?
        include_once './layouts/footer.php';
        ?>
    </div>
</body>
<script src="./assets/js/order.js"></script>
<script>
    document.getElementById('removeFromCardElem').addEventListener('click', (e) => {
        e.preventDefault();
    });
    document.getElementById('allFromCardElem').addEventListener('click', (e) => {
        e.preventDefault();
    });
    async function removeAllFromCard(id, count) {
        let response = await fetch(`./controllers/removeFromCard.php?id=${id}&count=${count}&remove=all`);
        let text = await response.text();
        response = JSON.parse(text);
        if (response.code === 'ok') {

        }
        //console.log(JSON.parse(text));
        location.reload();
    }
    async function removeFromCard(id) {
        let response = await fetch(`./controllers/removeFromCard.php?id=${id}&remove=one`);
        let text = await response.text();
        response = JSON.parse(text);
        if (response.code === 'ok') {

        }
        console.log(JSON.parse(text));
        location.reload();
    }

    async function addFromCard(id) {
        let response = await fetch(`./controllers/addFromCard.php?id=${id}`);
        let text = await response.text();
        console.log(text)
        response = JSON.parse(text);
        if (response.code === 'ok') {
            location.reload();
        } else {
            alert(`На складе лишь ${response.count} товаров`);
        }
        console.log(JSON.parse(text));

    }
</script>

</html>