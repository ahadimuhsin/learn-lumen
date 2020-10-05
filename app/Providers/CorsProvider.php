<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class CorsProvider extends ServiceProvider{
    /*
     * JIka requestnya berbentuk OPTIONS
     * daftarkan route tersebut
     */
    public function register()
    {
        $request = app('request');

        if($request->isMethod('OPTIONS'))
        {
            app()->options($request->path(), function (){
                return response('', 200);
            });
        }
    }
}
?>
