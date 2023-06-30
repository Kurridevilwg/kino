order_form.addEventListener('submit', async(e) => {
    e.preventDefault();

    let response = await fetch('./controllers/addOrder.php', {
        method: 'POST',
        body: new FormData(order_form)
    });

    let result = await response.text();
    if (response.status === 200) {
        error_order.innerHTML = 'Вы заказали товар';
        error_order.style.color = "green";
    } else {
        error_order.innerHTML = `<b>${result}</b>`;
        error_order.style.color = "red";
    }
});