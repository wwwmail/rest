new Vue({
    el: '#app',
    created() {
        this.fetchAllCars();
    },
    data: {
        api: 'http://soap.test/task2/client/soapClient/',
        cars: [],
        search: {
            action: 'getSearchCars',
            year: '',
            brand: ''
        },
        errors: '',
        hasError: false,
        detailCar: {
            id: '',
            model: '',
            brand: '',
            year: '',
            capasity: '',
            colour: '',
            price: '',
        },
        showDetail: false,
        showCarsBlock: true,
    },
    methods: {
        fetchAllCars() {

        axios.get(config.domain + '/cars')
            .then(response => (this.cars = response.data))
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });
            
          




//            this.$http.post(this.api, {
//                action: 'getCars',
//            },
//            {
//                emulateJSON: true
//            }
//
//            ).then(function (response) {
//                this.showCarsBlock = true;
//                this.cars = response.body;
//
//            });


        },

        searchCars: function () {

            if (!this.search.year) {
                this.errors = 'year is required fields';
                this.hasError = true;
                return false;
            }

            
             axios.get(config.domain + '/cars/filter', {
    params: {
      year: 1999
    }
  })
//            .then(response => (this.cars = response.data,
//    this.errors = '',
//                this.hasError = false,
//                this.showCarsBlock = true
//                //this.cars = response.body;
//            ))
        .then(function (response) {
            this.cars = response.data;
            console.log(response);
            //resultElement.innerHTML = generateSuccessHTMLOutput(response);
        })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });
//            
///cars/filter?year=1999
//            this.$http.post(this.api, {
//                action: this.search.action,
//                year: this.search.year,
//                brand: this.search.brand,
//
//            },
//            {
//                emulateJSON: true
//            }
//
//            ).then(function (response) {
//                this.errors = '';
//                this.hasError = false;
//                this.showCarsBlock = true;
//                this.cars = response.body;
//
//
//            });


        },

        getCarById: function (id) {

            this.$http.post(this.api, {
                action: 'getCarById',
                id: id,

            },
            {
                emulateJSON: true
            }

            ).then(function (response) {

                this.detailCar = response.body;
                this.errors = '';
                this.hasError = false;
            });
            this.showCarsBlock = false;
        }
    }
});