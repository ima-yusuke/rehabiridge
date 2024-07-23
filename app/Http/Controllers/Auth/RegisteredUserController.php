<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role; // 追加
use Spatie\Permission\Models\Permission; // 追加
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 'member' ロールが存在するか確認、存在しない場合は作成
        $memberRole = Role::firstOrCreate(['name' => 'member']);

        // 'read' 権限が存在するか確認、存在しない場合は作成
        $readPermission = Permission::firstOrCreate(['name' => 'read']);

        // 'member' ロールに 'read' 権限を付与
        if (!$memberRole->hasPermissionTo($readPermission)) {
            $memberRole->givePermissionTo($readPermission);
        }

        // ユーザーに 'member' ロールを割り当て
        $user->assignRole($memberRole);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
