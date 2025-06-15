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
    
<form action="{{ route('boards.update', $board->id) }}" method="POST" enctype="multipart/form-data" class="board-form">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="subject">제목</label>
        <input type="text" id="subject" name="subject" value="{{ $board -> subject }}" required>
    </div>

    <div class="form-group">
        <label for="contents">내용</label>
        <textarea id="contents" name="contents" rows="6" required>{{ $board ->contents }}</textarea>
    </div>

    <div class="form-group">
        <label for="file">파일 업로드</label>
        <input type="file" id="file" name="upload_file" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt">
        <br/><br/>
        @foreach ($board->files as $file)
        <img src="{{ Storage::url($file->file_path) }}" width="300" height="250" alt="파일 이미지" class="file-view">
        <br/>
        <span class="file-view">
            {{ $file->file_name }} ({{ number_format($file->file_size / 1024, 2) }} KB)
        </span>
        <span style="color:red; font-weight:bold;" class="file-view" onclick="imgDelete({{ $file->id }})">
            [삭제]
        </span> 
        <input type="hidden" name="file_after_id" id="fileAfterId" value="{{ $file->id }}" />
        @endforeach
    </div>
    <button type="submit" class="btn-submit">작성 완료</button>
    <br/>
    <button type="button" class="btn-list" id="listAct">목록</button>
</form>

</div>
<script>
    $("#listAct").click(function() {
        location.href = "/boards"
    })

    function imgDelete(fileId) {
        if (!confirm('정말 삭제하시겠습니까?')) return;
        $.ajax({
            url: '/files/' + fileId,   // 파일 삭제 라우트 URL
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}' // CSRF 토큰 필수
            },
            success: function(response) {
                alert('파일이 삭제되었습니다.');
                $('.file-view').remove(); // 화면에서 파일 항목 제거
                $("#fileAfterId").val('');
            },
            error: function(xhr) {
                alert('삭제 중 오류가 발생했습니다.');
            }
        });
    }
</script>
@endsection