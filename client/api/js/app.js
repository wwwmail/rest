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
                <div class="card-items contant">
                    <div class="container">
                        <div class="card " v-for="(item, i) in cars">
                            <div class="card-item box-shadow">
                                <div class="card-img">
               
                                    <img class="card-img-top"   v-bind:src="'img/'+item.id+'.jpg'" v-bind:alt="'item.title_brand' + ' ' + 'item.title_model'">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{item.title_brand}} {{item.title_model}}</h5>
                                    <p class="card-text"></p>
                                    <a  v-bind:href="'#/cars/'+item.id" class="btn btn-show-car">Show this car</a>
                                </div>
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
                <div class="wrap-login contant">
                    {{success_logining}}
                    <form id="login-form" v-bind:class="{'hide-form': flag }" class="box-shadow">
                        <div class="form-group col-md-5">
                            <input class="form-control" placeholder="Email" v-bind:class="{'alert-danger': hasError }" type="text" v-model="login.email" id="example-text-input2">
                        </div>
                        <div class="form-group col-md-5">
                            <input class="form-control"  placeholder="Password" v-bind:class="{'alert-danger': hasError }" type="password" v-model="login.password" id="example-text-input3">
                        </div>

                        <div class="form-group col-md-2">
                            <span class="form-control btn" v-on:click="sendLoginForm"  id="submit_form">login</span>
                        </div>
                        <div class="error">{{errors}}</div>
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
    <div class="wrap-search contant">
    
        <form id="register-form" v-bind:class="{'hide-form': flag }" class=" box-shadow">
            
            <div class="form-group">
                <label for="example-text-input5" class="col-md-4 col-form-label">Email</label>
                <div class="col-md-8">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="register.email" id="example-text-input5">
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input6" class="col-md-4 col-form-label">First name</label>
                <div class="col-md-8">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="register.first_name" id="example-text-input6">
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input7" class="col-md-4 col-form-label">Last name</label>
                <div class="col-md-8">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="text" v-model="register.last_name" id="example-text-input7">
                </div>
            </div>
            <div class="form-group">
                <label for="example-text-input8" class="col-md-4 col-form-label">Password</label>
                <div class="col-md-8">
                    <input class="form-control" v-bind:class="{'alert-danger': hasError }" type="password" v-model="register.password" id="example-text-input8">
                </div>
            </div>
            <div class="error">{{errors}}</div>
            <div class="form-group form-group-btn">
                <div class="col-md-4">
                    <span class="form-control btn btn-primary" v-on:click="sendRegisterForm"  id="submit_form">Register</span>
                </div>
            </div>
        </form>
        {{success_registration}}
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
                    'Authorization': 'Bearer ' + authCookie,
                    'name': 'value',
                }
            },
            ).then(function (response) {
                if(response.body.success == 'true'){
                        this.errors = '';
                        this.flag= true;
                        this.success_message = 'Successfully add car to cart';

                    }else if (response.body.success == 'false'){
                        this.errors = response.body.message;

                }
            
            });
                    }
        },
        template: ` 
        <div class="detail-car contant box-shadow">
            
            <div class="card" v-for="(item, i) in detailCar">
                <div class="col-md-4">
                    <img class="card-img-top" v-if="item.id" v-bind:src="'img/'+item.id+'.jpg'" alt="">
                </div>
                <div class="card-body col-md-8">
                    <h4 class="card-title">{{item.title_brand }} {{item.title_model}}</h4>
                    <p>Year: {{item.year}}</p>
                    <p>Capasity: {{item.capasity}}</p>
                    <p>Speed: {{item.speed}}</p>
                    <p>Price: {{item.price}}</p>
                    <p>Color: {{item.colour}}</p>
                    <p class="card-text"></p>
                    <div class="success_message">{{success_message}}</div>
                    <span class="btn" v-on:click=addCarToCart(item)>                                                                                                                                                                                                                                                                                                                                                                                                                                                        by car</span>
                    <a href="#/cars" class="btn">show all cars</a>

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
    
        <div class="wrap-search contant">
            <form id="form" class="box-shadow">
                
                <div class="form-group col-md-5">
                    
                    <div class="">
                        <input class="form-control" placeholder="year" v-bind:class="{'alert-danger': hasError }" type="text" v-model="search.year" id="example-text-input">
                    </div>
                </div>
                <div class="form-group col-md-5">
                    
                    <div class="">
                        <input class="form-control" type="search" placeholder="brand" v-model="search.brand" id="example-search-input">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <div class="">
                        <span class="form-control" v-on:click="searchCars"  id="submit_form">Search</span>
                    </div>
                </div>
                <div class="error">{{errors}}</div>
                
            </form>

            <div class="wrap-cars">
                <div class="card " v-for="(item, i) in cars">
                    <div class="card-item box-shadow">
                        <div class="card-img">
                            <img class="card-img-top" v-bind:src="'img/'+item.id+'.jpg'" v-bind:alt="'item.title_brand' + ' ' + 'item.title_model'">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{item.title_brand}} {{item.title_model}}</h5>
                            <p class="card-text"></p>
                            <a  class="btn">Buy</a>
                            <a  v-bind:href="'#/cars/'+item.id" class="btn">Show this car</a>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        `

        }








const Bar = {template: '<div>bar</div>'}

// 2. Îïðåäåëÿåì íåñêîëüêî ìàðøðóòîâ
// Êàæäûé ìàðøðóò äîëæåí óêàçûâàòü íà êîìïîíåíò.
// "Êîìïîíåíòîì" ìîæåò áûòü êàê êîíñòðóêòîð êîìïîíåíòà, ñîçäàííûé
// ÷åðåç `Vue.extend()`, òàê è ïðîñòî îáúåêò ñ îïöèÿìè êîìïîíåíòà.
// Ìû ïîãîâîðèì î âëîæåííûõ ìàðøðóòàõ ïîçäíåå.
const routes = [
{path: '/cars', component: Cars},
{path: '/bar', component: Bar},
{path: '/search', component: SearchCars},
{path: '/cars/:id', component: DetailCar, props: true},
{path: '/register', component: RegisterUser},
{path: '/login', component:LoginUser},
{path: '/logout', component:Logout},
]

// 3. Ñîçäà¸ì ýêçåìïëÿð ìàðøðóòèçàòîðà è ïåðåäà¸ì ìàðøðóòû â îïöèè `routes`
// Âû ìîæåòå ïåðåäàâàòü è äîïîëíèòåëüíûå îïöèè, íî ïîêà íå áóäåì óñëîæíÿòü.
        const router = new VueRouter({
        routes // ñîêðàù¸ííàÿ çàïèñü äëÿ `routes: routes`
                })

// 4. Ñîçäà¸ì è ìîíòèðóåì êîðíåâîé ýêçåìïëÿð ïðèëîæåíèÿ.
// Óáåäèòåñü, ÷òî ïåðåäàëè ýêçåìïëÿð ìàðøðóòèçàòîðà â îïöèè
// `router`, ÷òîáû ïîçâîëèòü ïðèëîæåíèþ çíàòü î åãî íàëè÷èè.
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


$( ".show-cart" ).click(function() {
  $( ".cart-item" ).toggle( "slow", function() {
  });
});
jQuery(function($){
    $(document).mouseup(function (e){ 
        var block = $(".cart-item"); 
        if (!block.is(e.target) 
            && block.has(e.target).length === 0) { 
            block.hide(); 
        }
    }); 
});
