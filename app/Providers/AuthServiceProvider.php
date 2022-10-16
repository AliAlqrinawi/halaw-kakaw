<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // master user Big Admin
        Gate::before(function ($user , $permissions){
            if($user->id == 1){
                return true;
            }
        });
        // admin functions
        foreach( config('permission') as $permissions => $lable )
        {
            Gate::define($permissions , function($user) use($permissions){
                    return $user->permissions($permissions);
            });
        }
    }
}
