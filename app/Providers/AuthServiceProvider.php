<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

        // \App\Models\BlogPost::class=>\App\Policies\BlogPostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        Gate::define('update-post', 'App\Policies\BlogPostPolicy@update');
        Gate::define('create-post', 'App\Policies\BlogPostPolicy@create');
        Gate::define('delete-post', 'App\Policies\BlogPostPolicy@delete');
        Gate::define('delete-comment', 'App\Policies\PostCommentPolicy@delete');

        //
    }
}
