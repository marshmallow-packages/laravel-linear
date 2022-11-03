<?php

namespace LaravelLinear\Http\Livewire;

use Illuminate\Support\Facades\Auth as AuthFacade;
use Laravel\Socialite\Facades\Socialite;
use LaravelLinear\Models\LinearToken;
use LaravelLinear\Providers\SocialiteProvider;
use Livewire\Component;

class Config extends Component
{
    public LinearToken $linear_token;

    private SocialiteProvider $driver;

    public $linear_data;

    public $organization_options;

    public $team_options;

    public $project_options;

    public $organization;

    public $team;

    public $project;

    protected $listeners = [
        'token.updated' => '$refresh',
    ];

    public function render()
    {
        if ($this->organization) {
            $teams = $this->linear_data[$this->organization]['teams'];
            $this->team_options = collect($teams)->pluck('name', 'id')->toArray();

            if (collect($teams)->count() == 1) {
                $team = array_first(collect($teams));
                $this->team = $team['id'];
            }
        }

        if ($this->organization && $this->team) {
            $this->project_options = $teams[$this->team]['projects'];
        }

        return view('linear::livewire.config')->layout('linear::layout');
    }

    public function mount(LinearToken $linear_token)
    {
        if ($this->user->id !== $linear_token->user_id) {
            abort(403);
        }

        $this->linear_token = $linear_token;

        $this->driver = Socialite::driver('linear');

        $this->getLinearData();

        $this->organization = $this->linear_token->organization_id;
        $this->team = $this->linear_token->team_id;
        $this->project = $this->linear_token->project_id;
    }

    public function saveData()
    {
        $this->linear_token->update([
            'organization_id' => $this->organization,
            'team_id' => $this->team,
            'project_id' => $this->project,
        ]);

        if ($this->linear_token->save()) {
            session()->flash('linear_success', 'Linear connection successfully configured');
        } else {
            session()->flash('linear_error', 'Whoops.. something went wrong.');
        }

        session()->flash('linear_flash', true);
    }

    protected function getLinearData()
    {
        $organiation_data = $this->driver->getOrganizationData($this->linear_token->access_token);

        if (! $organiation_data || empty($organiation_data)) {
            return;
        }

        $this->linear_data = collect($organiation_data)->mapWithKeys(function ($organization) {
            $teams = collect($organization['teams']['nodes'])->mapWithKeys(function ($team) {
                $projects = collect($team['projects']['nodes'])->mapWithKeys(function ($project) {
                    return [$project['id'] => $project['name']];
                });
                $team['projects'] = $projects;

                return [$team['id'] => $team];
            });
            $organization['teams'] = $teams;

            return [$organization['id'] => $organization];
        });

        $this->organization_options = $this->linear_data->mapWithKeys(function ($organization) {
            return [$organization['id'] => $organization['name']];
        });

        if ($this->linear_data->count() == 1) {
            $organization = collect($this->linear_data->first());
            $this->organization = $organization->get('id');
        }
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
