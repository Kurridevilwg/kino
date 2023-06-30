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
            <!-- Каталог -->
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-4">
                        <?
                        foreach ($products as $product) :
                            if ($product['count'] > 0) :
                        ?>

                                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                                    <a class="block relative h-48 rounded overflow-hidden">
                                        <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="./assets/img/products/<?= $product['img'] ?>">
                                    </a>
                                    <div class="mt-4">
                                        <h2 class="text-gray-900 title-font text-lg font-medium"><?= $product['title'] ?></h2>
                                        <p class="mt-1"><?= $product['price'] ?> р.</p>
                                        <button onclick="addToCard(<?= $product['id'] ?>)">В корзину</button>
                                    </div>
                                </div>
                        <?
                        endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </section>
        </main>
        <?
        include_once './layouts/footer.php';
        ?>
    </div>
</body>
<script>
    async function addToCard(id) {
        let response = await fetch(`./controllers/addToCard.php?id=${id}`);
        let text = await response.text();
        console.log(text)
        response = JSON.parse(text);
        if (response.code === 'ok') {
            productCount.innerHTML = response.qty;
            productCount.classList.remove('hidden');
        } else {
            alert(`На складе лишь ${response.count} товаров`);
        }
        console.log(JSON.parse(text));
    }
</script>

</html>