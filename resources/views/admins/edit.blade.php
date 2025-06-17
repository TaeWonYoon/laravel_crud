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
    <h2 id="boardTitle">📝 게시글 수정</h2>
    
<form action="{{ route('admins.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="board-form">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="subject">아이디</label>
        {{ $user -> user_id }}
    </div>

    <div class="form-group">
        <label for="contents">이름</label>
        <input type="text" id="" name="name" rows="6" value="{{ $user ->name }}" required>
    </div>

    <div class="form-group">
        <label for="subject">권한</label>
        <select name="level" id="" class="form-control w-auto">
            <option value="1" {{ $user -> level == '1' ? 'selected' : '' }}>사용자</option>
            <option value="9" {{ $user -> level == '9' ? 'selected' : '' }}>관리자</option>
        </select>
    </div>

    <div class="form-group">
        <label for="contents">초기화</label>
        <button type="button" class="btn-submit w-auto" onclick="resetPassword({{ $user->id }})">비밀번호 초기화</button>
    </div>

    <button type="submit" class="btn-submit">수정</button>
    <br/>
    <button type="button" class="btn-list" id="listAct">목록</button>
</form>

</div>
<script>

    $("#listAct").click(function() {
        location.href = "/admins"
    })
   
   function resetPassword(id) {
        if (!confirm('해당 계정의 비밀번호를 초기화하시겠습니까?')) return;

        $.ajax({
            url: '/admins/resetPassword/' + id,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                location.href = "/admins";
            },
            error: function(xhr) {
                alert('비밀번호 초기화 중 오류가 발생했습니다.');
            }
        });
    }
</script>
@endsection