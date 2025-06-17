@extends('layouts.layout')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📋 회원관리 목록 ({{ $lists->total() }})</h2>

    </div>
    <div class="d-flex justify-content-between align-items-center mb-3" style="float:right;">
        <form id="searchForm" method="GET" action="{{ route('admins.index') }}" class="mb-3 d-flex gap-2 align-items-center">
            <select name="search" id="" class="form-control w-auto">
                <option value="00" {{ request('search') == '' || request('search') == '00' ? 'selected' : '' }}>기본</option>
                <option value="01" {{ request('search') == '01' ? 'selected' : '' }}>이름</option>
                <option value="10" {{ request('search') == '10' ? 'selected' : '' }}>아이디</option>
                <option value="11" {{ request('search') == '11' ? 'selected' : '' }}>가입일</option>
            </select>
            <select name="search_level" id="" class="form-control w-auto">
                <option value="00" {{ request('search_level') == '' || request('search') == '0' ? 'selected' : '' }}>사용자 등급</option>
                <option value="1" {{ request('search_level') == '1' ? 'selected' : '' }}>사용자</option>
                <option value="9" {{ request('search_level') == '9' ? 'selected' : '' }}>관리자</option>
            </select>
           <select name="search_view_ty" id="" class="form-control w-auto">
                <option value="N" {{ request('search_view_ty') == '' || request('search') == 'N' ? 'selected' : '' }}>정상</option>
                <option value="Y" {{ request('search_view_ty') == 'Y' ? 'selected' : '' }}>탈퇴</option>
                <option value="A" {{ request('search_view_ty') == 'A' ? 'selected' : '' }}>전체</option>
            </select>


            <input type="text" name="keyword" class="form-control w-auto" placeholder="검색" value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-outline-secondary">검색</button>
            <a href="{{ route('admins.index') }}" class="btn btn-outline-danger">초기화</a>
        </form>
    </div>
    <table class="table table-bordered">
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 5%;">
        </colgroup>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">이름</th>
            <th style="text-align:center;">아이디</th>
            <th style="text-align:center;">등록일</th>
            <th style="text-align:center;">권한</th>
            <th style="text-align:center;">관리</th>
        </tr>
        @forelse ($lists as $index => $ls)
        <tr id="{{ $ls->id }}">
            <th style="text-align:center;">{{ $lists->total() - ($lists->firstItem() + $index - 1) }}</th>
            <th style="text-align:center;"><a href="{{ route('admins.edit', $ls -> id) }}">{{ $ls -> name }}</a></th>
            <th style="text-align:right;">{{ $ls -> user_id }}</th>
            <th style="text-align:right;">{{ $ls->created_at->format('Y-m-d') }}</th>
            <th style="text-align:right;">
                @if($ls -> level != 9)
                    사용자
                    @if($ls -> delete_at == 'Y')
                        <br />
                        <span style="color:red">(탈퇴)</span>
                    @endif
                @else
                    관리자
                    @if($ls -> delete_at == 'Y')
                        <br />
                        <span style="color:red">(탈퇴)</span>
                    @endif
                @endif
            </th>
            <th style="text-align:center;">
                @if($ls -> level == '1' && $ls -> delete_at == 'N')
                <button type="button" class="btn btn-danger" onclick="userDel({{ $ls->id }})">탈퇴</button>
                @elseif($ls -> level == '1' && $ls -> delete_at == 'Y')
                <button type="button" class="btn btn-primary" onclick="userRest({{ $ls->id }})">복구</button>
                @endif
            </th>
        </tr>
        @empty
        <tr>
            <th colspan="4">회원이 없습니다.</th>
        </tr>
        @endforelse
    </table>
{{-- 페이지네이션 링크 --}}
<nav style="display: flex; justify-content: center;">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</nav>

<script>
    @if (session('alert'))
        alert("{{ session('alert') }}");
    @endif

    function userDel(id) {
        if (!confirm('해당 계정을 탈퇴 하시겠습니까?')) return;
        $.ajax({
            url: '/admins/' + id,   // 파일 삭제 라우트 URL
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}' // CSRF 토큰 필수
            },
            success: function(response) {
                alert('회원 탈퇴가 완료되었습니다. .');
                $("#searchForm").submit();
            },
            error: function(xhr) {
                alert('삭제 중 오류가 발생했습니다.');
            }
        });
    }

    function userRest(id) {
        if (!confirm('해당 계정을 복구 하시겠습니까?')) return;
        $.ajax({
            url: '/attrChange/' + id,   // 파일 삭제 라우트 URL
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}' // CSRF 토큰 필수
            },
            success: function(response) {
                alert('회원 복구가 완료되었습니다. .');
                $("#searchForm").submit();
            },
            error: function(xhr) {
                alert('삭제 중 오류가 발생했습니다.');
            }
        });
    }

</script>

@endsection
