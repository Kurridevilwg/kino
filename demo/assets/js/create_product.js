create_form.addEventListener('submit', async(e) => {
    e.preventDefault();

    let response = await fetch('../controllers/addProduct.php', {
        method: 'POST',
        body: new FormData(create_form)
    });

    let result = await response.text();
    if (response.status === 200) {
        error_product.innerHTML = 'Вы добавили товар';
        error_product.style.color = "green";
    } else {
        error_product.innerHTML = `<b>${result}</b>`;
        error_product.style.color = "red";
    }
});