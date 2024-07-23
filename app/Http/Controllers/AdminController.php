<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Category;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //---投稿---

    //[SHOW]投稿
    public function ShowPostPage()
    {

        // ロール作成
        $adminRole = Role::create(['name' => 'admin']);

        // 権限作成
        $editAllUserPermission = Permission::create(['name' => 'edit all user']);

        // member役割にregister権限を付与
        $adminRole->givePermissionTo($editAllUserPermission);

        $user = User::find(1);
        // $userにadminを割り当て
        $user->assignRole($adminRole);

        $posts = Post::where('is_enabled', 1)->with('categories')->get();
        $hiddenPosts = Post::where('is_enabled', 0)->get();
        $categories = Category::all(); // 全てのカテゴリを取得
        return view("dash-post",compact("posts","hiddenPosts","categories"));
    }

    //[ADD]投稿
    public function AddPost(Request $request)
    {
        // トランザクションの開始
        DB::beginTransaction();

        try {
            // アップロードされたファイル名を取得
            $imgFileName = $request->file('img')->getClientOriginalName();
            $pdfFileName = $request->file('pdf')->getClientOriginalName();
            $videoFileName = $request->file('video')->getClientOriginalName();

            // 商品情報の保存
            $post = new Post();
            $post->name = $request->name;
            $post->img = 'storage/img/' .  $imgFileName;
            $post->category = $request->category;
            $post->is_enabled = 1;
            $post->save();

            // 画像を保存するディレクトリのパスを生成
            $imgDirectoryPath = storage_path('app/public/img/' . $post->id);

            // ディレクトリが存在しない場合は作成し、パーミッションを設定
            if (!file_exists($imgDirectoryPath)) {
                mkdir($imgDirectoryPath, 0755, true);
                chmod($imgDirectoryPath, 0755);
            }

            // storageに画像ファイル保存
            $request->file('img')->storeAs('public/img/' . $post->id,  $imgFileName);

            // 画像パスを更新
            $post->img = 'storage/img/' . $post->id . '/' .  $imgFileName;

            //---------
            $pdfDirectoryPath = storage_path('app/public/pdf/' . $post->id);

            if (!file_exists($pdfDirectoryPath)) {
                mkdir($pdfDirectoryPath, 0755, true);
                chmod($pdfDirectoryPath, 0755);
            }

            $request->file('pdf')->storeAs('public/pdf/' . $post->id, $pdfFileName);

            $post->pdf = 'storage/pdf/' . $post->id . '/' . $pdfFileName;

            //---------
            $videoDirectoryPath = storage_path('app/public/video/' . $post->id);

            if (!file_exists($videoDirectoryPath)) {
                mkdir($videoDirectoryPath, 0755, true);
                chmod($videoDirectoryPath, 0755);
            }

            $request->file('video')->storeAs('public/video/' . $post->id, $videoFileName);

            $post->video = 'storage/video/' . $post->id . '/' . $videoFileName;
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

            // PDFの更新処理
            if ($request->hasFile('pdf')) {
                $fileName = $request->file('pdf')->getClientOriginalName();
                $newPdfPath = 'public/pdf/' . $post->id;

                Storage::disk('public')->deleteDirectory('pdf/' . $post->id);

                $directoryPath = storage_path('app/public/pdf/' . $post->id);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                    chmod($directoryPath, 0755);
                }

                $request->file('pdf')->storeAs($newPdfPath, $fileName);
                $post->pdf = 'storage/pdf/' . $post->id . '/' . $fileName;
            }

            // Videoの更新処理
            if ($request->hasFile('video')) {
                $fileName = $request->file('video')->getClientOriginalName();
                $newVideoPath = 'public/video/' . $post->id;

                Storage::disk('public')->deleteDirectory('video/' . $post->id);

                $directoryPath = storage_path('app/public/video/' . $post->id);
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                    chmod($directoryPath, 0755);
                }

                $request->file('video')->storeAs($newVideoPath, $fileName);
                $post->video = 'storage/video/' . $post->id . '/' . $fileName;
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

    //---カテゴリー---

    //[SHOW]カテゴリー
    public function ShowCategoryPage()
    {
        $categories = Category::all();
        return view("dash-category",compact("categories"));
    }

    //[ADD]カテゴリー
    public function AddCategory(Request $request)
    {
        // トランザクションの開始
        DB::beginTransaction();

        try {

            //カテゴリー情報の保存
            $category = new Category();
            $category->category_name = $request->category;
            $category->save();

            // トランザクションのコミット
            DB::commit();

            // 成功レスポンスを返す
            return response()->json([
                'message' => 'カテゴリーが正常に追加されました',
                'redirect' => route('ShowCategoryPage')
            ], 200);
        } catch (\Exception $e) {
            // トランザクションのロールバック
            DB::rollback();

            // エラーレスポンスを返す
            return response()->json([
                'message' => 'カテゴリー追加に失敗しました',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //[DELETE]カテゴリー
    public function DeleteCategory(Request $request)
    {
        try {
            // 商品テーブルから指定のIDのレコード1件を取得
            $category = Category::find($request->id);

            if (!$category) {
                return response()->json([
                    'message' => '削除対象のカテゴリーが見つかりませんでした',
                ], 404);
            }

            // レコードを削除
            $category->delete();

            // JSONレスポンスを返す
            return response()->json([
                'message' => 'カテゴリーが正常に削除されました',
                'redirect' => route('ShowCategoryPage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'カテゴリーの削除に失敗しました',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //---メンバー---
    public function ShowMemberPage()
    {
        $users = User::where('id', '!=', 1)->get();
        return view("dash-member",compact("users"));
    }
}
