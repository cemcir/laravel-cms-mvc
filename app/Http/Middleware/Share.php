<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Pages;

class Share
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data['settings']=Settings::all();
        
        foreach($data['settings'] as $key) {
            $settings[$key->settings_key]=$key->settings_value;
        }

        $page=Pages::all()->sortBy('page_must')->first();
        $settings['slug']=$page['page_slug'];
        View::share($settings);

        //dd($settings);
        return $next($request);
    }
}
