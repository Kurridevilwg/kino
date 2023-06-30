auth_form.addEventListener('submit', async(e) => {
    e.preventDefault();
    let response = await fetch('./controllers/auth.php', {
        method: 'POST',
        body: new FormData(auth_form)
    });
    let result = await response.text();
    if (response.status !== 200) {
        error_block_auth.innerHTML = `${result}`;
        error_block_auth.style.color = "red";
        error_block_auth.classList.remove('hidden');
    } else {
        location.href = './index.php';
    }
});