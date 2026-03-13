<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();

        if (($validated['email'] ?? $user->email) !== $user->email) {
            $validated['email_verified_at'] = null;
        }

        if ($request->filled('avatar')) {
            $disk = config('filesystems.default_public_disk');
            $tempPath = $request->string('avatar')->toString();

            if (! Str::startsWith($tempPath, 'tmp/')) {
                throw ValidationException::withMessages([
                    'avatar' => 'Avatar upload is invalid.',
                ]);
            }

            if (! empty($user->avatar)) {
                Storage::disk($disk)->delete($user->avatar);
            }

            $newFileName = Str::after($tempPath, 'tmp/');
            Storage::disk($disk)->move($tempPath, "img/$newFileName");

            $validated['avatar'] = "img/$newFileName";
        }

        $user->update($validated);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:10240'],
        ]);

        $path = null;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('tmp', config('filesystems.default_public_disk'));
        }

        return $path;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
