<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        $search = $request->input('search');   // '01', '10', or null
        $keyword = $request->input('keyword');
        $view_ty = $request->input('search_view_ty');   // 'Y'(탈퇴), 'N'(정상), 'A'(전체) 

        if($view_ty == "N") {
            $query->where('delete_at', 'N');
        } else if($view_ty == "Y") {
            $query->where('delete_at', 'Y');
        }
        
        $search_level = $request->input('search_level');   // '01', '10', or null

        if($search_level == "1" || $search_level == "9") { //사용자, 관리자
            $query->where('level', $search_level);
        }

        // 제목 검색
        if ($search == "01") { //이름
            $query->where('name', 'like', '%' . $keyword . '%');
        } else if ($search == "10") { //아이디
            $query->where('user_id', 'like', '%' . $keyword . '%');
        } else if ($search == "11") { //가입일
            $dateKeyword = str_replace('-', '', $keyword);

            if (preg_match('/^\d{8}$/', $dateKeyword)) { //형식이 정확할때
                $keyword = substr($dateKeyword, 0, 4) . '-' . substr($dateKeyword, 4, 2) . '-' . substr($dateKeyword, 6, 2);  //
            } else { //형식이 안맞으면 공백처리
                $keyword = '';
            }
            $request['keyword'] = $keyword;
            $query->whereDate('created_at',$keyword);
        } else { //전체
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
                $q->orwhere('user_id', 'like', '%' . $keyword . '%');
            });
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->appends(request()->query());  
        return view('admins.index')->with(['lists' => $users, 'request' => $request] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        $user = User::where('id', $admin->id)->first();
        Log::info("admin = ". $user );
        return view('admins.edit', compact('user'));
    }

    /**
     * 회원 복구 기능
     */
    public function update(Request $request,User $admin)
    {
        $admin->update($request->all());

        return redirect()->route('admins.index')->with('alert', '회원정보가 수정되었습니다.');
    }

    /**
     * 회원 탈퇴 기능
     */
    public function destroy(User $admin)
    {
        $admin = User::findOrFail($admin->id);
        $admin->delete_at = 'Y';
        $admin->save();
    }

     /**
     * 회원 상태 변경(정상, 탈퇴)
     */
    public function attrChange($id) {
        $user = User::findOrFail($id);
        $user->delete_at = 'N'; // 복구
        $user->save();
        return response()->json(['message' => '회원 복구 완료']);
    }

    public function resetPassword($id) {
        $user = User::findOrFail($id);
        $user->password = bcrypt('1234567'); // 원하는 초기화 비밀번호
        $user->save();

        return response()->json(['message' => '비밀번호가 초기화되었습니다.']);
    }
}
