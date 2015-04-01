
	dengueApp.factory('caseModel', ['$http', function($http) {

        var caseModel = {};
        var urlBase = '/case';

        caseModel.getCases = function(){
            return $http.get(urlBase);
        };

        caseModel.getCasesByfilter = function(category){ 
            return $http.get('/case-filter-by/' + category );
        };

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