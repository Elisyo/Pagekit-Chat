$(function(){
    var conn = {};
    var myConsole = document.getElementById("console");
    var room = document.getElementById("room");
    var vue = new Vue({
        el: '#chat',
        data: {
            entries: $data.entries,
            rooms: $data.rooms,
            Port: $data.Port,
            userName: $user.name,
            conn : conn
        },
        methods: {
            printInMyConsole: function(message){
                myConsole.innerHTML =  "<li>" + message +"</li>" + myConsole.innerHTML;
            },
            reload: function(limit){
                vue.$http.get('chat/rooms', {
                    rooms: vue.rooms
                }, function () {
                    console.log('get rooms : ' + this.rooms[0].number);
                    limit = this.rooms[0].number;
                    console.log('get rooms : ' + this.rooms[0].number +" + limit : " + limit);
                }).error(function () {
                    console.log('Ooops');
                });
                return limit;
            },
            loadRooms: function(){
                var res = "";
                var limit = vue.rooms[0].number;
                var load = document.getElementById("load");
                if(load.innerHTML=="Load"){
                    load.innerHTML="Reload"
                }else{
                    limit = vue.reload(limit);
                }
                for(var i=0;i<limit;i++){
                    res += "<td><button class=\"uk-button\" onclick=\"selectRoom("+ (i+1) + ")\">"+ (i+1) + "</button></td>";
                }
                document.getElementById("rooms").innerHTML=res;
            },
            selectRoom: function(newRoom){
                if(vue.conn.readyState != 1){
                    room.innerHTML = newRoom;
                }
            },
            connection: function(){
                if(this.conn.readyState != 1){
                    if(room.innerHTML!=""){
                        vue.conn = new WebSocket('ws://localhost:'+vue.Port[0].number);
                        vue.conn.onopen = function(){
                            vue.printInMyConsole('New connection.');
                            document.getElementById("connectionState").innerHTML="Connection state : opened";
                            document.getElementById("username").innerHTML = vue.userName;
                        };
                    }else{
                        vue.printInMyConsole("You have to choose a chat room");
                    }
                }else if(vue.conn.readyState == 1){
                    vue.printInMyConsole('Your are already connected.');
                }
                vue.conn.onmessage = function(e) {
                    var content = document.getElementById("chatMessage");
                    var roomFor;
                    var message;
                    if(room.innerHTML.length == 1 ){
                        roomFor = e.data.substring(5,6);
                        message = e.data.substring(9);
                    }else if(room.innerHTML.length == 2){
                        roomFor = e.data.substring(5,7);
                        message = e.data.substring(10);
                    }else if(room.innerHTML.length == 3){
                        roomFor = e.data.substring(5,8);
                        message = e.data.substring(11);
                    }
                    if(room.innerHTML==roomFor){
                        content.innerHTML = "<li>" + message + "</li>"+content.innerHTML;
                    }
                };
                vue.conn.onerror = function(){
                    vue.printInMyConsole("ERROR : There is no server for this room ! You should try for a new connection.");
                    vue.conn = new WebSocket('ws://localhost:'+vue.Port[0].number);

                };
            },
            deconnection: function(){
                var co = document.getElementById("connection");
                if(vue.conn.readyState == 1){
                    vue.conn.close();
                    vue.printInMyConsole('Your are now deconnected.');
                    document.getElementById("chatMessage").innerHTML="";
                    document.getElementById("connectionState").innerHTML="Connection state : closed";
                    room.innerHTML = "";
                    document.getElementById("username").innerHTML = "";
                }else{
                    vue.printInMyConsole('Your are already deconnected.');
                }
            },
            sendMessage: function(){
                try{
                    var mes = document.getElementById("message");
                    if(mes.value !=""){
                        var finalMessage = "room " + room.innerHTML + " : " + vue.userName+" : "+mes.value;
                        vue.conn.send(finalMessage);
                        mes.value="";
                    }
                }catch(e){
                    vue.printInMyConsole("ERROR : You can't send your message.");
                }
            }
        }
    })
})


