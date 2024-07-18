<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AdminController extends Controller
{
  //[ページ遷移]投稿
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
    //
    //    //[更新]商品
    //    public function UpdateProduct(Request $request, $id)
    //    {
    //        // 商品を取得
    //        $product = Product::find($id);
    //
    //        // 画像の更新処理
    //        if ($request->hasFile('img')) {
    //            $fileName = $request->file('img')->getClientOriginalName();
    //            $newImgPath = 'public/img/' . $product->id;
    //
    //            // 以前の画像を削除
    //            Storage::disk('public')->deleteDirectory('img/' . $product->id);
    //
    //            // 新しいディレクトリを作成し、パーミッションを設定
    //            $directoryPath = storage_path('app/public/img/' . $product->id);
    //            if (!file_exists($directoryPath)) {
    //                mkdir($directoryPath, 0755, true);
    //                chmod($directoryPath, 0755);
    //            }
    //
    //            // 新しい画像を保存
    //            $request->file('img')->storeAs($newImgPath, $fileName);
    //            $product->img = 'storage/img/' . $product->id . '/' . $fileName;
    //        }
    //
    //        // 商品情報の更新
    //        $product->name = $request->name;
    //        $product->price = $request->price;
    //        $product->priority = $request->priority;
    //        $product->save();
    //
    //        // Quillデータの保存
    //        DB::beginTransaction();
    //        try {
    //            // Detailレコードを削除
    //            Detail::where("product_id", $id)->delete();
    //
    //            // 新しいQuillデータを保存
    //            $quillData = json_decode($request->quill_data, true);
    //            foreach ($quillData["ops"] as $value) {
    //                $detail = new Detail();
    //                $detail->product_id = $id;
    //                $detail->insert = $value["insert"];
    //                $detail->attributes = isset($value["attributes"]) ? json_encode($value["attributes"]) : null;
    //                $detail->save();
    //            }
    //
    //            DB::commit();
    //            return response()->json([
    //                'message' => '商品が正常に更新されました',
    //                'redirect' => route('ShowProduct')
    //            ], 200);
    //        } catch (\Exception $e) {
    //            DB::rollback();
    //            return response()->json([
    //                'message' => '商品更新に失敗しました',
    //                'error' => $e->getMessage()
    //            ], 500);
    //        }
    //    }
    //
    //    //[削除]商品
    //    public function DeleteProduct(Request $request)
    //    {
    //        try {
    //            // 商品テーブルから指定のIDのレコード1件を取得
    //            $product = Product::find($request->id);
    //
    //            if (!$product) {
    //                return response()->json([
    //                    'message' => '削除対象の商品が見つかりませんでした',
    //                ], 404);
    //            }
    //
    //            // ディレクトリを削除
    //            $directoryPath = 'img/' . $product->id;
    //            if (Storage::disk('public')->exists($directoryPath)) {
    //                Storage::disk('public')->deleteDirectory($directoryPath);
    //            }
    //
    //            // レコードを削除
    //            $product->delete();
    //
    //            // JSONレスポンスを返す
    //            return response()->json([
    //                'message' => '商品が正常に削除されました',
    //                'redirect' => route('ShowProduct')
    //            ]);
    //        } catch (\Exception $e) {
    //            return response()->json([
    //                'message' => '商品の削除に失敗しました',
    //                'error' => $e->getMessage()
    //            ], 500);
    //        }
    //    }
    //
    //    //[表示設定]商品
    //    public function ToggleProduct(Request $request)
    //    {
    //        try {
    //            // 商品テーブルから指定のIDのレコード1件を取得
    //            $product = Product::find($request->id);
    //
    //            if (!$product) {
    //                return response()->json(['message' => '対象商品が見つかりませんでした'], 404);
    //            }
    //
    //            // レコードを更新
    //            $product->is_enabled = $request->is_enabled;
    //            $product->save();
    //
    //            // JSONレスポンスを返す
    //            return response()->json([
    //                'message' => '表示設定の変更が完了しました',
    //                'redirect' => route('ShowProduct')
    //            ]);
    //        } catch (\Exception $e) {
    //            // エラーが発生した場合の処理
    //            return response()->json([
    //                'message' => '表示設定の変更に失敗しました',
    //                'error' => $e->getMessage()
    //            ], 500);
    //        }
    //    }
}
