<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
// use Filament\Http\Responses\Auth\Contracts\LogoutResponse ;

class LogoutResponse implements LogoutResponseContract
{

    public function toResponse($request): RedirectResponse
    {
        return redirect()->to(route('home.page'));
    }
}
