@extends('layouts.layout')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-center">📚 PHP & Laravel 학습 자료</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">1. 라라벨 기본 라우팅</h5>
                    <p class="card-text flex-grow-1">
                        웹 라우트 설정과 컨트롤러 연결 방법에 대해 공부합니다.
                    </p>
                    <a href="https://laravel.com/docs/10.x/routing" target="_blank" class="btn btn-primary mt-auto">공식 문서 보기</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">2. Eloquent ORM</h5>
                    <p class="card-text flex-grow-1">
                        데이터베이스 쿼리, 모델 생성 및 관계 설정에 대해 익힙니다.
                    </p>
                    <a href="https://laravel.com/docs/10.x/eloquent" target="_blank" class="btn btn-primary mt-auto">공식 문서 보기</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">3. 뷰 컴포넌트와 블레이드 템플릿</h5>
                    <p class="card-text flex-grow-1">
                        블레이드 문법과 재사용 가능한 컴포넌트 만드는 법을 배웁니다.
                    </p>
                    <a href="https://laravel.com/docs/10.x/blade" target="_blank" class="btn btn-primary mt-auto">공식 문서 보기</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-success">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-success">1. PHP 배열 다루기</h5>
                    <p class="card-text flex-grow-1">PHP 배열 생성, 조작, 반복문 처리 등 기본 배열 사용법을 배웁니다.</p>
                    <a href="https://www.php.net/manual/en/language.types.array.php" target="_blank" class="btn btn-outline-success mt-auto">공식 문서 보기</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-success">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-success">2. 객체지향 프로그래밍</h5>
                    <p class="card-text flex-grow-1">PHP에서 클래스, 객체, 상속, 인터페이스 등을 이해하고 활용하는 방법.</p>
                    <a href="https://www.php.net/manual/en/language.oop5.php" target="_blank" class="btn btn-outline-success mt-auto">공식 문서 보기</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-success">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-success">3. 예외 처리</h5>
                    <p class="card-text flex-grow-1">PHP 예외 처리 기본과 try-catch 문법, 사용자 정의 예외 만드는 법을 학습합니다.</p>
                    <a href="https://www.php.net/manual/en/language.exceptions.php" target="_blank" class="btn btn-outline-success mt-auto">공식 문서 보기</a>
                </div>
            </div>
        </div> 
    </div>
@endsection('content')