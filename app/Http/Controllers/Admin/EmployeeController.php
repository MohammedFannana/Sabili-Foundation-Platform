<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('is-admin');
        $employees = User::where('role' , 'employee')->paginate(15);
        return view('pages.employees.index' ,compact('employees'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('is-admin');
        return view('pages.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('is-admin');
        $validated = $request->validate([
            'name' => ['required' , 'string'],
            'email' => ['required' , 'email' ,'unique:users,email,except,id'],
            'phone' => ['required' , 'string'],
            'image' => ['nullable', 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("images/employees/{$request->name}", 'public');
            $validated['image'] = $path;
        }

        User::create($validated);
        return redirect()->back()->with('success' , 'تم إضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('is-admin');

        $employee = User::findOrFail($id);
        return view('pages.employees.show' , compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('is-admin');
        $employee = User::findOrFail($id);
        return view('pages.employees.edit' ,compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('is-admin');
        $employee = User::findOrFail($id);
        $oldImage = $employee->image;
        $validated = $request->validate([
            'name' => ['sometimes' , 'string'],
            'email' =>  ['sometimes', 'email', Rule::unique('users', 'email')->ignore($id)],
            'phone' => ['sometimes' , 'string'],
            'image' => ['nullable', 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()]
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("images/employees/{$employee->name}", 'public');
            $validated['image'] = $path;
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $employee->update($validated);

        if (isset($validated['image']) && $oldImage && Storage::disk('public')->exists($oldImage)) {
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
        return redirect()->back()->with('success' , 'تم تحديث بيانات الموظف بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('is-admin');
        $employee = User::findOrFail($id);

        $imagePath = $employee->image;

        $employee->delete();

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        return redirect()->route('employee.index')->with('success' , 'تم حذف الموظف بنجاح');
    }
}
