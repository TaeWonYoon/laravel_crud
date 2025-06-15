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
            <!--
            <th>
                <a href="{{ route('boards.show', $ls -> id) }}">보기</a>
                <a href="{{ route('boards.edit', $ls -> id) }}">수정</a>
                <form action="{{ route('boards.destroy', $ls -> id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        삭제
                    </button>
                </form>
            </th>
            -->
        </tr>
        @empty
        <tr>
            <th colspan="4">게시글이 없습니다.</th>
        </tr>
        @endforelse
    </table>
{{-- 페이지네이션 링크 --}}
<div class="custom-pagination">
    @if ($lists->onFirstPage())
        <span>이전</span>
    @else
        <a href="{{ $lists->previousPageUrl() }}">이전</a>
    @endif
    <span>{{ $lists->currentPage() }} / {{ $lists->lastPage() }}</span>
    @if ($lists->hasMorePages())
        <a href="{{ $lists->nextPageUrl() }}">다음</a>
    @else
        <span>다음</span>
    @endif
</div>


@endsection
