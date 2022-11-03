<div>

    <p class="mb-2 font-sans font-semibold leading-6 text-md">
        {{ __('Configure Linear') }}
    </p>

    <p class="font-sans text-base font-medium leading-6">
        {{ __('Select which organization, team & project you want to connect.') }}
    </p>


    <p class="pb-2 font-sans text-sm font-normal leading-6">
        {{ __('Once you do, you can quickly create issues from your Laravel application.') }}
    </p>

    <div class="pb-2 space-y-2">
        <x-mm-select :options="$organization_options" name="organization" id="organization" required :defer="false" :disabled="count($organization_options) == 1"
            placeholder="{{ __('Organization') }}" />

        @if ($organization && $team_options)
            <x-mm-select :options="$team_options" name="team" id="team" required :defer="false" :disabled="count($team_options) == 1"
                placeholder="{{ __('Team') }}" />
        @endif

        @if ($organization && $team)
            <x-mm-select :options="$project_options" name="project" id="project" required :defer="false"
                placeholder="{{ __('Project') }}" />
        @endif
    </div>


    {{-- <x-mm-divider /> --}}

    @if (session()->has('linear_flash'))
        <div @class([
            'border-green-400/50 bg-green-400/20 ' => session()->has('linear_success'),
            'border-red-400/50 bg-red-400/20 ' => session()->has('linear_error'),
            'px-4 my-2 py-2 text-sm font-semibold leading-6 text-center border rounded-md',
        ])>
            <p class="font-sans font-semibold leading-6 ">
                @if (session()->has('linear_error'))
                    {{ session('linear_error') }}
                @endif

                @if (session()->has('linear_success'))
                    {{ session('linear_success') }}
                @endif
            </p>
        </div>
    @endif

    <div class="flex justify-between py-2 space-x-4 text-sm ">
        <button type="button" wire:click="saveData()" wire:loading.attr="disabled" wire:loading.attr="disabled"
            class="inline-flex items-center justify-center w-full px-6 py-3 mx-auto overflow-hidden font-sans font-medium leading-none text-center text-white no-underline transition duration-200 ease-in-out transform bg-indigo-600 border-none rounded-md shadow-sm cursor-pointer focus:border-none hover:text-white disabled:opacity-25 focus:outline-none focus:ring focus:ring-indigo-600/20 whitespace-nowrap disabled:cursor-not-allowed hover:bg-indigo-700">
            {{ __('Save configuration') }}
            </a>
    </div>
</div>
