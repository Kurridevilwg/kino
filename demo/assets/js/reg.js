reg_form.addEventListener('submit', async(e) => {
    e.preventDefault();
    let response = await fetch('./controllers/reg.php', {
        method: 'POST',
        body: new FormData(reg_form)
    });

    let result = await response.text();
    if (response.status === 200) {
        error_block_reg.innerHTML = 'Успешная регистрация!';
        error_block_reg.style.color = "green";
        error_block_reg.classList.remove('hidden');
        location.href = './index.php';
    } else {
        error_block_reg.innerHTML = `<b>${result}</b>`;
        error_block_reg.style.color = "red";
        error_block_reg.classList.remove('hidden');
    }
});