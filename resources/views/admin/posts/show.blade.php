<h1>Detalhes do Post {{ $post->title }}</h1>

<ul>
    <li><strong>Título: </strong>{{ $post->title }}</li>
    <li><strong>Conteúdo: </strong>{{ $post->content }}</li>
</ul>

<form action="{{ route('posts.delete', $post->id) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit">Deletar</button>
</form>
