const Cars = {

    data() {
        return {
            cars: this.cars
        }
},
    created() {
        this.fetchAllCars();
    },
    
    methods: {

        fetchAllCars() {

            axios.get(config.domain + '/cars')
                .then(response => {
                    this.cars = response.data
                    this.showCarsBlock = true;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                })
                .then(function () {
                // always executed
                });
        },

        },
        template: ` 
                <div>
                    <div class="card " v-for="(item, i) in cars">
                        <div class="">
                            <img class="card-img-top" v-bind:src="'img/'+item.id+'.jpg'" v-bind:alt="'item.title_brand' + ' ' + 'item.title_model'">
                            <div class="card-body">
                                <h5 class="card-title">{{item.title_brand}} {{item.title_model}}</h5>
                                <p class="card-text"></p>
                                <a  v-bind:href="'#/cars/'+item.id" class="btn btn-primary">show this car</a>
                            </div>
                        </div>
                    </div>
                </div>
                `
}


const LoginUser = {

    data() {
        return {
            errors: this.errors,
            login: {
                email: '',
                password: '',
            },
            hasError: false,
            flag:false,
            success_logining: '',
        }
    },
    created() {},
    methods: {
        sendLoginForm: function () {
            if (!this.login.email) {
                this.errors = 'email is required';
                return false;
            } else if (!this.validEmail(this.login.email)){
                this.errors = 'email not valid';
                return false;
            }  else if (!this.login.password){
                this.errors = 'pass is required';
                return false;
            }

            this.$http.post(config.domain + '/auth', 
            {
                email: this.login.email,
                password: this.login.password,
            },
            {
                emulateJSON: true
            }

            ).then(function (response) {

                if(response.body.success == 'true'){

                    setCookie('token', response.body.auth);
                    this.errors = '';
                    this.flag= true;
                    this.success_logining = 'Congratulation!'
                    this.$parent.isLogin = true;

                }else if (response.body.success == 'false'){
                    this.errors = response.body.message;

                }
            });
        },
        validEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        },
        template: ` 
                <div class="wrap-login">
                {{success_logining}}
                    <form id="login-form" v-bind:class="{'hide-form': flag }">
                        {{errors}}
                        <div class="form-group row">
                            <label for="example-text-input2" class="col-md-2 col-form-label">email</label>
                            <div class="col-md-10">
                                <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="login.email" id="example-text-input2">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input3" class="col-md-2 col-form-label">password</label>
                            <div class="col-md-10">
                                <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="password" v-model="login.password" id="example-text-input3">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="submit_form" class="col-md-10 col-form-label"></label>
                            <div class="col-md-2">
                                <span class="form-control btn btn-primary" v-on:click="sendLoginForm"  id="submit_form">login</span>
                            </div>
                        </div>
                    </form>
                </div>
                    `

        }



const Logout = {

    data() {
        return {
            success_logout: '',
        }
    },
    created() {
        this.sendLogOutRequest();
    },
    methods: {
        sendLogOutRequest: function () {
            var authCookie = getCookie('token');
           
            this.$http.get(config.domain + '/auth/logout', 
            {
                headers: {
                    'Authorization': 'Bearer ' + authCookie
                }
            },
            {
                emulateJSON: true
            }

            ).then(function (response) {

                if(response.body.success == 'true'){

                    this.success_logout = 'Succes logout!';
                    this.$parent.isLogin = false;

                }else if (response.body.success == 'false'){
                    this.errors = response.body.message;

                }
            });
        },
        },
        template: ` 
                <div class="wrap-logout">
                    {{success_logout}} 
                </div>
                   `
        }












