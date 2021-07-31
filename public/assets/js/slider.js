const slides = document.querySelectorAll('.slider .slider__slides .slide');

setInterval(() => {
    for (let i = 0; i < slides.length; i++) {
        if(slides[i].classList.contains('active')) {
            slides[i].classList.remove('active');

            i+1 === slides.length ? slides[0].classList.add('active') : slides[i+1].classList.add('active');

            slides[i].classList.add('leave-slide');
            setTimeout(() => slides[i].classList.remove('leave-slide'), 800);
            break;
        }    
    }
}, 5000);