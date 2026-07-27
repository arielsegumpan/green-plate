<?php


namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as BaseLogin;
// use Filament\Http\Responses\Auth\LoginResponse;

class LoginResponse implements BaseLogin
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */

    public function toResponse($request): RedirectResponse | Redirector
    {
        return redirect()->to(Auth::user()->usersPanel());
    }
}
