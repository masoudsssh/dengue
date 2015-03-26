
	dengueApp.factory('userModel', ['$http', function($http) {

        var userModel = {};
        var urlBase = '/';

        // userModel.getCases = function(){
        //     return $http.get(urlBase);
        // };

        userModel.login = function(credential){ 
            return $http.post( '/login', credential);
        };

        userModel.insertUser = function (newUser) {
            return $http.post('/signup', newUser);
        };

        userModel.logout = function(){ 
            return $http.get( '/logout');
        };

        userModel.updateUser = function (updatedUser) {
            return $http.put('/update-user', updatedUser);
        };

        // userModel.deleteCase = function (id) {
        //     return $http.delete(urlBase + '/' + id);
        // };

        return userModel;
    }]);