const RegisterUser = {

    data() {
        return {
            errors: this.errors,
            register: {
                email: '',
                first_name: '',
                last_name: '',
                password: '',
            },
            hasError: false,
            flag:false,
            success_registration: '',
}
},
        created() {},
        methods: {
            sendRegisterForm: function () {
                if (!this.register.email) {
                    this.errors = 'email is required';
                    return false;
                } else if (!this.register.first_name) {
                    this.errors = 'first name is required';
                    return false;
                } else if (!this.validEmail(this.register.email)) {
                    this.errors = 'email not valid';
                    return false;
                } else if (!this.register.last_name) {
                    this.errors = 'last_name is required';
                    return false;
                } else if (!this.register.password) {
                    this.errors = 'pass is required';
                    return false;
                }

                this.$http.post(config.domain + '/users', 
                {
                    email: this.register.email,
                    password: this.register.password,
                    first_name: this.register.first_name,
                    last_name: this.register.last_name,
                },
                {
                    emulateJSON: true
                }

                ).then(function (response) {

                    if(response.body.success == 'true'){
                        this.errors = '';
                        this.flag= true;
                        this.success_registration = 'Congratulation!'

                    }else if (response.body.success == 'false'){
                        this.errors = response.body.message;

                    }
                });
            },
            validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }

        },
        template: ` 
    <div class="wrap-search">
    {{success_registration}}
        <form id="register-form" v-bind:class="{'hide-form': flag }">
            {{errors}}
            <div class="form-group row">
                <label for="example-text-input5" class="col-md-2 col-form-label">email</label>
                <div class="col-md-10">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="register.email" id="example-text-input5">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input6" class="col-md-2 col-form-label">first name</label>
                <div class="col-md-10">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="register.first_name" id="example-text-input6">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input7" class="col-md-2 col-form-label">last name</label>
                <div class="col-md-10">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="register.last_name" id="example-text-input7">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input8" class="col-md-2 col-form-label">password</label>
                <div class="col-md-10">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="password" v-model="register.password" id="example-text-input8">
                </div>
            </div>
      
            <div class="form-group row">
                <label for="submit_form" class="col-md-10 col-form-label"></label>
                <div class="col-md-2">
                    <span class="form-control btn btn-primary" v-on:click="sendRegisterForm"  id="submit_form">register</span>
                </div>
            </div>
        </form>
    </div>
        `

        }



