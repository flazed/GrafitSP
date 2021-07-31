const menu = document.querySelectorAll('header nav li a');
menu.forEach(link => {
    link.href === document.location.href && link.classList.add('active');
})