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
            photo: []
        }
    },
    // mounted() {
    // },
    methods: {
        async addPortfolio(e) {
            e.preventDefault();

            let products = new FormData();
            products.append('title', this.valid.title);
            products.append('description', this.valid.description);
            for(const file of this.valid.photo) {
                products.append('photo[]', file);
            }

            let response = await fetch('/api/addproducts', {
                method: 'POST',
                body: products
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
                    photo: []
                }

                this.alert = true;

                setTimeout(() => this.alert = false, 3000);
                this.$refs.photos.files = [];
            } else {
                this.errors.photo = [];
                data.hasOwnProperty('title') && (this.errors.title = data.title[0]);
                data.hasOwnProperty('description') && (this.errors.description = data.description[0]);
                for (let el of Object.keys(data)) {
                    if(el.includes('photo')) {
                        this.errors.photo.push(...data[el]);
                    }
                }
            }
        },

        setFiles() {
            let list = new DataTransfer();
            this.valid.photo.forEach(img => {
                let blob = new Blob([JSON.stringify(img)], {type: 'image/jpeg'});
                let file = new File([blob], img.name, {type: 'image/jpeg'});
                list.items.add(file);
            });
            this.$refs.photos.files = list.files;
        },

        addPhoto(e) {
            this.valid.photo = [];
            this.removeError(e);

            for (let file of Object.keys(e.target.files)) {
                if(file == 3) {
                    break;
                }

                let fileType = false;

                const type = e.target.files[file].type.replace(/.+\//, '');
                switch(type) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'bmp': fileType = true; break;
                }

                if(fileType) {
                    this.valid.photo.push(e.target.files[file]);
                }
            }

            this.setFiles();
        },

        removePhoto(e, index) {
            e.preventDefault();
            Vue.delete(this.valid.photo, index);

            this.setFiles();
        },

        removeError(e) {
            this.errors[e.target.name] = '';
        },
    }
})
