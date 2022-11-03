<?php

namespace LaravelLinear\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelLinear\Models\LinearToken;
use Laravel\Socialite\Facades\Socialite;

class LinearTokenController
{
    protected $config;
    protected $driver;

    /**
     * Redirects the user to the Linear authentication page.
     *
     */
    public function __construct()
    {
        $this->config = config('services.linear');
        $this->driver = Socialite::driver('linear');
    }

    /**
     * Get the redirect for the given Socialite provider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(Request $request)
    {
        session()->put('linear.previous_url', back()->getTargetUrl());

        return $this->driver->redirect();
    }

    /**
     * Attempt to log the user in via the provider user returned from Socialite.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $provider
     * @return mixed
     */
    public function handleProviderCallback(Request $request)
    {
        $socialite_user = $this->driver->user();

        $access_token = $socialite_user->token;
        $user_id = $socialite_user->user['id'];

        $expires_in = $socialite_user->expiresIn;
        $expires_at = Carbon::now()->addSeconds($expires_in);

        $teamId = null;
        $projectId = null;
        $organizationId = null;

        $linear_token = LinearToken::where([
            'access_token' => $access_token,
            'user_id' => $user_id
        ])->latest()->first();

        if ($linear_token) {
            $teamId = null;
            $projectId = null;
            $organizationId = null;
        } else {
            $linear_token = LinearToken::create([
                'access_type' => implode(",", $socialite_user->approvedScopes),
                'user_id' => $user_id,
                'organization_id' => $organizationId,
                'team_id' => $teamId,
                'project_id' => $projectId,
                'access_token' => $access_token,
                'token_type' => "Bearer",
                'expires_at' => $expires_at,
            ]);
        }

        if (!$linear_token) {
            return redirect()->back();
        }

        return redirect()->route('linear.config', ['linear_token' => $linear_token->id]);
    }
}
