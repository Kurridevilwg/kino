<?
include_once './admin_head.php';
include_once '../models/adminFunctions.php';
?>
<title>Админ панель</title>
</head>

<body>
    <div class="flex flex-col min-h-screen w-full">
        <?
        include_once './admin_header.php';
        ?>
        <main class="w-full grow">
            <form id="create_form">
                <input type="text" name="title" required placeholder="Название продукта">
                <input type="file" name="img" id="img" required>
                <input type="text" name="description" required placeholder="Описание проекта">
                <input type="number" name="price" required placeholder="Цена">
                <input type="number" name="count" required placeholder="Кол-во товара">
                <button type="submit">Добавить</button>
            </form>
            <? include '../controllers/allProducts.php'?>
            <p id="error_product"></p>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Опции</th>
                    </tr>
                </thead>
                <tbody>
                    <?foreach($products as $product):?>
                        <form  action="../controllers/updateProduct.php?id=<?=$product['id']?>" method="post" enctype="multipart/form-data">
                    <tr>
                        <td><?=$product['id']?></td>
                        <td><input type="text" name="title" value="<?=$product['title']?>"></td>
                        <td>
                            <img style="width: 100px;" src="../assets/img/products/<?=$product['img']?>">
                            <input type="file" name="img">
                        </td>
                        <td><input type="text" name="description" value="<?=$product['description']?>"></td>
                        <td><input type="number" name="price" value="<?=$product['price']?>"></td>
                        <td><input type="number" name="count" value="<?=$product['count']?>"></td>
                        <td>
                            <button type="submit">Обновить</button>
                            <a href="../controllers/deleteProduct.php?id=<?=$product['id']?>">Удалить</a>
                        </td>
                    </tr>
                    </form>
                    <?endforeach;?>
                </tbody>
            </table>
        </main>

        <?
        include_once './admin_footer.php';
        ?>
    </div>
</body>
<script src="../assets/js/create_product.js"></script>

</html>