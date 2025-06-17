@extends('layouts.layout')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📋 게시판 목록 ({{ $lists->total() }})</h2>
        @if(session('name'))
        <a href="{{ route('boards.create') }}" class="btn btn-primary">
            ✏️ 글쓰기
        </a>
        @endif
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3" style="float:right;">
        <form method="GET" action="{{ route('boards.index') }}" class="mb-3 d-flex gap-2 align-items-center">
            <select name="search" id="" class="form-control w-auto">
                <option value="00" {{ request('search') == '' || request('search') == '00' ? 'selected' : '' }}>전체</option>
                <option value="01" {{ request('search') == '01' ? 'selected' : '' }}>제목</option>
                <option value="10" {{ request('search') == '10' ? 'selected' : '' }}>작성자</option>
                <option value="11" {{ request('search') == '11' ? 'selected' : '' }}>작성일</option>
            </select>
            <input type="text" name="keyword" class="form-control w-auto" placeholder="검색" value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-outline-secondary">검색</button>
            <a href="{{ route('boards.index') }}" class="btn btn-outline-danger">초기화</a>
        </form>
    </div>
    <table class="table table-bordered">
        <colgroup>
            <col style="width: 10%;">
            <col style="width: 60%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
        </colgroup>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">제목</th>
            <th style="text-align:center;">작성자</th>
            <th style="text-align:center;">작성일</th>
            <th style="text-align:center;">조회수</th>
        </tr>
        @forelse ($lists as $index => $ls)
        <tr>
            <th style="text-align:center;">{{ $lists->total() - ($lists->firstItem() + $index - 1) }}</th>
            <th ><a href="{{ route('boards.show', $ls -> id) }}">{{ $ls -> subject }}</a></th>
            <th style="text-align:right;">{{ $ls -> insert_id }}</th>
            <th style="text-align:right;">{{ $ls->created_at->format('Y-m-d') }}</th>
            <th style="text-align:right;">{{ $ls -> views }}</th>
        </tr>
        @empty
        <tr>
            <th colspan="4">게시글이 없습니다.</th>
        </tr>
        @endforelse
    </table>
{{-- 페이지네이션 링크 --}}
<nav style="display: flex; justify-content: center;">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</nav>


@endsection
