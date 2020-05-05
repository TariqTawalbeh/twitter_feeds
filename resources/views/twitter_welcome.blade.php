<head>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
         <h2>Twitter Tweets</h2>
        <ul class="ds-btn">
            <li>
                <a class="btn btn-lg btn-info" href="#" id="english_tweets">
                <i class="glyphicon glyphicon-list pull-left"></i><span>English Tweets<br><small>@UnitedNationsJO</small></span></a>
            </li>
            <li>
                <a class="btn btn-lg btn-info" href="#" id="arabic_tweets">
                <i class="glyphicon glyphicon-list pull-left"></i><span>Arabic Tweets<br><small>@UnitedNationsJO</small></span></a>
            </li>
        </ul>

        </div>
    </div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 offset-md-3" id="tweets">

        </div>
    </div>
</div>



<style type="text/css">
        .ds-btn li{ list-style:none; float:left; padding:10px; }
        .ds-btn li a span{padding-left:15px;padding-right:5px;width:100%;display:inline-block; text-align:left;}
        .ds-btn li a span small{width:100%; display:inline-block; text-align:left;}

        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
</style>
<script src="{{ URL::asset('js/tweets.js') }}"></script>
</body>
