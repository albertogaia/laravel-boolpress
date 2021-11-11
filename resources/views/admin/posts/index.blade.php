@extends('layouts.dashboard')
@section('title', 'All Posts')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (session('updated'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
    @endif
    @if (session('inserted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('inserted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('deleted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
    @endif

    <div class="row mb-3">
        <div class="col-12">
            <div class="float-right">
                <div class="btn btn-success"><a class="text-reset" href="{{route('admin.posts.create')}}">Nuovo Post</a></div>
                <button type="button" class="btn btn-danger" id="deleteAllSelectedRecords">Delete Selected</button>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col"><input type="checkbox" name="ids" id="checkBoxAll" class="checkBoxClass"></th>
            <th scope="col"># ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Categoria</th>
            <th class="text-center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr id='pid{{$post->id}}'>
                    <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$post->id}}"></td>
                    <th scope="row">{{$post->id}}</th>
                    <td><a href="{{ route('admin.posts.show', $post->id) }}">{{$post->title}}</a></td>
                    <th scope="row">
                        @if ($post->category)
                            <a class="text-reset" href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a>
                        @endif
                    </th>
                    <td class="text-center">
                        <a class="mx-2 text-reset btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                        <form action="{{route('admin.posts.destroy', $post->id)}}" class="d-inline-block delete-post" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mx-2" type="submit">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <script>
        $(function(e){
            $('#checkBoxAll').click(function(){
                $('.checkBoxClass').prop('checked', $(this).prop('checked'));
            });

            $('#deleteAllSelectedRecords').click(function(e){
                e.preventDefault();
                var allids =[];
                $('#input:checkbox[name=ids]:checked').each(function(){
                    allids.push($(this).val());
                })

                $.ajax({
                    url: "{{route('admin.deletePost')}}",
                    type: 'DELETE',
                    data: {
                        ids:allids,
                        _token:$('input[name=_token]').val()
                    },
                    success: function(response){
                        $.each(allids, function(key, val){
                            $('#pid'+val).remove();
                        })
                    }
                })
            })
        })
    </script>
@endsection