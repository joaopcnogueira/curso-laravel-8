<h1>Detalhes do Post {{ $post->title }}</h1>

<ul>
    <li><strong>Título: </strong>{{ $post->title }}</li>
    <li><strong>Conteúdo: </strong>{{ $post->content }}</li>
</ul>

<form action="{{ route('posts.edit', $post->id) }}" method="post">
    @csrf
    @method('put')
    <button type="submit">Editar</button>
</form>

<form action="{{ route('posts.delete', $post->id) }}" method="post">
    @csrf
    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
    @method('delete')
    <button type="submit">Deletar</button>
</form>




