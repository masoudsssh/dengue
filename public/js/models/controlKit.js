
	dengueApp.factory('controlKit', ['$http', function($http) {

        var controlKit = {};
        var urlBase = '/controlkit';

        controlKit.getControlKitRequests = function(){
            return $http.get(urlBase);
        };


        controlKit.insertControlKitRequest = function (newRequest) {
            return $http.post(urlBase, newRequest);
        };

        // controlKit.updateCustomer = function (cust) {
        //     return $http.put(urlBase + '/' + cust.ID, cust)
        // };

        // controlKit.deleteCase = function (id) {
        //     return $http.delete(urlBase + '/' + id);
        // };

        return controlKit;
    }]);