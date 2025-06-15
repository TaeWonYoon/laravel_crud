<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        try {
        // 실제 파일 삭제
        if (Storage::exists($file->file_path)) {
            Storage::delete($file->file_path);
        }

        // DB 레코드 삭제
        $file->delete();

        return response()->json(['message' => '파일 삭제 완료'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => '삭제 실패', 'error' => $e->getMessage()], 500);
    }
    }
}
