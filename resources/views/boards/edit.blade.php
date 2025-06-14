@extends('layouts.layout')

@section('content')

<a href="{{ route('boards.index') }}">목록</a>


<form action="{{ route('boards.update', $board->id) }}" method="post">
<table border="1">
    @csrf
    @method('PUT')
    <tr>
        <th>제목</th>
        <td><input type="text" name="subject" value="{{ $board -> subject }}"></td>
    </tr>
    <tr>
        <th>내용</th>
        <td>
            <textarea name="contents" rows="5" id="">{{ $board ->contents }}</textarea>
        </td>
    </tr>
    <tr >
        <td colspan="2">
            <button type="submit">전송</button>
        </td>
    </tr>
</table>
</form>
@endsection