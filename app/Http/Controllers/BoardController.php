<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\File; // ← 이 부분 추가
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $boards = Board::orderBy('created_at', 'desc')->paginate(10);
        return view('boards.index')->with('lists', $boards);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $request->validate([
                'subject' => 'required',
                'contents' => 'required',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:2048',
            ]);
            // 세션에서 특정 키 값 가져오기
            $insertId = session('user'); // null 반환할 수도 있음
            $request['insert_id'] = $insertId;
            $board = Board::create($request->all());
            $boardId = $board->id;
            //2. 파일 저장 단일
            if ($request->hasFile('upload_file')) {
                $file = $request->file('upload_file');
                $path = $file->store('public/uploads');
                $newFile = new File();
                $newFile->table_id = $boardId;
                $newFile->table_name = 'board';
                $newFile->file_path = $path;
                $newFile->file_name = $file->getClientOriginalName();
                $newFile->file_name_origin = $file->getClientOriginalName();
                $newFile->file_ext = $file->getClientOriginalExtension();
                $newFile->file_size = $file->getSize();
                $newFile->user_id = $insertId;
                $result = $newFile->save();
                Log::info('save result: ' . ($result ? 'success' : 'fail'));
            }
            // 2. 파일 저장 (멀티)
            /*
            if ($request->hasFile('upload_file')) {
                Log::info('upload_file: ', ['files' => $request->file('upload_file')]);
                Log::info("file 시작");
                foreach ($request->file('upload_file') as $files) {
                    Log::info("포이치 시작");
                    Log::info("file = {$file}");
                    $path = $files->store('uploads');  // 저장 경로
                    Log::info("path = {$path}");
                    $file = new File();
                    $file->table_id = $boardId; // 참조 인덱스
                    $file->table_name = 'board'; // 참조 테이블
                    $file->file_path = $path; //경로
                    $file->file_name = $files->getClientOriginalName(); //파일 실제이름
                    $file->file_ext = $files->getClientOriginalExtension(); //파일 확장자
                    $file->file_size = $files->getSize(); //파일 사이즈
                    $file->user_id = $insertId; //등록자 아이디
                    $file->save();
                }
            }
            */
            DB::commit(); // 모두 성공하면 커밋
            return redirect()->route('boards.show', ['board' => $board -> id]);
        } catch (\Exception $e) {
            Log::info("실패 = {$e}");
            DB::rollback(); // 하나라도 실패하면 롤백
            return back()->withErrors(['msg' => '저장 중 오류 발생: ' . $e->getMessage()]);
        }

       
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {


        //$board = Board::where('id', $board->id)->first(); //기존 게시판 테이블만 불러오기

        $board->load('files'); // 관계 로딩
        return view('boards.show', compact('board'));
        //$board = Board::where('id', $board->id)->first();
        //return view('boards.show')->with('board', $board);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        $board->load('files'); // 관계 로딩
        return view('boards.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board)
    {


        try {
            Log::info('update스타트~!!!!');
            $request->validate([
                'id' => 'required'
            ]);
            Log::info('try스타트~!!!!');
            DB::beginTransaction();
            $request->validate([
                'subject' => 'required',
                'contents' => 'required',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:2048',
            ]);
            // 세션에서 특정 키 값 가져오기
            $insertId = session('user'); // null 반환할 수도 있음
            $request['insert_id'] = $insertId;
            $board->update($request->all());
            $boardId = $board->id;
            //2. 파일 저장 단일
            if ($request->hasFile('upload_file')) {
                $file = $request->file('upload_file');
                $path = $file->store('public/uploads');
                $newFile = new File();
                $newFile->table_id = $boardId;
                $newFile->table_name = 'board';
                $newFile->file_path = $path;
                $newFile->file_name = $file->getClientOriginalName();
                $newFile->file_name_origin = $file->getClientOriginalName();
                $newFile->file_ext = $file->getClientOriginalExtension();
                $newFile->file_size = $file->getSize();
                $newFile->user_id = $insertId;
                $result = $newFile->save();

                if($request['file_after_id'] != '') {
                        // 관련 파일들 삭제
                  $fileDel = $request->file('file_after_id');
                  $fileDel->deleteFile();
                }

                Log::info('save result: ' . ($result ? 'success' : 'fail'));
            }
            DB::commit(); // 모두 성공하면 커밋
            return redirect()->route('boards.show', ['board' =>  $request['id']]);
        } catch (\Exception $e) {
            Log::info("실패 = {$e}");
            DB::rollback(); // 하나라도 실패하면 롤백
            return back()->withErrors(['msg' => '저장 중 오류 발생: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
       
        $board->delete();

        return redirect()->route('boards.index');
    }
}
