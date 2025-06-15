@extends('layouts.layout')

@section('content')

<style>
.board-form {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.board-form .form-group {
    margin-bottom: 1.5rem;
}

.board-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.board-form input[type="text"],
.board-form textarea,
.board-form input[type="file"] {
    width: 100%;
    padding: 0.6rem 0.8rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.3s ease;
}

.board-form input[type="text"]:focus,
.board-form textarea:focus,
.board-form input[type="file"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
}

.board-form textarea {
    resize: vertical;
}

.btn-submit {
    background-color: #007bff;
    color: white;
    padding: 0.7rem 1.4rem;
    border: none;
    border-radius: 5px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.25s ease;
    display: block;
    width: 100%;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.btn-list {
    background-color:rgb(122, 126, 136);
    color: white;
    padding: 0.7rem 1.4rem;
    border: none;
    border-radius: 5px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.25s ease;
    display: block;
    width: 100%;
}

.btn-list:hover {
    background-color: rgb(195, 202, 218);
}

.error-msg {
    color: #d93025;
    margin-top: 0.3rem;
    font-size: 0.9rem;
}
#boardTitle {
    margin-left: 27%;
}
</style>

<div class="container mt-5">
    <h2 id="boardTitle">📝 게시글 작성</h2>
    

<form action="{{ route('boards.store') }}" method="POST" enctype="multipart/form-data" class="board-form">
    @csrf
    <div class="form-group">
        <label for="subject">제목</label>
        {{ $board ->subject }}
    </div>

    <div class="form-group">
        <label for="contents">내용</label>
        {{ $board ->contents }}
    </div>

    <div class="form-group">
        <label for="file">파일 업로드</label>

        @foreach ($board->files as $file)
        <img src="{{ Storage::url($file->file_path) }}" width="300" height="250" alt="파일 이미지">
        <br/>
        <a href="{{ Storage::url($file->file_path) }}" download>
            {{ $file->file_name }} ({{ number_format($file->file_size / 1024, 2) }} KB)
        </a>
        @endforeach
    </div>
    <button type="button" class="btn-submit" onclick="location.href='{{ route('boards.edit', $board->id) }}'">수정</button>
    <br/>
    <button type="button" class="btn-list" id="listAct">목록</button>
</form>

</div>
<script>
    $("#listAct").click(function() {
        location.href = "/boards"
    })
</script>

@endsection