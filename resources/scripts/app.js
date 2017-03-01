/**
 * Created by Bermar on 2/6/2017.
 */
var app = angular.module('app', []);

app.config(function ($interpolateProvider) {

    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});