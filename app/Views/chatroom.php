<?php
include "header.php";
?>
<!-- header -->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>


</head>

<body>
    <?php
    $uri = service('uri');
    ?>
    <!-- end header -->

    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 pt-3 pb-3 bg-white from-wrapper">
                <div class="container">
                    <h3>Chat Room </h3>
                    <p style='color:#c58749'>* Klik user untuk private chat</p>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 mb-3">


                            <ul id="user-list" class="list-group"></ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="message-holder">
                                        <div id="messages" class="row"></div>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="message-input" class="form-control" name="" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button id="send" class="btn float-right  btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include "footer.php";
    ?>
    <script src="jquery/dist/jquery-3.5.1.js"></script>
    <script src="bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="jquery/dist/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> -->
    <script>
    $(function() {
        scrollMsgBottom()
    })

    function scrollMsgBottom() {
        var d = $('.message-holder');
        d.scrollTop(d.prop("scrollHeight"));
    }

    function getImages() {
        const imgs = {
            'Mary': 'mary.jpg',
            'Jon': 'jon.jpg',
            'Alex': 'alex.jpg',
        }

        return imgs
    }

    $(function() {
        var conn = new WebSocket('ws://localhost:8080?access_token=<?= session()->get('id') ?>');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);

            var data = JSON.parse(e.data)

            if ('users' in data) {
                updateUsers(data.users)
            } else if ('message' in data) {

                if (data.status == 'public') {
                    // showNotification("(Chat Room) " + data.author, data.message, "Chatroom/  ");

                    newMessage(data)
                }
            }

        };

        $('#send').on('click', function() {
            var msg = $('#message-input').val()
            if (msg.trim() == '')
                return false
            var data = {
                msg: msg,
                status: "public",
                chat_to: ''
            }
            conn.send(JSON.stringify(data));
            myMessage(msg)
            $('#message-input').val('')
        })
    })

    function newMessage(msg) {
        const imgs = getImages()

        html = `<div class="col-8 msg-item left-msg">
                    <div class="msg-img">
                      <img class="img-thumbnail rounded-circle" src="/img/logo-user-chat.png">
                    </div>
                    <div class="msg-text">
                      <span class="author">` + msg.author + `</span> <span class="time">` + msg.time + `</span><br>
                      <p>` + msg.message + `</p>
                    </div>
                  </div>`
        $('#messages').append(html)
        scrollMsgBottom()

    }

    function myMessage(msg) {
        var name = '<?= session()->get('firstname') ?>'
        const imgs = getImages()
        var date = new Date;
        var minutes = date.getMinutes();
        var hour = date.getHours();
        var time = hour + ':' + minutes
        html = `<div class="col-8 msg-item right-msg offset-4">
                    <div class="msg-img">
                      <img class="img-thumbnail rounded-circle" src="/img/logo-user-chat.png">
                    </div>
                    <div class="msg-text">
                      <span class="author">Me</span> <span class="time">` + time + `</span><br>
                      <p>` + msg + `</p>
                    </div>
                  </div>`
        $('#messages').append(html)
        scrollMsgBottom()
    }

    function updateUsers(users) {
        var html = ''
        var myId = <?= session()->get('id') ?>;


        for (let index = 0; index < users.length; index++) {
            if (myId != users[index].c_user_id)
                html += '<a href="chatroom/' + users[index].c_user_id + '"><li class="list-group-item">' + users[index]
                .c_name + '</li></a>'
        }

        if (html == '') {
            html = '<p>The Chat Room is Empty</p>'
        }


        $('#user-list').html(html)


    }
    </script>

    <!-- footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
<!-- end footer -->