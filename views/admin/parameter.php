<?php $view->script('parameter', 'chat:app/views/admin/parameter.js', 'vue') ?>
<style>
    input {
        border: 1;
        line-height: 20px;
        font-size: 14px;
    }
    div {
        margin-bottom: 10px;
        margin-top: 10px;
    }
</style>
<div id="parameter">
    <div title="config server div">
        <div title="Port div">
            <h1>Choose the port for your server :</h1>
            <p v-for="port in Port">
                Actual port : {{port.number}}
                <br>
                New port :
                <input
                    type="number"
                    value="{{port.number}}"
                    min="8008"
                    max="8080"
                    id="portServer"
                    style="width: 50px">
            </p>
        </div>
        <div title="n° of rooms div">
            <h1>Choose the number of rooms:</h1>
            <p v-for="room in rooms">
                Actual number of rooms : {{room.number}}
                <br>
                New number of rooms :
                <input
                    type="number"
                    value="{{room.number}}"
                    min="1"
                    max="999"
                    id="roomsNumber"
                    style="width: 50px">
            </p>
        </div>
        <button class="uk-button uk-button-primary"
        @click="save()">Save</button>
    </div>
</div>

