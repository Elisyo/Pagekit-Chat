$(function () {
    var conn = {};
    var vue = new Vue({
        el: '#server',
        data: {
            Port: $data.Port,
            rooms: $data.rooms
        },
        methods: {
            create: function () {
                vue.$http.get('admin/chat/server/test', function () {
                    console.log("test");
                    return "test";
                }).error(function () {
                    console.log('Ooops');
                });
            },
            runserver: function () {
                vue.$http.get('admin/chat/server/runserver', function () {
                    console.log("runserver");
                    return "runServer";
                }).error(function () {
                    console.log('Ooops');
                });
            }
        }
    })
})

