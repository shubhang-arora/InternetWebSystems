<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#" >Quora</a>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Answer</a></li>
                    <li><a href="#">Notification</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-md-offset-1">
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger navbar-btn">Ask</button>
            </div>

        </div>


    </div>
</nav>

<div class="container">
    <div class="row">
         <div class="col-md-2">
             <h5>Feeds</h5>
             <hr style="margin-top: 10px; height:1px;"/>
             <h6>Trending Topics</h6>
             <div class="list-group">
                 <a href="#" class="list-group-item" onclick="loadTopic(0)">First item</a>
                 <a href="#" class="list-group-item" onclick="loadTopic(1)">Second item</a>
                 <a href="#" class="list-group-item" onclick="loadTopic(2)">Third item</a>
             </div>


         </div>
        <div class="col-md-7" id="main-body">
            @foreach($questions as $question)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{$question->question}}</h4>
                    </div>
                    <div class="panel-body">
                        {{$question->answer}}
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-primary">Upvote</button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3">
            <iframe src="//www.google.com/maps/embed/v1/place?q=Harrods,Brompton%20Rd,%20UK
      &zoom=17
      &key=AIzaSyCOQ81KucyxmQ9FRTvpaN0O2hYW-Un6kNU">
            </iframe>
        </div>
    </div>
</div>
<script>
    function loadTopic(e)
    {
        $('#main-body').empty()
        $.ajax({url: "/api/question/topic/"+e, success: function(result){
            var html = ''
            if(result)
            {
                jQuery.each(result, function (key, value) {
                    var question = '<div class="panel panel-default">\n' +
                        '                    <div class="panel-heading">\n' +
                        '                    <h4>'+ value.question +'</h4>\n' +
                        '                    </div>\n' +
                        '                    <div class="panel-body">'+ value.answer +' \n' +
                        '                         \n' +
                        '                    </div>\n' +
                        '                    <div class="panel-footer">\n' +
                        '                    <button type="button" class="btn btn-primary">Upvote</button>\n' +
                        '                    </div>\n' +
                        '                    </div>'

                    html = html + question

                })
                $('#main-body').append(html)
            }
            else
            {
                $('#main-body').append("No questions yet")
            }

        }});
    }
</script>

</body>

</html>

