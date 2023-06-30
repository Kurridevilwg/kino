<?
include_once './layouts/head.php';
?>
<title>Авторизация</title>
</head>

<body>
    <div class="flex flex-col min-h-screen w-full">
        <?
        include_once './layouts/header.php';
        ?>
        <main class="w-full grow">
            <div class="relative flex min-h-full text-gray-800 antialiased flex-col justify-center overflow-hidden py-6 sm:py-12">
                <div class="relative py-3 sm:w-[450px] mx-auto text-center">
                    <form id="auth_form">
                        <span class="text-2xl font-light ">Войти</span>
                        <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                            <div class="h-2 bg-[#4D9A9A] rounded-t-md"></div>
                            <div class="px-8 py-6">
                                <label class="block font-semibold">Логин</label>
                                <input type="text" name="login" placeholder="Введите ваш логин" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <label class="block mt-3 font-semibold">Пароль</label>
                                <input type="password" name="password" placeholder="Введите пароль" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <div class="flex justify-between items-baseline">
                                    <button class="mt-4 bg-[#4D9A9A] text-white py-2 px-6 rounded-md hover:bg-[#3F7777] pointer">Войти</button>
                                    <span class="text-sm">Нет аккаунта? <a href="./registration.php" class="text-sm hover:underline">Зарегистрироваться</a></span>
                                </div>
                                <div class="hidden my-3" id="error_block_auth"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?
        include_once './layouts/footer.php';
        ?>
    </div>
</body>
<script src="./assets/js/auth.js"></script>
</html>