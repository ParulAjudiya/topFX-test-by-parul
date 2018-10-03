var app = angular.module('stockChart', ['nvd3']);

app.controller('stockGraphCtrl', function($scope, $http) {
	
	$scope.stockQuoteChange = function(item){
		$scope.data = getStockPrices($scope, $http, item.stockname);
	};
	
	$scope.stock_options = [{ name: "Apple", stockname: "AAPL" }, 
						{ name: "Microsoft", stockname: "MSFT" }, 
						{ name: "Johnson & Johnson", stockname: "JNJ" }, 
						{ name: "Intel Corporation", stockname: "INTC" }, 
						{ name: "JP Morgan Chase & Co", stockname: "JPM" },
						{ name: "American Express Company", stockname: "AXP" }];
						
	// Select by default Apple
	$scope.selectedOption = $scope.stock_options[0];
	
    $scope.options = {
            chart: {
                type: 'ohlcBarChart',
                height: 450,
                margin : {
                    top: 20,
                    right: 20,
                    bottom: 40,
                    left: 60
                },
                x: function(d){ 
					return d['date']; },
                y: function(d){ return d['close']; },
                duration: 100,
                
                xAxis: {
                    axisLabel: 'Dates',
                    tickFormat: function(d) {
						return d3.time.format('%Y-%m-%d')(new Date(d * 1000));
				    },
                    showMaxMin: false
                },
			    yAxis: {
                    axisLabel: 'Stock Price',
                    tickFormat: function(d){
                        return '$' + d3.format(',.1f')(d);
                    },
                    showMaxMin: false
                }
            }
        };
		
	// By default show for apple	
    $scope.data = getStockPrices($scope, $http, $stocktype="AAPL");
});

function getStockPrices($scope, $http, $stocktype){	
	
	$scope.data = $http({
			url: "StockPrices/getStockPrice/" + $stocktype,
			method: "GET"
		}).then(function successCallback(response) {
			var jsonData = [{"values": []}];
			jsonData[0].values = response.data;
			$scope.data = jsonData;
		}, function errorCallback(response) {
				$scope.error = response.statusText;
		});
}