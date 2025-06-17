<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>CRUD 게시판</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="top">
        <div class="container">
            <h1>Default CRUD</h1>
            <nav>
                <a href="/">홈</a>
                <a href="{{ route('boards.index') }}">게시판</a>
                {{-- Blade에서 세션 메시지 출력 --}}
                @if(session('level') == 9)
                    <a href="{{ route('admins.index') }}">회원관리</a>
                @endif
                @if(session('user'))
                    <form action="{{ route('logout') }}" id="logoutForm" method="POST" style="display:none;">
                        @csrf
                    </form>
                    <a href="javascript:void(0);" onclick="userLogout()">로그아웃</a>
                @else
                    <a href="{{ route('users.create') }}">회원가입</a>
                    <a href="{{ route('users.index') }}">로그인</a>
                @endif
            </nav>

        <!-- <p>저장된 세션 데이터: {{ session('user') }}</p> -->
            <div id="loginTxt" style="float:right;">
                @if(session('name'))
                    {{ session('name') . '(' . session('user') . ')' }}님 환영합니다.
                @endif
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
    <script>
        //@json(session('name')) 세션정보 확인
        function userLogout() {
            $("#logoutForm").submit();
        }
    </script>
</body>
</html>