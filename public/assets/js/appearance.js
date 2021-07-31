const appearance = document.querySelectorAll('.appearance');

function animate() {
    appearance.forEach(item => {
        if(item.classList.contains('appearance-down')) {
            if(pageYOffset+document.documentElement.clientHeight > item.getBoundingClientRect().top + pageYOffset - item.clientHeight) {
                item.classList.add('active');
            }
        } else {
            if(pageYOffset+document.documentElement.clientHeight > item.getBoundingClientRect().top + pageYOffset) {
                item.classList.add('active');
            }
        }
    })
}
animate();

document.addEventListener('scroll', (e) => {
    animate();
});
