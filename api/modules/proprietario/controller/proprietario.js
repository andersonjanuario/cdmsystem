app.controller('proprietarioCtrl', function ($scope, $http, API_URL) {
    //retrieve employees listing from API
    $scope.listar = function () {
        $http.get(API_URL + "")
                .success(function (response) {
                    $scope.employees = response;
                });
    };

    //show modal form
    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;
                $http.get(API_URL + '/' + id)
                        .success(function (response) {
                            console.log(response);
                            $scope.employee = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    //save new record / update existing record
    $scope.save = function (modalstate, id) {
        var url = API_URL + "";

        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit') {
            url += "/" + id;
            $http({
                method: 'PUT',
                url: url,
                data: $.param($scope.employee),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                console.log(response);
                //location.reload();
                        $scope.listar();

            }).error(function (response) {
                console.log(response);
                alert('This is embarassing. An error has occured. Please check the log for details');
            });
        } else {
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.employee),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                console.log(response);
                //location.reload();
                        $scope.listar();

            }).error(function (response) {
                console.log(response);
                alert('This is embarassing. An error has occured. Please check the log for details');
            });
        }
        $('#myModal').modal('hide');
    };

    //delete record
    $scope.confirmDelete = function (id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + '/' + id
                        //url: 'http://localhost:8091/angulara/public/proprietario/' + id
            }).
                    success(function (data) {
                        console.log(data);
                        //location.reload();
                        $scope.listar();
                    }).
                    error(function (data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    };
    $scope.listar(); 
});