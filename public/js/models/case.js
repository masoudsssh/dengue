
	dengueApp.factory('caseModel', ['$http', function($http) {

        var caseModel = {};
        var urlBase = '/case';

        caseModel.getCases = function(){
            return $http.get(urlBase);
        };

        // caseModel.getCase = function(id){ 
        //     return $http.get(urlBase+'/' + id + '?type=true');
        // };

        caseModel.insertCase = function (newCase) {
            return $http.post(urlBase, newCase);
        };

        // caseModel.updateCustomer = function (cust) {
        //     return $http.put(urlBase + '/' + cust.ID, cust)
        // };

        // caseModel.deleteCase = function (id) {
        //     return $http.delete(urlBase + '/' + id);
        // };

        return caseModel;
    }]);