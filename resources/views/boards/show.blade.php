@extends('layouts.layout')

@section('content')

<a href="{{ route('boards.index') }}">목록</a>

<table border="1">

    <tr>
        <th>제목</th>
        <td>{{ $board ->subject }}</td>
    </tr>
    <tr>
        <th>내용</th>
        <td>{{ $board ->contents }}</td>
    </tr>
</table>
@endsection