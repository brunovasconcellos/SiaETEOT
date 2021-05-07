<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Schema::defaultStringLength(191);

        
        Gate::define("admin", function ($user) {

            if ($user->level == 11) {

                return true;

            }

            return false;

        });

        Gate::define("diretoria", function ($user) {

            if ($user->level == 10) {

                return true;

            }

            return false;

        });

        Gate::define("secretaria", function ($user) {

            if ($user->level == 9) {

                return true;

            }

            return false;

        });
        
        Gate::define("corpo_docente", function ($user) {

            if ($user->level == 8) {

                return true;

            }

            return false;

        });

        Gate::define("coordenacao", function ($user) {

            if ($user->level == 7) {

                return true;

            }

            return false;

        });

        Gate::define("supervisao", function ($user) {

            if ($user->level == 6) {

                return true;

            }

            return false;

        });

        Gate::define("inspetoria", function ($user) {

            if ($user->level == 5) {

                return true;

            }

            return false;

        });

        Gate::define("setor_pessoal", function ($user) {

            if ($user->level == 4) {

                return true;

            }

            return false;

        });

        Gate::define("orientacao_educacional", function ($user) {

            if ($user->level == 3) {

                return true;

            }

            return false;

        });

        Gate::define("responsavel", function ($user) {

            if ($user->level == 2) {

                return true;

            }

            return false;

        });

        Gate::define("aluno", function ($user) {

            if ($user->level == 1) {

                return true;

            }

            return false;

        });

    }
}
