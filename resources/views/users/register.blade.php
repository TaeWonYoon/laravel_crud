@extends('layouts.layout')

@section('content')


<form method="POST" action="{{ route('users.store') }}" class="signup-form" id="loginForm">
    @csrf

    <label for="name">이름</label>
    <input type="text" id="name" name="name" placeholder="이름을 입력하세요" required>

    <label for="userId">아이디</label>
    <div class="input-with-button">
        <input type="text" id="userId" name="user_id" placeholder="아아디을 입력하세요" required>
        <button type="button" class="check-btn" id="idChck">중복 확인</button>
    </div>

    <label for="genderM">성별</label>
    <div class="">
        <input type="radio" id="genderM" name="gender" value="M" required> <label for="genderM">남</label>
        <input type="radio" id="genderW" name="gender" value="W" required> <label for="genderW">여</label>
    </div>

    <label for="password">비밀번호</label>
    <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" maxlength="12" required>
    <span id="pwdTxt" style="color:red;"></span>
    <br>
    <label for="password_confirmation">비밀번호 확인</label>
    <input type="password" id="password_confirmation" name="password_confirmation" maxlength="12" placeholder="비밀번호를 다시 입력하세요" required>

    <button type="button" id="loginSubmit" class="btn btn-primary">회원가입</button>
</form>

<script>

    var loginChck = "N";

    //중복확인
    $("#idChck").click(function() {
       const userId = $('#userId').val();
       if($('#userId').val() == '') {
        alert("아이디를 입력해 주세요");
        $('#userId').focus();
        return;
       }
        
        $.ajax({
            url: '/check-user-id',
            method: 'POST',
            data: {
                user_id: userId,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response);
                if (response.exists) {
                    alert('이미 존재하는 아이디입니다.');
                } else {
                    alert('사용 가능한 아이디입니다.');
                    loginChck = "Y";
                }
            },
            error: function () {
                alert('서버 오류가 발생했습니다.');
            }
        });
    })

     //패스워드 확인 시작
    $("#password").keyup(function() {
        var pwdc = $("#password_confirmation");
        var pwd = $("#password");
        if(pwdc.val() != "") {
            if(pwd.val() == pwdc.val()) {
                $("#pwdTxt").text("비밀번호와 동일합니다.")
            } else {
                $("#pwdTxt").text("비밀번호와 다릅니다.")
            }
        }
    })    

    $("#password_confirmation").keyup(function() {
        var pwdc = $("#password_confirmation");
        var pwd = $("#password");
        if(pwdc.val().length > 5) {
            if(pwd.val() == pwdc.val()) {
                $("#pwdTxt").text("비밀번호와 동일합니다.")
            } else {
                $("#pwdTxt").text("비밀번호와 다릅니다.")
            }
        }
    })
    //패스워드 확인 종료

    

    //회원가입 시 밸리데이션
    $("#loginSubmit").click(function() {
        if($("#name").val() == "" || $("#name").val() == "undefined") {
            alert("이름을 입력해 주세요.");
            $("#name").focus();
            return;
        } else if($("#userId").val() == "") {
            alert("아이디를 입력해 주세요.");
            $("#userId").focus();
           return;
        } else if($("[name='gender']:checked").val() == "" || $("[name='gender']:checked").val() == undefined) {
            alert("성별을 선택해 주세요.");
            $("#genderM").focus();
            return;
        } else if($("#password").val() == "") {
            alert("패스워드를 입력해 주세요.");
            $("#password").focus();
           return;
        } else if($("#password_confirmation").val() == "") {
            alert("패스워드 확인을 입력해 주세요."); 
            $("#password").focus();
            return;
        } else { //밸리데이션 통과 후
            registerSubmit();
            return;
        }

    })

    //기본 밸리데이션 -> 회원가입 
    function registerSubmit() {
        if(loginChck != "Y") {
            alert("중복확인을 눌러주세요.");
            return;
        } else if($("#password").val() != $("#password_confirmation").val()) {
            alert("비밀번호와 비밀번호 확인이 다릅니다.")
            return;
        } else {
            $("#loginForm").submit();
        }
    }

   

</script>

@endsection('content')

