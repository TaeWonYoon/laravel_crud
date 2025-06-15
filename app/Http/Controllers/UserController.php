<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            'password' => 'required',
            'gender' => 'required',
        ]);
        $request['level'] = 1;

        User::create($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function checkUserId(Request $request)
    {
        $userId = $request->input('user_id');
        Log::info("🔍 checkUserId 호출됨: user_id = {$userId}");

        $exists = User::where('user_id', $userId)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function login(Request $request) {

        $request->validate([
            'user_id' => 'required',
            'password' => 'required'
        ]);
;
        // 로그인 시도
        if (Auth::attempt(['user_id' => $request->user_id, 'password' => $request->password])) {
            //인증 성공 → 세션에 사용자 정보 저장
            $request->session()->regenerate(); // 세션 보안 토큰 재발급

            $user = User::where('user_id', $request->user_id)->first();

            Log::info($user);
            //세션에 원하는 정보 저장
            $request->session()->put('user', $user->user_id);
            $request->session()->put('name', $user->name);

            //리다이렉트
            return redirect('/')->with('status', '로그인 성공!');
        }
        // 5. 실패 시
        return back()->withErrors([
            'user_id' => '입력하신 정보가 올바르지 않습니다.',
        ])->onlyInput('user_id');
    }

    public function logout(Request $request) {
        Auth::logout(); // 로그아웃 처리

        $request->session()->invalidate(); // 세션 무효화 (보안)
        return redirect('/')->with('status', '');
    }
}
