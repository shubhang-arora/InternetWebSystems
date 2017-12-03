<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCj0pS-iu-9y2EKDrJlo7a2_X-qCsXpVno&callback=initMap">
    </script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#home" >Quora</a>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
                <ul class="nav navbar-nav nav-pill">
                    <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
                    <li><a data-toggle="pill" href="#answer">Answer</a></li>
                    <li><a data-toggle="pill" href="#bookmarked">Bookmarked</a></li>

                </ul>
            </div>
            <div class="col-md-2 col-md-offset-1">

            </div>
            <div class="col-md-2">
                <button class="btn btn-danger navbar-btn" data-toggle="modal" data-target="#askQuestion">Ask</button>
            </div>

        </div>


    </div>
</nav>



<div class="container">
    <div class="row">
        <div class="tab-content col-md-12">
            <div id="home" class="tab-pane fade in active col-md-12">
                <div class="col-md-2">
                    <h5>Feeds</h5>
                    <hr style="margin-top: 10px; height:1px;"/>
                    <h6>Trending Topics</h6>
                    <div class="list-group">
                        <a href="#" class="list-group-item" onclick="loadTopic(0)">Movies</a>
                        <a href="#" class="list-group-item" onclick="loadTopic(1)">Big Data</a>
                        <a href="#" class="list-group-item" onclick="loadTopic(2)">Block Chain</a>
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

                                            <h4 style="margin-left: 5px">{{$question->question}}
                                                @if($question->bookmarked) <img id="question_bookmark_{{$question->id}}" onclick="bookmark({{$question->id}})" style="width: 30px" src="{{asset('images/bookmarked.png')}}" alt="">
                                                    @else
                                                    <img id="question_bookmark_{{$question->id}}" onclick="bookmark({{$question->id}})" style="width: 30px" src="{{asset('images/bookmark.png')}}" alt="">
                                                    @endif
                                            </h4>

                                        </div>


                                    </div>
                                </div>
                                <div class="panel-body">
                                    {{$question->answer}}
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="button" id="upvote_{{$question->id}}" onclick="upVote({{$question->id}})" class="btn btn-primary">Upvote | {{$question->upvote}}</button>
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
                    <div id="map"  style="width:250px;height:250px; float: right; position: relative;  padding:  20px 0 0 1.5rem; padding-top: 20px; float: top"></div>

                </div>
            </div>

            <div class="tab-pane fade" id="answer">

                <div class="col-md-7 col-md-offset-2" id="answer-body">
                    @foreach($answers as $question)
                        <div class="panel panel-default" id="{{$question->id}}_answer_body">
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
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Answer this Question" rows="5" id="answerQuestion_{{$question->id}}"></textarea>
                                </div>
                                <div class="form-group">
                                    <button style="float: right" type="button" id="questionAnswer" onclick="answerQuestion({{$question->id}})" class="btn btn-success">Submit Answer</button>
                                </div>
                            </div>
                            <div class="panel-footer">

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

            </div>
            <div id="bookmarked" class="tab-pane fade ">
                <div class="col-md-2">
                    <h5>Feeds</h5>
                    <hr style="margin-top: 10px; height:1px;"/>
                    <h6>Trending Topics</h6>
                    <div class="list-group">
                        <a href="#" class="list-group-item" onclick="loadTopic(0)">Movies</a>
                        <a href="#" class="list-group-item" onclick="loadTopic(1)">Big Data</a>
                        <a href="#" class="list-group-item" onclick="loadTopic(2)">Block Chain</a>
                    </div>
                </div>
                <div class="col-md-7" id="main-body">
                    fa
                    @foreach($bookmarked as $question)
                        <div class="panel panel-default" id="{{$question->id}}_body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('/images/default-profile.png')}}" alt="profile" style=" width: 50px">
                                    </div>
                                    <div class="col-md-11">

                                        <h4 style="margin-left: 5px">{{$question->question}}
                                            @if($question->bookmarked) <img id="question_bookmark_{{$question->id}}" onclick="bookmark({{$question->id}})" style="width: 30px" src="{{asset('images/bookmarked.png')}}" alt="">
                                            @else
                                                <img id="question_bookmark_{{$question->id}}" onclick="bookmark({{$question->id}})" style="width: 30px" src="{{asset('images/bookmark.png')}}" alt="">
                                            @endif
                                        </h4>

                                    </div>


                                </div>
                            </div>
                            <div class="panel-body">
                                {{$question->answer}}
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-5">
                                        <button type="button" id="upvote_{{$question->id}}" onclick="upVote({{$question->id}})" class="btn btn-primary">Upvote | {{$question->upvote}}</button>
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
                    <div id="map"  style="width:250px;height:250px; float: right; position: relative;  padding:  20px 0 0 1.5rem; padding-top: 20px; float: top"></div>

                </div>
            </div>
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
            var question = '<div class="panel panel-default" id="'+result.id+'_answer_body">\n' +
                '                            <div class="panel-heading">\n' +
                '                                <div class="row">\n' +
                '                                    <div class="col-md-1">\n' +
                '                                        <img src="#" alt="profile" style=" width: 50px">\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-11">\n' +
                '                                        <h4 style="margin-left: 5px">'+result.question+'</h4>\n' +
                '                                    </div>\n' +
                '\n' +
                '\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="panel-body">\n' +
                '                                <div class="form-group">\n' +
                '                                    <textarea class="form-control" placeholder="Answer this Question" rows="5" id="answerQuestion_'+result.id+'["></textarea>\n' +
                '                                </div>\n' +
                '                                <div class="form-group">\n' +
                '                                    <button style="float: right" type="button" id="questionAnswer" onclick="answerQuestion('+result.id+')" class="btn btn-success">Submit Answer</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="panel-footer">\n' +
                '\n' +
                '                                <div class="row">\n' +
                '                                    <div class="col-md-8">\n' +
                '                                        <div class="form-group">\n' +
                '                                            <label for="usr"></label>\n' +
                '                                            <input type="text"  placeholder="Add a comment..." class="form-control" id="'+result.id+'_comment">\n' +
                '                                            <div class="col-md-12" id="'+result.id+'_load-comments" style="margin-top: 5px">\n' +
                '                                                <a href="#" onclick="getComments('+result.id+')">View Comments</a>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-4">\n' +
                '                                        <div class="form-group">\n' +
                '                                            <label for="usr"></label>\n' +
                '                                            <button style="margin-top: 18px" id="storeComment" onclick="storeComment('+result.id+')" type="button" class="btn btn-default">Comment</button>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '\n' +
                '                            </div>\n' +
                '                        </div>'
            $('#answer-body').prepend(question)
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
                        '                    <button type="button" id="upvote_'+value.upvote+'" onclick="upVote('+value.id+')" class="btn btn-primary">Upvote | '+value.upvote+'</button>\n' +
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

