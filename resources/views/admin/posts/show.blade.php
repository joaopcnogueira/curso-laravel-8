@extends('admin.layouts.app')

@section('title', 'Show Post')

@section('content')
    <h1>Detalhes do Post {{ $post->title }}</h1>

    <ul>
        <li><strong>Título: </strong>{{ $post->title }}</li>
        <li><strong>Conteúdo: </strong>{{ $post->content }}</li>
    </ul>

    <form action="{{ route('posts.edit', $post->id) }}">
        <button type="submit">Editar</button>
    </form>
    <br>

    <form action="{{ route('posts.delete', $post->id) }}" method="post">
        @csrf
        {{-- <input type="hidden" name="_method" value="DELETE"> --}}
        @method('delete')
        <button type="submit">Deletar</button>
    </form>
@endsection




