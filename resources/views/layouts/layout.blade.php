<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입 게시판</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="top">
        <div class="container">
            <h1>Simple Board</h1>
            <nav>
                <a href="/">홈</a>
                <a href="/users/create">회원가입</a>
                {{-- Blade에서 세션 메시지 출력 --}}
                @if(session('status'))
                    <a href="">로그아웃</a>
                @else
                    <a href="{{ route('users.index') }}">로그인</a>
                @endif
            </nav>

        <!-- <p>저장된 세션 데이터: {{ session('user') }}</p> -->
            <div id="loginTxt" style="float:right;">
                윤태원님 환영합니다.
            </div>
        </div>
    </header>

    <main class="content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            &copy; {{ date('Y') }} Simple Board. All rights reserved.
        </div>
    </footer>
</body>
</html>