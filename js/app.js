var myconfig = angular.module('Comment',[]);

myconfig.controller('CommentBox',function CommentBox($scope, $http){


        $scope.AddNew = function() {
            var data = {
                post_id: $scope.postid,
                employee_id: $scope.employeeid,
                post_comment: $scope.comment
            };
            $http({
                method: 'POST',
                url: 'http://localhost/stileaveapp/dashboard',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},

                data: $.param(data)
            });

        }

})