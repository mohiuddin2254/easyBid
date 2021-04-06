<!DOCTYPE HTML>
<html lang="en-US"  ng-app="app">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body ng-controller="mainCtrl">
	<div class="productDiv" ng-repeat="product in products">

		<h5>ID: {{product.id}}</h5>
		<h5>Name: {{product.name}}</h5>
		<h5>Price: {{product.price}}</h5>
		<strong> 00:00:<span class="count-{{product.id}}">20</span></strong>
		<button type="button" ng-click="bid(product.id)">Bid Now</button>

	</div>
	<script src="<?php echo base_url();?>assets/js/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/js/angular.min.js"></script>
	<script>

    angular.module('app',[]).controller('mainCtrl',function($scope,$http){
        $scope.products = [];

        loadproducts();
         function loadproducts(){
             $http.get('http://localhost/auction/index.php/admin/getProducts').then(function (data) {

                    console.log(data);
                    $scope.products = data.data;

             })
         }


         $scope.bid= function (id) {

             startTimer(id);

         }

         function startTimer(id) {
             var counter = 20;
             var interval = setInterval(function() {

                 counter--;
                 // Display 'counter' wherever you want to display it.
                 $(".count-"+id).html(counter);
                 if (counter == 0) {
                     // Display a login box
                     clearInterval(interval);
                     sold(id);
                 }
             }, 1000);
         }


         function sold(id)
         {
             //alert("THis product sold"+ id);
             $http.get('http://localhost/auction/index.php/admin/removeProducts/'+id).then(function (value) {
                 //loadproducts();

                 $scope.products = value.data;
                 console.log(value.data);
             });

         }

    });
</script>
</body>
</html>