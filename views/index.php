<?php $view->script('chat', 'chat:app/views/chat.js', 'vue') ?>
<?php $view->style('chat', 'chat:css/style.css') ?>

<script>
    function selectRoom(newRoom){
        var room = document.getElementById("room");
        if(document.getElementById("connectionState").innerHTML != "Connection state : opened"){
            room.innerHTML = newRoom;
        }
    }
</script>

<div id="chat">
    <h1>Chat in Pagekit</h1>
    <div title="chat room choice">
        Choose a chat room.
        <header>
            <table>
                <tr id="rooms">
                </tr>
            </table>
        </header>
        <button class="uk-button" id="load" @click="loadRooms()">Load</button>
    </div>
    <section>
        <p>Chat room :
            <label id="room"></label>
        </p>
        <button class="uk-button" style="margin-right: 40px" @click="connection()">Connection</button>
        <button class="uk-button" style="margin-left: 40px" v-on:click="deconnection">Deconnection</button>
        <br>
        <p id="connectionState">Connection state : closed</p>
        <p>You are : <label id="username"></label></p>
        <textarea id="message"></textarea>
        <br>
        <button class="uk-button" v-on:click="sendMessage()">Send</button>
    </section>
    <br>
    <aside>
        <ul id="chatMessage">
        </ul>
    </aside>
    <footer>
        <ul id="console" style="list-style-type: circle;">
        </ul>
    </footer>
    <label class="uk-button">Notifications</label>
</div>

