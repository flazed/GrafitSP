const app = new Vue({
    el: '.main',
    data: {
        success: false,
        alert: false,
        valid: {
            title: '',
            description: '',
            photo: []
        },
        errors: {
            title: '',
            description: '',
            photo: ''
        }
    },
    // mounted() {
    // },
    methods: {
        async addPortfolio(e) {
            e.preventDefault();

            let portfolio = new FormData();
            portfolio.append('title', this.valid.title);
            portfolio.append('description', this.valid.description);
            portfolio.append('photo', this.valid.photo);

            let response = await fetch('/api/addportfolio', {
                method: 'POST',
                body: portfolio
            })

            let data = await response.json();

            if(data.hasOwnProperty('success')) {
                this.success = true;
                this.valid = {
                    title: '',
                    description: '',
                    photo: []
                }
                this.errors = {
                    title: '',
                    description: '',
                    photo: ''
                }

                document.querySelector('form .upload img').classList.remove('active');
                document.querySelector('form .upload img').src='';

                this.alert = true;
                setTimeout(() => this.alert = false, 3000);
            } else {
                data.hasOwnProperty('title') && (this.errors.title = data.title[0]);
                data.hasOwnProperty('description') && (this.errors.description = data.description[0]);
                data.hasOwnProperty('photo') && (this.errors.photo = data.photo[0]);
            }
        },

        addPhoto(e) {
            this.removeError(e);
            this.valid.photo = e.target.files[0];
        },

        removeError(e) {
            this.errors[e.target.name] = '';
        },
    }
})
