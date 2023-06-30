<?
include_once './layouts/head.php';
include_once './models/shop.php';
$order = $_GET['order'];
include_once './controllers/getOrderList.php';
include_once './controllers/getOrderNumber.php';
?>
<title>Заказ: <?= $order ?></title>
</head>

<body>
    <div class="flex flex-col min-h-screen w-full">
        <?
        include_once './layouts/header.php';
        ?>
        <main class="w-full grow">
            <h2>Заказ: <?= $order ?></h2>
            <p>Цена заказа: <?=$orderInfo['price_order']?></p>
            <p>Время заказа: <?=date("d-m-Y H:i:s",$orderInfo['date'])?></p>
            <p>Адресс доставки: <?=$orderInfo['address']?></p>
            <p>Метод оплаты: <?=$orderInfo['payment_method']?></p>
            <p>Статус заказа: <?=$orderInfo['status']?></p>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">Название</th>
                                        <th scope="col" class="px-6 py-4">Количество</th>
                                        <th scope="col" class="px-6 py-4">За одну штуку</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($products as $product) : ?>
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4"><?=$product['name_product']?></td>
                                        <td class="whitespace-nowrap px-6 py-4"><?=$product['qty']?></td>
                                        <td class="whitespace-nowrap px-6 py-4"><?=$product['price_product']?></td>
                                    </tr>
                                    <? endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <?
        include_once './layouts/footer.php';
        ?>
    </div>
</body>

</html>