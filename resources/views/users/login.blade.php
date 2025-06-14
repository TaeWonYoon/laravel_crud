@extends('layouts.layout')

@section('content')


<form method="POST" action="{{ route('login') }}" class="signup-form" id="loginForm">
    @csrf

    <label for="userId">아이디</label>
    <div class="input-with-button">
        <input type="text" id="userId" name="user_id" placeholder="아아디을 입력하세요" required>
    </div>

    <label for="password">비밀번호</label>
    <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" maxlength="12" required>
    <span id="pwdTxt" style="color:red;"></span>
    <br>

    <button type="button" id="loginSubmit" class="btn btn-primary">로그인</button>
</form>

<script>

    //회원가입 시 밸리데이션
    $("#loginSubmit").click(function() {
         if($("#userId").val() == "") {
            alert("아이디를 입력해 주세요.");
            $("#userId").focus();
           return;
        } else if($("#password").val() == "") {
            alert("패스워드를 입력해 주세요.");
            $("#password").focus();
           return;
        } 
        $("#loginForm").submit();

    })

</script>

@endsection('content')

