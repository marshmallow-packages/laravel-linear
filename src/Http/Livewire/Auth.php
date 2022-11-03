<?php

namespace LaravelLinear\Http\Livewire;

use Illuminate\Support\Facades\Auth as AuthFacade;
use Laravel\Socialite\Facades\Socialite;
use LaravelLinear\Models\LinearToken;
use LaravelLinear\Providers\SocialiteProvider;
use Livewire\Component;

class Auth extends Component
{
    public LinearToken $linear_token;

    public bool $has_token = false;

    public bool $expired = false;

    private SocialiteProvider $driver;

    protected $listeners = [
        'token.updated' => '$refresh',
    ];

    public function hydrate()
    {
        $this->driver = Socialite::driver('linear');
    }

    public function getLinearData()
    {
        $linear_token = LinearToken::where([
            'user_id' => $this->user->id,
        ])->latest()->first();

        $this->has_token = false;
        $this->expired = false;

        if ($linear_token) {
            $this->linear_token = $linear_token;
            $this->has_token = true;
        }

        if ($linear_token && $linear_token->expires_at < now()) {
            $this->expired = true;
        }
    }

    public function render()
    {
        $this->getLinearData();

        return view('linear::livewire.auth')->layout('linear::layout');
    }

    public function revokeToken()
    {
        if ($this->linear_token) {
            $status = $this->driver->revokeAccessToken($this->linear_token->access_token);
        } else {
            $status = false;
        }

        if ($status) {
            session()->flash('linear_success', 'Linear connection successfully removed');
            $this->has_token = false;
        } else {
            session()->flash('linear_error', 'Whoops.. something went wrong.');
        }

        session()->flash('linear_flash', true);
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return AuthFacade::user();
    }
}
