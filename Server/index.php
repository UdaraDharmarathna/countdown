<!DOCTYPE html>
<html>
    <head>
        <title>Timer</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        
        <style>
            * {
              box-sizing: border-box;
            }
            body {
              font-family: Arial, Helvetica, sans-serif;
              margin: 0;
              height: 100vh;
              width: 100vw;
            }
            .header {
              padding: 80px;
              text-align: center;
              background: #1abc9c;
              color: white;
              height: 100vh;
              width: 100vw;
            }
            .header h1 {
              font-size: 40px;
            }
            .main{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .main input{
                width: 200px;
                height: 30px;
            }
            .main label{
                width: 200px;
                text-align: left;
            }
        </style>
        
    </head>    
<body>

    <div class="header">
        <h1>Setup Timer</h1>
        
        <form method="POST" action="/api/countdownController.php">
            <div class="main">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" placeholder="Eg: New Year"><br>

                <label for="date">Date:</label>
                <input type="text" id="date" name="date" placeholder="Eg: 2022-01-01"><br>

                <label for="time">Time:</label>
                <input type="text" id="time" name="time" placeholder="Eg: 00:00"><br><br>

                <input type="button" value="Submit" onclick="save()"><br>
                <div id="responseMsg">

                </div>
            </div>
        </form> 
    </div>

    <script>

    function save() {
        var title = document.getElementById("title").value;
        var date = document.getElementById("date").value;
        var time = document.getElementById("time").value;
        $.ajax({
                type : "POST",
                url  : "/api/countdownController.php",
                data : { title : title, date : date, time : time },
                success: function(res){
                    const responseMsg = document.getElementById('responseMsg');

                    var responseData = jQuery.parseJSON(res);

                    var code = responseData.response.statusCode;
                    var msg = responseData.response.statusMessage;
                    var status = responseData.response.status;
                    if(code === 200 && status){
                        responseMsg.innerHTML = "Countdown data was successfully added!";
                        title.value  = "";
                        date.value  = "";
                        time.value  = "";
                    }else{
                        responseMsg.innerHTML = msg;
                    }
                }
            });
        }

    </script>

</body>
</html>