const DetailCar = {
    props: ['id'],
    data() {
        return {
            detailCar: this.detailCar,
            success_message: '',
        }
    },
    created() {
        this.getCarById(this.id);
    },
    methods: {
        getCarById: function (id) {

            axios.get(config.domain + '/cars/' + id)
            .then(response => {
                this.detailCar = response.data
                this.errors = '';
                this.hasError = false;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        },
        addCarToCart: function(item){
           var authCookie = getCookie('token');
           this.$http.post(config.domain + '/orders', 
            {
                id: item.id
            },
            {
                emulateJSON: true,
                headers: {
                    'Authorization': 'Bearer ' + authCookie
                }
            },
            ).then(function (response) {
                if(response.body.success == 'true'){
                        this.errors = '';
                        this.flag= true;
                        this.success_message = 'successfully add car to cart';

                    }else if (response.body.success == 'false'){
                        this.errors = response.body.message;

                }
            
            });
                    }
        },
        template: ` 
        <div class="detail-car">
            {{success_message}}
            <div class="card col-4" v-for="(item, i) in detailCar">

                <img class="card-img-top" v-if="item.id" v-bind:src="'img/'+item.id+'.jpg'" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{item.title_brand }} {{item.title_model}}</h5>
                    <p>year: {{item.year}}</p>
                    <p>capasity: {{item.capasity}}</p>
                    <p>speed: {{item.speed}}</p>
                    <p>price: {{item.price}}</p>
                    <p>color: {{item.colour}}</p>
                    <p class="card-text"></p>
                    <span class="btn btn-primary" v-on:click=addCarToCart(item)>                                                                                                                                                                                                                                                                                                                                                                                                                                                        by car</span>
                    <a href="#/cars" class="btn btn-primary">show all cars</a>
                </div>

            </div>
        </div>
        `

        }






const SearchCars = {

    data() {
        return {
            cars: this.cars,
            errors: this.errors,
            search: {
                year: '',
                brand: ''
            },
            hasError: false,
        }
    },
    created() {},
    methods: {
        searchCars: function () {

            if (!this.search.year) {
                this.errors = 'year is required fields';
                this.hasError = true;
                return false;
            }

            axios.get(config.domain + '/cars/filter', {
            params: {
                year: this.search.year,
                brand: this.search.brand
            }
            })
            .then(response => {
                this.cars = response.data
            })

            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .then(function () {
            // always executed
            });
        }
    },
    template: ` 
    
        <div class="wrap-search">
            <form id="form">
                {{errors}}
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">year</label>
                    <div class="col-10">
                        <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="search.year" id="example-text-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">brand</label>
                    <div class="col-10">
                        <input class="form-control" type="search"  v-model="search.brand" id="example-search-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="submit_form" class="col-10 col-form-label"></label>
                    <div class="col-2">
                        <span class="form-control" v-on:click="searchCars"  id="submit_form">search</span>
                    </div>
                </div>
            </form>

            <div class="wrap-cars">
                <div class="card " v-for="(item, i) in cars">
                    <div class="">
                        <img class="card-img-top" v-bind:src="'img/'+item.id+'.jpg'" v-bind:alt="'item.title_brand' + ' ' + 'item.title_model'">
                        <div class="card-body">
                            <h5 class="card-title">{{item.title_brand}} {{item.title_model}}</h5>
                            <p class="card-text"></p>
                            <a  class="btn btn-primary">buy</a>

                            <a  v-bind:href="'#/cars/'+item.id" class="btn btn-primary">show this car</a>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        `

        }








const Bar = {template: '<div>bar</div>'}

// 2. Определяем несколько маршрутов
// Каждый маршрут должен указывать на компонент.
// "Компонентом" может быть как конструктор компонента, созданный
// через `Vue.extend()`, так и просто объект с опциями компонента.
// Мы поговорим о вложенных маршрутах позднее.
const routes = [
{path: '/cars', component: Cars},
{path: '/bar', component: Bar},
{path: '/search', component: SearchCars},
{path: '/cars/:id', component: DetailCar, props: true},
{path: '/register', component: RegisterUser},
{path: '/login', component:LoginUser},
{path: '/logout', component:Logout},
]

// 3. Создаём экземпляр маршрутизатора и передаём маршруты в опции `routes`
// Вы можете передавать и дополнительные опции, но пока не будем усложнять.
        const router = new VueRouter({
        routes // сокращённая запись для `routes: routes`
                })

// 4. Создаём и монтируем корневой экземпляр приложения.
// Убедитесь, что передали экземпляр маршрутизатора в опции
// `router`, чтобы позволить приложению знать о его наличии.
        const app = new Vue({
        router,
        el: '#app',
        created() {
            this.isAuth();
        },
        data: {
            cartCount:0,
            cart:{},
            isLogin: false,
            user_name:''
        },
        methods:{
            isAuth: function(){
                var authCookie = getCookie('token');
                axios.get(config.domain + '/auth', 
                {
                    headers: {
                        'Authorization': 'Bearer ' + authCookie
                }
                })
                .then(response => {
                    if(response.data.success == 'true'){
                        console.log(response.data);
                        this.isLogin = true;
                        this.user_name = response.data.user_name;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            
            getCartItems: function(){
                var authCookie = getCookie('token');
                
                axios.get(config.domain + '/orders', 
                {
                    headers: {
                        'Authorization': 'Bearer ' + authCookie
                    }
                })
                .then(response => {
                   
                    
                    console.log(response);
                    this.cart = response.data
                })

                .catch(function (error) {
                // handle error
                console.log(error);
                })
                .then(function () {
                // always executed
                });
            }
        }

        }).$mount('#app')


