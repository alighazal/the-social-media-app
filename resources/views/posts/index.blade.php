@extends('layout.app')

@section('content')
    
    <div class = "flex justify-center" >

        <div class = "w-8/12 bg-white p-6 rounded-lg mb-4" >
            <form action="{{route('posts')}}" method="post">
                @csrf

                <div class = "mb-2">
                    <label for="body" class= "sr-only" > body</label>
                    <textarea name  = "body" id = "body" 
                    cols = "30" rows = "4"
                    class = "bg-gray-100 border-2 w-full p-4 rounded-lg  
                    @error('body') border-red-500 @enderror"
                    placeholder="Post Something!"
                    value = ""></textarea>

                </div>

                @error ('body')
                        <div class = "text-red-500 mb-2 text-small">
                            {{ $message}}
                        </div>
                @enderror

                <div class = "flex justify-start mb-6">
                    
                    <button type = "submit" class = "bg-blue-500 text-white px-4 py-3 
                    rounded font-medium w-4/12 "> Post </button>

                </div>

            </form>

            @if ($posts->count())
                @foreach($posts as $post )
                    <div class ="mb-4">
                        <a href="" class = "font-bold"> {{$post->user->name}}</a> 
                        <span class="text-gray font-sm">{{$post->created_at->diffForHumans()   }}</span>
                        <p class = "border-l-2 pl-5 mt-2 mb-2" >{{$post->body}}</p>


                        <form action="{{route('posts.destroy', $post)}}" method = "post">
                            @csrf
                            @method('DELETE')
                            <button type = "submit" class= "text-red-500 mr-4">Delete</button>                               
                        </form>


                        <div class = "flex items-center">
                            @auth
                                @if( ! $post->likedBy(auth()->user()))

                                <form action="{{route('posts.destroy', $post)}}" method = "post">
                                    @csrf
                                    <button type = "submit" class= "text-blue-500 mr-4">Like</button>                               
                                </form>

                                @else
                                
                                <form action="{{route('posts.likes', $post)}}" method = "post">
                                    @csrf
                                    @method('DELETE')
                                    <button type = "submit" class= "text-red-500 mr-4">Unlike</button>                               
                                </form>

                                @endif
                            @endauth

                            <span> {{$post->likes()->count()}} {{Str::plural('like', $post->likes()->count())}}</span>
                    
                        </div>

                    </div>
                @endforeach

                {{$posts->links()}}
            @else 
                <p>no post here</p>
            @endif

        </div>

    </div>

@endsection

