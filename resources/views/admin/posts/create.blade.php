<h1>Cadastrar Novo Post</h1>

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>    
@endif
<br>

<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="Título" value="{{old('title')}}"><br><br>
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{old('content')}}</textarea><br><br>
    <button type="submit">Criar</button>
</form>