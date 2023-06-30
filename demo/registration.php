<?
include_once './layouts/head.php';
?>
<title>Регистрация</title>
</head>

<body>
    <div class="flex flex-col min-h-screen w-full">
        <?
        include_once './layouts/header.php';
        ?>
        <main class="w-full grow">
            <div class="relative flex min-h-full text-gray-800 antialiased flex-col justify-center overflow-hidden py-6 sm:py-12">
                <div class="relative py-3 sm:w-[450px] mx-auto text-center">
                    <span class="text-2xl font-light ">Зарегистрироваться</span>
                    <form id="reg_form">
                        <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                            <div class="h-2 bg-[#4D9A9A] rounded-t-md"></div>
                            <div class="px-8 py-6 ">
                                <label class="block font-semibold"> Логин </label>
                                <input type="text" name="login" placeholder="Введите ваш логин" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <label class="block mt-3 font-semibold"> Email </label>
                                <input type="email" name="email" placeholder="Введите ваш email" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <label class="block mt-3 font-semibold"> Имя </label>
                                <input type="text" name="name" placeholder="Введите ваше имя" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <label class="block mt-3 font-semibold"> Фамилия </label>
                                <input type="text" name="surname" placeholder="Введите вашу фамилию" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <label class="block mt-3 font-semibold"> Отчество </label>
                                <input type="text" name="patronymic" placeholder="Введите ваше отчество" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md">
                                <label class="block mt-3 font-semibold"> Пароль </label>
                                <input type="password" name="password" placeholder="Введите пароль" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <label class="block mt-3 font-semibold"> Повторить пароль </label>
                                <input type="password" name="passwordConfirm" placeholder="Введите пароль" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-[#4D9A9A] focus:ring-1 rounded-md" required>
                                <div class="mt-3 flex items-center justify-center"><input type="checkbox" id='rules' required><span class="ml-3">Я согласен на обработку персональных данных</span></div>
                                <div class="flex justify-center">
                                    <button class="mt-4 bg-[#4D9A9A] text-white py-2 px-6 rounded-md hover:bg-[#3F7777]">Зарегистрироваться</button>
                                </div>
                                <div class="mt-3">
                                    <span class="text-sm ">Уже есть аккаунт? <a href="./authorization.php" class="text-sm hover:underline">Войти</a></span>
                                </div>
                                <div class="hidden my-3" id="error_block_reg"></div>
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
<script src="./assets/js/reg.js"></script>

</html>