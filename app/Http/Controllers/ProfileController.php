<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'employee' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $oldImage = $user->image; // 🔥 احفظ الصورة القديمة أولًا

        // تحديث الحقول من الـ request
        $user->fill($request->validated());

        // التحقق من رفع صورة جديدة
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("images/employees/{$user->name}", 'public');
            $user->image = $path; // تعيين المسار الجديد للصورة
        }

        $user->save(); // حفظ التعديلات

      
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            // حذف الصورة القديمة
            Storage::disk('public')->delete($oldImage);

            // استخراج مسار المجلد الذي يحتوي على الصورة
            $directory = dirname($oldImage); // يعطي مثلاً: images/employees/اسم_المستخدم

            // التحقق إن كان المجلد فارغًا
            $files = Storage::disk('public')->files($directory);
            if (empty($files)) {
                Storage::disk('public')->deleteDirectory($directory); // حذف المجلد
            }
        }
        return redirect()->back()->with('success' , 'تم تحديث البيانات  بنجاح');

    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
