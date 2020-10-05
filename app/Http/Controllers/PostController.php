<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //menampilkan seluruh data tabel post
    public function index()
    {
        $posts = Post::all();

        //mengembalikan seluruh data ke bentuk json
        return response()->json([
            'success' => true,
            'message' => 'List Semua Post',
            'data' => $posts
        ], 200);
    }

    //menyimpan data ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data' => $validator->errors()
            ], 501);
        }
        else{
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if($post){
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                    'data' => $post
                ], 201);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!'
                ], 400);
            }
        }
    }

    //menampilkan artikel berdasarkan ID
    public function show($id)
    {
        $post = Post::find($id);

        if($post){
            return \response()->json([
                'success' => true,
                'message' => 'Detail Post',
                'data' => $post
            ], 200);
        }
        else{
            return \response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan'
            ], 404);
        }
    }

    //update post
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return \response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data' => $validator->errors()
            ],401);
        }
        else{
            $post = Post::where('id', $id)->update([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            if($post){
                return \response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diupdate!',
                    'data' => $post
                ], 201);
            }else{
                return \response()->json([
                    'success' => false,
                    'message' => 'Post Gagal diupdate'
                ], 400);
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        if($post){
            return \response()->json([
                'success' => true,
                'message' => 'Post telah dihapus'
            ],200);
        }
    }
}
