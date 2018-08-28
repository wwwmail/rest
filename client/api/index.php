<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        


        <div class="container">
            <div id="app">
                <div v-if="isLogin">
                    <h1>Hello, {{user_name}}</h1>
                </div>
                {{isLogin}}
                <div class="cart">
                    <p>Count cart items: {{cartCount}}</p>
                    <p><span v-on:click="getCartItems">Show cart items</span></p>
                    
                    <ul>
                        <li v-for="(item, i) in cart">Title: {{item.title_brand}}, model: {{item.title_model}} </li>
                    </ul>
                </div>
                <div class="nav is-logining" v-if="isLogin">
                    
                    <router-link to="/cars">go to Cars</router-link>
                    <router-link to="/search">go to Search</router-link>
                    <router-link to="/register">go to Registration</router-link>
                    <router-link to="/logout">logout</router-link>
                   
                </div>
                <div class="nav is-logout" v-else>
                    <router-link to="/cars">go to Cars</router-link>
                    <router-link to="/search">go to Search</router-link>
                    <router-link to="/register">go to Registration</router-link> 
                    <router-link to="/login">go to login</router-link>
                     
                </div>
                    <router-view></router-view>
<!--                

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

                <div class="row " v-if="showCarsBlock">

                    <div class="card " v-for="(item, i) in cars">
                        <div class="">
                            <img class="card-img-top" v-bind:src="'img/'+item.id+'.jpg'" v-bind:alt="'item.title_brand' + ' ' + 'item.title_model'">
                            <div class="card-body">
                                <h5 class="card-title">{{item.title_brand}} {{item.title_model}}</h5>
                                <p class="card-text"></p>
                                <a v-on:click="onClick('author'+i)" class="btn btn-primary">buy</a>
                                <a v-on:click="getCarById(i+1)" class="btn btn-primary">show</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row " v-else>
                    <div class="detail-car">
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
                                <a v-on:click="fetchAllCars" class="btn btn-primary">show all cars</a>
                            </div>

                        </div>
                    </div>
                </div>-->
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/config.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/vue.js"></script>
        <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
        <script src="js/axios.min.js"></script>
        <script src="js/vue-resource@1.5.1.js"></script>
        <script src="js/cookie.js"></script>
        <script src="js/app.js"></script>


    </body>
</html>