<?php

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProfileViewController extends Controller
{
    public function __invoke(): View
    {
        try {
            
            return view('user.profile');    

        } catch (profileViewException $e) {
            abort(
                $e->getCode(),
                $e->getMessage()
            );
        } catch (\Throwable $e) {
            abort(
                500, 
                'An unexpected error occurred.',
                $e->getMessage()
                );
        }
    }
}
