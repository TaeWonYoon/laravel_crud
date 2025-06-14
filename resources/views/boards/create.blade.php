@extends('layouts.layout')

@section('content')

글쓰기 만들기 


<form action="{{ route('boards.store') }}" method="post">
    @csrf
    <table border="1">
        <tr>
            <th>제목</th>
            <td>
                <input type="text" name="subject" id="" />
            </td>
        </tr>
        <tr>
            <th>내용</th>
            <td>
                <textarea name="contents" id="" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit">저장</button>
            </td>
        </tr>
    </table>
</form>

@endsection