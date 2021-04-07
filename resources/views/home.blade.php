@extends("layouts.master")
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @endsection
@section('content')

<div class="container" ng-app="app" ng-controller="ctrl">

    <div class="row">
        <div class="col-md-3">
            <h1 style="margin: 0 0 30px 0">สินค้าในร้าน</h1>
        </div>
        <div class="col-md-9">
            <div class="pull-right" style="margin-top: 10px">
            <input type="text" class="form-control" ng-model="query"
            ng-keyup="searchProduct($event)" style="width: 190px" placeholder="พิมพ์ชื่อสินค้าเพื่อค้นหา"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item" 
                ng-class="{'active': category == null}" ng-click="getProductList(null)"> ทั้งหมด</a> 

                <a href="#" class="list-group-item" ng-repeat="c in categories"
                ng-click="getProductList(c)" ng-class="{'active': category.id == c.id}">@{ c.name }</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products">
                    <!-- product card -->
                    <div class="panel panel-default bs-product-card">

                        <div class="panel-body">
                            <img ng-src="@{ p.image_url }" class="img-responsive">
                            <h4><a href="#">@{ p.name }</a></h4>

                            <div class="form-group">
                                <div>คงเหลือ: @{ p.stock_qty }</div>
                                <div>ราคา <strong>@{ p.price }</strong> บาท</div>
                            </div>

                            <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)">
                                <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า
                            </a>
                        </div>
                    </div>
                    <!-- end product card -->
                    <h3 ng-if="!products.length">ไม่พบข้อมูลสินค้า</h3>
                </div>
            </div>
        </div>
    </div>
</div>
</div>






    <!-- <h1>@{ helloMessage }</h1>
    <input type="text" class="form-control" ng-model="query.name" placeholder="ค้นหา">
<br>
    <table class="table table-bordered" ng-if="products.length">
        <head>
            <tr>
                <th>รหัส</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาขาย</th>
                <th>คงเหลือ</th>
                <th>สถานะ</th>
            </tr>
        </head>
    
        <tr ng-repeat="p in products|filter:query">
            <td>@{p.code}</td>
            <td>@{p.name}</td>
            <td>@{p.price|number:2}</td>
            <td>@{p.qty|number:0}</td>
            <td>
            <span ng-if="p.qty > 0 && p.qty < 5"
                ng-class="{'label label-warning': p.qty > 0 && p.qty < 5}">สินค้าใกล้หมด</span>
            <span ng-if="p.qty == 0"
                ng-class="{'label label-danger': p.qty == 0}">สินค้าหมด</span>
            </td>
        </tr>
    </table>

    <h3 ng-if="!products.length">ไม่พบข้อมูลสินค้า</h3>

</div> -->

<script type="text/javascript">
var app = angular.module('app', []).config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('@{').endSymbol('}')
});

app.service('productService', function($http) {
        this.getProductList = function (category_id) {
            if(category_id) {
                return $http.get('/api/product/' + category_id);

            }
    return $http.get('/api/product');
    }

    this.getCategoryList = function () {
    return $http.get('/api/category');
    }

    this.searchProduct = function (query) {
    return $http.post('api/product/search', JSON.stringify({query : query})
    );
    }

});

app.controller('ctrl', function ($scope, productService) {
    $scope.helloMessage = 'ยินดีต้อนรับสู่ BikeShop'

    $scope.products = [];
    $scope.categories = [];
    $scope.category = {};

    $scope.getProductList = function (category) {
        $scope.category = category;
        category_id = category != null ? category.id : '';

        productService.getProductList(category_id).then(function (res) {
            if(!res.data.ok) return;
            $scope.products = res.data.products;
        });      
    };

    $scope.getProductList(null);

    $scope.getCategoryList = function () {

        productService.getCategoryList().then(function (res) {
            if(!res.data.ok) return;
    $scope.categories = res.data.categories;
});      
};
    $scope.getCategoryList();

    $scope.searchProduct = function (e) {
        productService.searchProduct($scope.query).then(function (res) {
            if(!res.data.ok) return;
        $scope.products = res.data.products;
        });
};

    $scope.addToCart = function (p) {
        window.location.href = '/cart/add/' + p.id;
    };
    
});
</script>

@endsection