<script>
    function answerQuestion(e) {
        $.post("/api/question/"+e+"/answer", {question_id: e, answer: $('#answerQuestion_'+e).val()}, function(result){
            $('#'+e+'_answer_body').detach().prependTo('#main-body')
            activaTab()
        })
    }

    function activaTab(){
        $('.nav-tabs a[href="#home"]').tab('show')
    }
</script>
<script>
    $(document).ready()
    {
        function initMap() {
            var myLatLng = {lat: 28.6139, lng: 77.2090};

            var chennai = {lat: 13.0827, lng: 80.2707};

            var kol = {lat: 22.5726, lng: 88.3639};

            var ahm = {lat: 23.0225, lng: 72.5714};

            var hyd = {lat: 17.3850, lng: 78.4867};

            var blr = {lat: 12.9716 , lng: 77.5946};

            var selected;

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: hyd
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Delhi'


            });
            var marker1 = new google.maps.Marker({
                position: chennai,
                map: map,
                title: 'Chennai'
            });
            var marker2 = new google.maps.Marker({
                position: blr,
                map: map,
                title: 'Bangalore'
            });

            var marker3 = new google.maps.Marker({
                position: hyd,
                map: map,
                title: 'Hyderabad'

            });
            var marker4 = new google.maps.Marker({
                position: kol,
                map: map,
                title: 'Kolakata'

            });

            var marker5 = new google.maps.Marker({
                position: ahm,
                map: map,
                title: 'Gujrat'


            });

            google.maps.event.addListener(marker,'click',function() {
                selected = marker.getTitle();
                console.log(selected);

                loadCity(selected);



            });

            google.maps.event.addListener(marker2,'click',function() {
                selected = marker2.getTitle();
                console.log(selected);

                loadCity(selected);


            });

            google.maps.event.addListener(marker3,'click',function() {
                selected = marker3.getTitle();
                console.log(selected);

                loadCity(selected);

            });


            google.maps.event.addListener(marker4,'click',function() {
                selected = marker4.getTitle();
                console.log(selected);

                loadCity(selected);
            });


            google.maps.event.addListener(marker5,'click',function() {
                selected = marker5.getTitle();
                console.log(selected);

                loadCity(selected);
            });

            google.maps.event.addListener(marker1,'click',function() {
                selected = marker1.getTitle();
                console.log(selected);
                loadCity(selected);
            });

        }
    }


    function loadCity(e)
    {
        $('#main-body').empty()
        $.ajax({url: "/api/question/state/"+e, success: function(result){
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
                        '                    <button type="button"  id="upvote_'+value.upvote+'" onclick="upVote('+value.id+')" class="btn btn-primary">Upvote | '+value.upvote+'</button>\n' +
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
    function upVote(question_id)
    {
        $.post("/api/question/"+question_id+"/upvote", {question_id: question_id}, function(result){
            document.getElementById('upvote_'+question_id).innerHTML = 'Upvoted | '+result.votes;
        })
    }
</script>

<script>
    function bookmark(question_id) {
        $.post("/api/question/"+question_id+"/bookmark", {question_id: question_id}, function(result){
            if(result.bookmarked)
            {
                document.getElementById('question_bookmark_'+question_id).src="http://localhost:8800/images/bookmarked.png";
            }
            else
            {
                document.getElementById('question_bookmark_'+question_id).src="http://localhost:8800/images/bookmark.png";
            }


        })
    }
</script>
</body>
</html>

