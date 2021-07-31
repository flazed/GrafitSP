const app = new Vue({
    el: '.main',
    data: {
        basket: {},
        total: 0,
        id: 0,
        email: '',
        addToBasket: 'В корзину',
        removeFromBasket: 'Убрать'
    },
    mounted() {
        localStorage.getItem('basket') === null ? this.basket = {} : this.basket = JSON.parse(localStorage.getItem('basket'));

        this.calcTotalPrice();
    },
    methods: {
        addToBasketClick(e, id, name, prices) {
            if(e.target.classList.contains('active')) {
                delete this.basket[`${id}`];

                e.target.classList.remove('active');
                e.target.textContent = this.addToBasket;
            } else {
                this.basket[`${id}`] = {
                    id: id,
                    name: name,
                    count: 1,
                    price: prices[0],
                    prices: prices
                };

                e.target.classList.add('active');
                e.target.textContent = this.removeFromBasket;
            }

            this.save();
        },

        deleteItem(e, id) {
            delete this.basket[`${id}`];
            this.save();
        },

        changeItem(e, id) {
            let item =  this.basket[`${id}`];
            item.count = +e.target.value;

            if(e.target.value <= 0 || e.target.value == undefined) {
                this.deleteItem(e, id);
            } else if(e.target.value <= 10) {
                item.price = e.target.value*item.prices[0];
            } else if(e.target.value <= 50) {
                item.price = e.target.value*item.prices[1];
            } else if(e.target.value <= 200) {
                item.price = e.target.value*item.prices[2];
            } else {
                item.price = e.target.value*item.prices[3];
            }

            this.save();
        },

        calcTotalPrice() {
            this.total = 0;
            for(keys of Object.keys(this.basket)) {
                this.total += this.basket[`${keys}`].price;
            }
        },

        makeOrder() {
            if(this.$refs.email.type == 'hidden') {
                this.email = this.$refs.email.value;
            }

            if(this.validateEmail(this.email)) {
                fetch('/api/order', {
                    method: 'POST',
                    body: JSON.stringify({
                        email: this.email,
                        basket: this.basket
                    })
                })
                .then(response => response.json())
                .then(data => {
                    this.id = data.id;
                    this.basket = {};
                    this.total = 0;
                    this.save();
                })
            } else {
                this.$refs.email.classList.add('border-danger');
            }
        },

        checkValid(e) {
            e.target.classList.remove('border-danger', 'border-success');

            if(this.validateEmail(this.email)) {
                e.target.classList.add('border-success')
            } else {
                e.target.classList.add('border-danger')
            }
        },

        validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        },

        save() {
            this.calcTotalPrice();
            localStorage.setItem('basket', JSON.stringify(this.basket));
        }
    }
})
