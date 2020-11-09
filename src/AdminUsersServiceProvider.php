<?php

namespace TallModSassy\AdminUsers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

require_once(__DIR__."/../routes/web.php"); // MaybeToDo

class AdminUsersServiceProvider extends ServiceProvider
{
    public static string $blade_prefix = "tassy"; #tassy is a template term

    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tassy');


        Route::macro(
            'tassy',
            function (string $prefix) {
                Route::prefix($prefix)->group(
                    function () {
                        // Prefix Route Samples -BEGIN-
                        // Sample routes that only show while developing...
                        //                        if (App::environment(['local', 'testing'])) {
                        //                            // prefixed url to string
                        //                            Route::get(
                        //                                '/TallAndSassy/AppThemeBaseAdminUsers/sample_string',
                        //                                // you will absolutely need a prefix in your url
                        //                                function () {
                        //                                    return "Hello AppThemeBaseAdminUsers string via blade prefix";
                        //                                }
                        //                            );
                        //
                        //                            // prefixed url to blade view
                        //                            Route::get(
                        //                                '/TallAndSassy/AppThemeBaseAdminUsers/sample_blade',
                        //                                function () {
                        //                                    return view('tassy::sample_blade');
                        //                                }
                        //                            );
                        //
                        //                            // prefixed url to controller
                        //                            Route::get(
                        //                                '/TallAndSassy/AppThemeBaseAdminUsers/controller',
                        //                                [AppThemeBaseAdminUsersController::class, 'sample']
                        //                            );
                        //                        }
                        //                        // Prefix Route Samples -END-

                        // TODO: Add your own prefixed routes here...
                    }
                );
            }
        );

        Route::tassy('tassy');

        // TODO: Register your livewire components that live in this package here:
        \Livewire\Livewire::component('tassy::users-table',  \TallModSassy\AdminUsers\Http\Livewire\UsersTable::class);
        \Livewire\Livewire::component('tassy::logins-table',  \TallModSassy\AdminUsers\Http\Livewire\LoginsTable::class);
        \Livewire\Livewire::component('tassy::user-value-with-shallow-modal',  \TallModSassy\AdminUsers\Http\Livewire\UserValueWithShallowModal::class);
        // TODO: Add your own other boot related stuff here...


        \TallAndSassy\PageGuide\MenuTree::singleton('upper')->pushTop(
            'admin.people',
            'People',
            null,
            'heroicon-o-user-group',
            null
        )
        ->pushLink('admin.people.users', 'Users','/admin/people/users');

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/app-theme-base-admin-users.php', 'app-theme-base-admin-users');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
