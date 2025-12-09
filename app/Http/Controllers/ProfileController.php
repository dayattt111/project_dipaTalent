<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update IPK mahasiswa (menunggu validasi admin)
     */
    public function updateIpk(Request $request): RedirectResponse
    {
        $request->validate([
            'ipk' => 'required|numeric|min:0|max:4',
        ]);

        $user = $request->user();

        // Update IPK dan reset status ke pending
        $user->update([
            'ipk' => $request->ipk,
            'ipk_status' => 'pending',
            'ipk_verified_at' => null,
            'ipk_catatan_admin' => null,
        ]);

        return Redirect::route('profile.edit')->with('success', 'IPK berhasil diperbarui dan menunggu validasi admin.');
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
