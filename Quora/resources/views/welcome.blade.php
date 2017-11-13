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
                <button class="btn btn-danger navbar-btn" data-toggle="modal" data-target="#askQuestion">Ask</button>
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
                 <a href="#" class="list-group-item" onclick="loadTopic(0)">Movies</a>
                 <a href="#" class="list-group-item" onclick="loadTopic(1)">Big Data</a>
                 <a href="#" class="list-group-item" onclick="loadTopic(2)">Third item</a>
             </div>


         </div>
        <div class="col-md-7" id="main-body">
            @foreach($questions as $question)
                <div class="panel panel-default" id="{{$question->id}}_body">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{asset('/images/default-profile.png')}}" alt="profile" style=" width: 50px">
                            </div>
                            <div class="col-md-11">
                                <h4 style="margin-left: 5px">{{$question->question}}</h4>
                            </div>


                        </div>
                         </div>
                    <div class="panel-body">
                        {{$question->answer}}
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-primary">Upvote | {{$question->upvote}}</button>
                                <a style="margin-left: 10px" onclick="remove({{$question->id}})" href="#">Downvote</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="usr"></label>
                                    <input type="text"  placeholder="Add a comment..." class="form-control" id="{{$question->id}}_comment">
                                    <div class="col-md-12" id="{{$question->id}}_load-comments" style="margin-top: 5px">
                                        <a href="#" onclick="getComments({{$question->id}})">View Comments</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="usr"></label>
                                <button style="margin-top: 18px" id="storeComment" onclick="storeComment({{$question->id}})" type="button" class="btn btn-default">Comment</button>
                                </div>
                            </div>
                        </div>

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


<div id="askQuestion" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ask Question</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                        <div class="form-group">
                            <label for="askQuestion">Question:</label>
                            <input style="width: 45%" type="text"  class="form-control" id="ask_Question" placeholder="Ask your Question" name="question">
                        </div>
                        <button type="submit" onclick="askQuestion()" class="btn btn-default">Submit</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function askQuestion() {
        var comment = $('#ask_Question').val();
        $.post("/api/question", {question: comment}, function(result){
        });
    }
</script>
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
                        '                    <div class="row"> '    +
                        '                    <div class="col-md-5">' +
                        '                    <button type="button" class="btn btn-primary">Upvote | '+value.upvote+'</button>\n' +
                       ' <a style="margin-left: 10px" onclick="remove('+value.id+')" href="#">Downvote</a>' +
                        '                    </div></div>' +
                        '                    </div>\n' +
                        '<div class="row">\n' +
                        '                            <div class="col-md-8">\n' +
                        '                                <div class="form-group">\n' +
                        '                                    <label for="usr"></label>\n' +
                        '                                    <input type="text"  placeholder="Add a comment..." class="form-control" id="'+value.id+'_comment">\n' +
                        '                                    <div class="col-md-12" id="'+value.id+'_load-comments" style="margin-top: 5px">\n' +
                        '                                        <a href="#" onclick="getComments('+value.id+')">View Comments</a>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-4">\n' +
                        '                                <div class="form-group">\n' +
                        '                                <label for="usr"></label>\n' +
                        '                                <button style="margin-top: 18px" id="storeComment" onclick="storeComment('+value.id+')" type="button" class="btn btn-default">Comment</button>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>'+
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
<script>
    function storeComment(id)
    {
        var comment = $('#'+id+'_comment').val();
        $.post("/api/question/comment/store", {comment: comment, question_id: id}, function(result){
            getComments(id)
        });
    }
    function getComments(qid) {
        $('#'+qid+'_load-comments').empty()
        $.ajax({url: '/api/question/'+qid+'/comments', success: function(result){
            var html =''
            jQuery.each(result, function (key, value){
                var comment = '<div class="panel panel-default" style="margin-bottom: 5px"><div class="panel-body"><div class="row"><div class="col-md-1"> <img src="{{asset("/images/default-profile.png")}}" style="width: 28px;"> </div> <div class="col-md-11">'+value.comment+'</div></div></div></div>'
                html = html + comment
            })
            $('#'+qid+'_load-comments').append(html)
        }});
    }
</script>

<script>
    function remove(id) {
        $('#'+id+"_body").slideUp()
    }
</script>

</body>

</html>

