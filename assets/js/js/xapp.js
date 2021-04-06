
//var angular = require('./angular/angular');
var app = angular.module('xapp',['ngRoute']);

app.config(function($routeProvider,$loactionProvider){
	$routeProvider

	.when('/',{
		template:'<h3>Tareq Hossain</h3>',
		controller:'mainCtrl'

	})


	$loactionProvider.html5Mode(true);
})


//controllers

app.controller('mainCtrl',function($scope){
	$scope.name = "Xapp";

})

