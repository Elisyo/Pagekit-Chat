$(function () {
    var vue = new Vue({
        el: '#parameter',
        data: {
            Port: $data.Port,
            rooms: $data.rooms
        },
        methods: {
            save: function () {
                vue.Port[0].number = document.getElementById("portServer").value;
                vue.rooms[0].number = document.getElementById("roomsNumber").value;
                vue.$http.post('admin/chat/parameter/save', {
                    Port: vue.Port,
                    rooms: vue.rooms
                }, function () {
                    UIkit.notify("Saved");
                }).error(function () {
                    console.log('Ooops');
                });
            }
        }
    })
})


