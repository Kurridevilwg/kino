<?
include_once './layouts/head.php';
include_once './models/shop.php';
include_once './controllers/getOrdersUser.php';
?>
<title>Личный кабинет</title>
</head>
<body>
    <div class="flex flex-col min-h-screen w-full">
        <?
        include_once './layouts/header.php';
        ?>
        <main class="w-full grow">
            <h2>Мои заказы</h2>
            <?foreach($orders as $order):?>
                <a href="./order.php?order=<?=$order['order_number']?>">Заказ: <?=$order['order_number']?></a>
            <?endforeach;?>
        </main>
        <?
        include_once './layouts/footer.php';
        ?>
    </div>
</body>

</html>