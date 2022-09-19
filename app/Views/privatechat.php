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
    <!-- <title>Private Chat</title> -->

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
                    <h3>Private Chat</h3>
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
    <script src="../jquery/dist/jquery-3.5.1.js"></script>

    <script src="../bs/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="../jquery/dist/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        getChat()

    })
    $(function() {
        scrollMsgBottom()

    })



    function getChat() {
        var data = {
            send_to: <?= $chat_to ?>,
            sender: <?= session()->get('id') ?>
        }
        url = "<?php echo base_url('chatroom/getchat') ?>"
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function(data) {
                // var data = JSON.parse(data)
                $.each(data, function(a, b) {
                    var msg = {
                        message: b['message'],
                        author: "<?= $getAuthor ?> ",
                        time: b['time']
                    }
                    if (b['sender'] == '<?= session()->get('id') ?>') {

                        myMessage2(msg)
                    } else {
                        newMessage(msg)
                    }

                })

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
                // $('#message').html('Tamabah Jenis Rapat Gagal')
                // $('.modal-notif').modal('show')
            }

        })
    }

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

                if (data.status == 'private') {
                    if (data.send_to == '<?= session()->get('id') ?>' && data.sender == '<?= $chat_to ?>') {
                        // showNotification(data.author, data.message, "chatroom/" + "<?= $chat_to ?>");
                        newMessage(data)
                    }
                }
            }

        };

        $('#send').on('click', function() {
            var msg = $('#message-input').val()
            if (msg.trim() == '')
                return false

            var data = {
                msg: msg,
                status: "private",
                send_to: <?php echo $chat_to ?>
            }

            var data2 = {
                msg: msg,
                status: "1",
                send_to: <?php echo $chat_to ?>,
                sender: <?= session()->get('id') ?>
            }
            url = "<?php echo base_url('chatroom/addchat') ?>"
            $.ajax({
                url: url,
                type: "POST",
                data: data2,
                dataType: "JSON",
                success: function(data) {
                    // var data = JSON.parse(data)
                    console.log(data);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR)
                    // $('#message').html('Tamabah Jenis Rapat Gagal')
                    // $('.modal-notif').modal('show')
                }

            })
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

    function myMessage2(msg) {
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
                      <span class="author">Me</span> <span class="time">` + msg.time + `</span><br>
                      <p>` + msg.message + `</p>
                    </div>
                  </div>`
        $('#messages').append(html)
        scrollMsgBottom()
    }

    function updateUsers(users) {
        var html = ''
        var myId = <?= session()->get('id') ?>;


        for (let index = 0; index < users.length; index++) {
            if (myId != users[index].c_user_id) {
                active = ''
                if (users[index].c_user_id == <?= $chat_to ?>) {
                    active = 'active'
                } else {
                    active = ''
                }
                html += '<a href="<?= base_url() . "/chatroom/" ?>' + users[index].c_user_id +
                    '"><li class="list-group-item ' + active + '">' + users[index].c_name + '</li></a>'
            }
        }

        if (html == '') {
            html = '<p>The Chat Room is Empty</p>'
        }


        $('#user-list').html(html)


    }
    </script>