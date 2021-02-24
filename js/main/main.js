var app = angular.module('main', ["ngRoute"]);

app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when("/:id", {
            templateUrl: "/views/Task.tpl.php"
        })
    $locationProvider.html5Mode(true);
})

app.controller("mainController", function ($scope, $window, $http) {

    $scope.reloadPage = function (page) {
        $http({
            method: "GET",
            url: "/",
            params: {page: page}
        }).then(function (result) {
            $window.location.reload();
        })
    }

    $scope.getInfoByTaskId = function (id) {
        $http({
            method: "GET",
            url: "/task/getTask",
            params: {id: id}
        }).then(function (result) {
            $scope.taskId = result.data.id;
            $scope.taskContent = result.data.content;
            $scope.taskDone = result.data.is_done;
        })
    }

    $scope.saveTask = function () {
        $scope.taskContent = angular.element("#taskContent").val();
        $scope.taskDone = Number(angular.element("#taskDone").is(":checked"));
        $http({
            method: "POST",
            url: "/task/saveTask",
            data: $.param({id: $scope.taskId, content: $scope.taskContent, is_done: $scope.taskDone}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (result) {
            $window.location.href = '/';
            alert(result.data.text);
        });
    }

    $scope.addTask = function () {
        if ($scope.newTaskContent.trim() == '' || $scope.newTaskEmail.trim() == '' || $scope.newTaskUser.trim() == '') {
            alert("Заполните все поля!");
            return;
        }
        let emailRegexp = /.@./;
        if (!emailRegexp.test($scope.newTaskEmail.trim())) {
            alert("Email не валиден!");
            return;
        }

        $http({
            method: "POST",
            url: "/task/addTask",
            data: $.param({content: $scope.newTaskContent, email: $scope.newTaskEmail, user: $scope.newTaskUser}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (result) {
            if (result.data.success) {
                $window.location.reload();
                alert(result.data.text);
            }
        })

    }
});