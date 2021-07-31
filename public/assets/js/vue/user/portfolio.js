const app = new Vue({
    el: '.main',
    data: {
        show: false,
        title: '',
        description: '',
        src: ''
    },
    methods: {
        setBigPicture(e) {
            this.title = e.target.dataset.title;
            this.description = e.target.dataset.description;
            this.src = e.target.src;
            this.show = true;
            document.body.classList.add('hidden');
        },

        leaveBigPicture() {
            this.show = false;
            document.body.classList.remove('hidden');
        }
    }
})

