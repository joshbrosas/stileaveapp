<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="STI College Naga Online web application">
    <title>404: Not Found</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico')  }}">
    <style>
        #error{
           margin-left: 25%;
        }

        #txterror{
           margin-left: 20px;
           font-family: arial, sans-serif;
           color: #a94442;
           font-size: 18px;
        }

        body{
            background-color: #ddd;
        }

        #div{
            background-color: #ffffff;
            padding: 20px;
            width: 30%;
            margin-left: 32%;
            margin-top: 10%;
            border-radius: 5px;
            -webkit-box-shadow: 2px 2px 22px -3px rgba(0,0,0,0.75);
            -moz-box-shadow: 2px 2px 22px -3px rgba(0,0,0,0.75);
            box-shadow: 2px 2px 22px -3px rgba(0,0,0,0.75);
        }

    </style>
</head>
    <body>
<div id="div">
    {{ HTML::image('img/error.png', '',array('id'  => 'error')) }}
    <h1 id="txterror"><strong><i>Whoops</i>, looks like something went wrong.</strong></h1>
</div>


</body>
</html>