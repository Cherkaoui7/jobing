<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Professional CV</title>

    <style>

        body{
            font-family: DejaVu Sans;
            margin:0;
            padding:0;
            color:#1e293b;
            background:#f8fafc;
        }

        .container{
            width:100%;
        }

        .sidebar{
            width:30%;
            background:#0f172a;
            color:white;
            float:left;
            min-height:100vh;
            padding:40px 25px;
            box-sizing:border-box;
        }

        .content{
            width:70%;
            float:left;
            padding:40px;
            box-sizing:border-box;
        }

        h1{
            margin:0;
            font-size:32px;
            color:white;
        }

        .job{
            margin-top:5px;
            font-size:14px;
            color:#cbd5e1;
        }

        .section-title{
            margin-top:35px;
            margin-bottom:10px;
            font-size:18px;
            font-weight:bold;
            color:#2563eb;
            border-bottom:2px solid #2563eb;
            padding-bottom:5px;
        }

        .sidebar-title{
            margin-top:30px;
            font-size:16px;
            font-weight:bold;
            color:white;
            border-bottom:1px solid rgba(255,255,255,.2);
            padding-bottom:8px;
        }

        p{
            line-height:1.8;
            font-size:14px;
        }

        .info{
            margin-top:20px;
        }

        .info p{
            margin:8px 0;
            color:#e2e8f0;
        }

        .skill-box{
            background:#2563eb;
            color:white;
            display:inline-block;
            padding:6px 12px;
            border-radius:20px;
            margin:5px;
            font-size:12px;
        }

        .clear{
            clear:both;
        }

    </style>

</head>

<body>

<div class="container">

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <h1>{{$name}}</h1>

        <div class="job">
            Full Stack Developer
        </div>

        <div class="info">

            <div class="sidebar-title">
                Contact
            </div>

            <p>
                {{$email}}
            </p>

            <p>
                {{$phone}}
            </p>

            <p>
                {{$city}}
            </p>

        </div>

        <div class="info">

            <div class="sidebar-title">
                Skills
            </div>

            @foreach(explode(',', $skills) as $skill)

                <span class="skill-box">
                    {{$skill}}
                </span>

            @endforeach

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="content">

        <div class="section-title">
            About Me
        </div>

        <p>
            {{$bio}}
        </p>

        <div class="section-title">
            Experience
        </div>

        <p>
            {{$experience}}
        </p>

        <div class="section-title">
            Education
        </div>

        <p>
            {{$education}}
        </p>

    </div>

    <div class="clear"></div>

</div>

</body>

</html>