<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Form::macro("assets", function($section)
{
    $markup = "";
    $assets = Config::get("asset");
	
    if (isset($assets[$section]))
    {
        foreach ($assets[$section] as $key => $value)
        {
            $use = $value;
            if (is_string($key))
            {
                $use = $key;
            }
            if (ends_with($use, ".css"))
            {
                $markup .= "<link
                    rel='stylesheet'
                    type='text/css'
                    href='" . asset($use) . "'
                />";
            }
            if (ends_with($use, ".js"))
            {
                $markup .= "<script
                    type='text/javascript'
                    src='" . asset($use) . "'
                ></script>";
            }
        }
    }
    return $markup;
});

Route::get('/', function()
{
	return View::make('hello');
});

// A nice simple route to show a pokemons name if we can find it using our Service
Route::any('/pokemon/{pokemon}', function($pokemon) {
    return Pokemon::getPokemon($pokemon);
});

Route::any('start', function() {
   dd(App::getConfig());
});
