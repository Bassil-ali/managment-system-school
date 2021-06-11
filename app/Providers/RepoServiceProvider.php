<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository',
        );

        $this->app->bind(
            'App\Repository\StudentRepositoryInterface',
            'App\Repository\StudentRepository'
        );

        $this->app->bind(
            'App\Repository\StudentPromotionRepositoryInterface',
            'App\Repository\StudentPromotionRepository');

            $this->app->bind(
                'App\Repository\StudentGraduatedRepositoryInterface',
                'App\Repository\StudentGraduatedRepository');

            $this->app->bind(    
            'App\Repository\FeesRepositoryInterface',
            'App\Repository\FeesRepository');

           $this->app->bind(
            'App\Repository\FeeInvoicesRepositoryInterface',
            'App\Repository\FeeInvoicesRepository');
     
    }


      
    

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
