<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body class="bg-gray-300">
    <nav class = "p-6 bg-white flex justify-between mb-5">
        <ul class = "flex ">
            <li class = "mr-3">
                <a href="{{route('home')}}"> Home </a>
            </li>

            <li class = "mr-3">
                <a href="{{route('dashboard')}}"> Dashboard </a>
            </li>

            <li class = "mr-3">
                <a href="{{route('posts')}}"> Posts </a>
            </li>

        </ul>

        <ul class = "flex items-center ">

            @auth 

            <li class = "mr-5">
                <a href=""> {{auth()->user()->name}} </a>
            </li>

            <li class = "mr-3">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit"> Logout </button>
                </form>
            </li>

            @endauth


            @guest
            
            <li class = "mr-3">
                <a href="{{route('login')}}"> Login </a>
            </li>

            <li class = "mr-3">
                <a href= "{{ route ('register') }} " > Register </a>
            </li>

            @endguest
    
            

        </ul>

    </nav>

    @yield('content')
</body>

</html>