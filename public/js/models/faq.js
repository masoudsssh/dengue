
	dengueApp.factory('faqModel', ['$http', function($http) {

        var faqModel = {};
        var urlBase = '/faq';

        faqModel.getFaqs = function(){
            return $http.get(urlBase);
        };


        faqModel.insertFaq = function (newFaq) {
            return $http.post(urlBase, newFaq);
        };

        // faqModel.updateCustomer = function (cust) {
        //     return $http.put(urlBase + '/' + cust.ID, cust)
        // };

        // faqModel.deleteCase = function (id) {
        //     return $http.delete(urlBase + '/' + id);
        // };

        return faqModel;
    }]);