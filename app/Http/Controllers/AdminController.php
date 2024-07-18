<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AdminController extends Controller
{
    //[SHOW]投稿
    public function ShowPostPage()
    {
        $posts = Post::where('is_enabled', 1)->get();;
        $hiddenPosts = Post::where('is_enabled', 0)->get();
        //$links = Link::all();
        return view("dash-post",compact("posts","hiddenPosts"));
    }

    //[ADD]投稿
    public function AddPost(Request $request)
    {
        // トランザクションの開始
        DB::beginTransaction();

        try {
            // アップロードされたファイル名を取得
            $fileName = $request->file('img')->getClientOriginalName();

            // 商品情報の保存
            $post = new Post();
            $post->name = $request->name;
            $post->img = 'storage/img/' . $fileName;
            $post->category = $request->category;
            $post->is_enabled = 1;
            $post->save();

            // 画像を保存するディレクトリのパスを生成
            $directoryPath = storage_path('app/public/img/' . $post->id);

            // ディレクトリが存在しない場合は作成し、パーミッションを設定
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
                chmod($directoryPath, 0755);
            }

            // storageに画像ファイル保存
            $request->file('img')->storeAs('public/img/' . $post->id, $fileName);

            // 画像パスを更新
            $post->img = 'storage/img/' . $post->id . '/' . $fileName;
            $post->save();

            // トランザクションのコミット
            DB::commit();

            // 成功レスポンスを返す
            return response()->json([
                'message' => '投稿が正常に追加されました',
                'redirect' => route('ShowPostPage')
            ], 200);
        } catch (\Exception $e) {
            // トランザクションのロールバック
            DB::rollback();

            // エラーレスポンスを返す
            return response()->json([
                'message' => '投稿追加に失敗しました',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //[UPDATE]投稿
    public function UpdatePost(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $post = Post::find($id);

            // 画像の更新処理
            if ($request->hasFile('img')) {
                $fileName = $request->file('img')->getClientOriginalName();
                $newImgPath = 'public/img/' . $post->id;

                // 以前の画像を削除
                Storage::disk('public')->deleteDirectory('img/' . $post->id);

                // 新しいディレクトリを作成し、パーミッションを設定
                $directoryPath = storage_path('app/public/img/' . $post->id);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                    chmod($directoryPath, 0755);
                }

                // 新しい画像を保存
                $request->file('img')->storeAs($newImgPath, $fileName);
                $post->img = 'storage/img/' . $post->id . '/' . $fileName;
            }

            $post->name = $request->name;
            $post->category = $request->category;
            $post->save();

            DB::commit();
            return response()->json([
                'message' => '投稿が正常に更新されました',
                'redirect' => route('ShowPostPage')
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => '投稿更新に失敗しました',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //[DELETE]投稿
    public function DeletePost(Request $request)
    {
        try {
            // 商品テーブルから指定のIDのレコード1件を取得
            $post = Post::find($request->id);

            if (!$post) {
                return response()->json([
                    'message' => '削除対象の投稿が見つかりませんでした',
                ], 404);
            }

            // ディレクトリを削除
            $directoryPath = 'img/' . $post->id;
            if (Storage::disk('public')->exists($directoryPath)) {
                Storage::disk('public')->deleteDirectory($directoryPath);
            }

            // レコードを削除
            $post->delete();

            // JSONレスポンスを返す
            return response()->json([
                'message' => '投稿が正常に削除されました',
                'redirect' => route('ShowPostPage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '投稿の削除に失敗しました',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //[TOGGLE]投稿
    public function TogglePost(Request $request)
    {
        try {
            $post = Post::find($request->id);

            if (!$post) {
                return response()->json(['message' => '対象投稿が見つかりませんでした'], 404);
            }

            // レコードを更新
            $post->is_enabled = $request->is_enabled;
            $post->save();

            // JSONレスポンスを返す
            return response()->json([
                'message' => '表示設定の変更が完了しました',
                'redirect' => route('ShowPostPage')
            ]);
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            return response()->json([
                'message' => '表示設定の変更に失敗しました',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
