<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;

class UserUtil
{
    const CODE_DAKAR = "01";
    const NOCODE = "9999";

    public function getCodeCollectivite()
    {
        $user = Auth::user();
        if (!$user->estNiveauNational())
            return $user->departement->code ?? $user->region->code ?? self::NOCODE;
        return self::CODE_DAKAR;
    }

}