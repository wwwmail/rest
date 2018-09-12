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
                <div class="menu">
                	<div class="container">
	                	<div class="cart">
                            <a v-if="isLogin"><i class="glyphicon glyphicon-user"></i>{{user_name}}</a>
		                    <a v-on:click="getCartItems"  class="show-cart"><i class="glyphicon glyphicon-shopping-cart"></i> {{cartCount}}</a>
		                    
		                    <ul class="cart-item" v-if="isLogin" >
		                        <li v-for="(item, i) in cart"><span class="title_brand">{{item.title_brand}}</span><span>{{item.title_model}} </span></li>
		                    </ul>

		                </div>
		                <div class="nav is-logining" v-if="isLogin">
		                    
		                    <router-link to="/cars">Cars</router-link>
		                    <router-link to="/search"><i class="glyphicon glyphicon-search"></i>Search</router-link>
		                    <!-- <router-link to="/register">Registration</router-link> -->
		                    <router-link to="/logout">Logout</router-link>
		                   
		                </div>
		                <div class="nav is-logout" v-else>
		                    <router-link to="/cars">Cars</router-link>
		                    <router-link to="/search"><i class="glyphicon glyphicon-search"></i>Search</router-link>
		                    <router-link to="/register">Registration</router-link> 
		                    <router-link to="/login">Login</router-link>
		                     
		                </div>
		            </div>
                </div>
               
                    <router-view></router-view>

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