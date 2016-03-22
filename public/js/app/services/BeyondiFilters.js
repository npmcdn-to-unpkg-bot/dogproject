angular.module('byndFilters',[]).service('BeyondiFilters', function($q) {

    var deferred = $q.defer();

    this.filter = function(filters) {

        var filter = {whereBetween:{},whereIn:{}};

        if(typeof filters.cost != 'undefined') {
            filter.whereBetween.cost = filters.cost;
        }

        if(typeof filters.sex != 'undefined') {
            filter.whereIn.sex = _.compact(_.values(filters.sex));
        }

        if(typeof filters.type_of_listing != 'undefined') {
            filter.whereIn.type_of_listing = _.compact(filters.type_of_listing);
        }

        if(typeof filters.state_id != 'undefined') {
            filter.whereIn.state_id = _.compact(filters.state_id);
        }

        if(_.isEmpty(filter.whereIn)) {
            delete filter.whereIn;
        }

        if(_.isEmpty(filter.whereBetween)) {
            delete filter.whereBetween;
        }

        deferred.resolve(filter);

        return deferred.promise;
    }
});