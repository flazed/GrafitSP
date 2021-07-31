try {
    const adress = document.querySelector('.adress');
    const toggle_adress = document.querySelector('.adress .adress-toggle');
    toggle_adress.addEventListener('click', () => {
        adress.classList.toggle('active');
    })
} catch (error) {}