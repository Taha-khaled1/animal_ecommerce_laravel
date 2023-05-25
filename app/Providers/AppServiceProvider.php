<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {    
        $jsonTranslationsPath = resource_path('lang/' . App::getLocale() . '/messages.json');

        if (File::exists($jsonTranslationsPath)) {
            $translations = json_decode(File::get($jsonTranslationsPath), true);
            $this->app->singleton('translator', function ($app) use ($translations) {
                return new \Illuminate\Translation\Translator(
                    new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem(), resource_path('lang')),
                    $app['config']['app.locale']
                );
            });
            $this->app->make('translator')->addLines($translations, App::getLocale());
        }
        Schema::defaultStringLength(191);
        if (file_exists(storage_path('installed'))) {

            try {
                $language = Setting::where('slug', 'default_language')->first();
                if ($language) {
                    $locale = $language->value;

                    $lang = Language::where('locale', $locale)->first();
                    session(['APP_LOCALE' => $locale, 'lang_dir' => $lang->direction]);

                }
            } catch (\Exception $e) {
                //
            }

            $all_menus = Menu::where('is_static', INACTIVE)->with('submenus')->latest()->get();
            $allsettings = allsetting();
            view()->share(['all_menus' => $all_menus, 'allsettings' => $allsettings]);
        }
    }
}
