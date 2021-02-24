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
            url: "http://localhost/",
            params: {page: page}
        }).then(function (result) {
            $window.location.reload();
        })
    }

    function replaceGetParams(key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);
        var s = document.location.search;
        var kvp = key + "=" + value;
        var r = new RegExp("(&|\\?)" + key + "=[^\&]*");
        s = s.replace(r, "$1" + kvp);
        if (!RegExp.$1) {
            s += (s.length > 0 ? '&' : '?') + kvp;
        }
        ;
        document.location.search = s;
    }

    $scope.getInfoByTaskId = function (id) {
        $http({
            method: "GET",
            url: "http://localhost/task/getTask",
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
            url: "http://localhost/task/saveTask",
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
            url: "http://localhost/task/addTask",
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