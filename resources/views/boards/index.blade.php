@extends('layouts.layout')

@section('content')
여기 게시판을 만들겁니다.


<a href="/boards/create">글 쓰기</a> 

<a href="{{ route('boards.create') }}">글 쓰기</a>    

<table border="1">
    <tr>
        <th>No</th>
        <th>제목</th>
        <th>작성일</th>
        <th>관리</th>
    </tr>
    @foreach($lists as $ls)
    <tr>
        <th>{{ $ls -> id }}</th>
        <th>{{ $ls -> subject }}</th>
        <th>{{ $ls -> created_dt }}</th>
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
    </tr>
    @endforeach



</table>
@endsection
