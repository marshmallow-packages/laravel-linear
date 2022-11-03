<div>

    <p class="mb-2 font-sans font-semibold leading-6 text-md">
        {{ __('Authenticate Laravel with Linear') }}
    </p>
    <p class="pb-2 font-sans text-sm font-normal leading-6">
        {{ __('Once you do, you can quickly create issues from your Laravel application.') }}
        @if ($linear_token)
            {!! __('If you wish to update the config of the connection, please click :here.', [
                'here' => '<a class="underline" href="' . route('linear.config', $linear_token) . '">' . __('here') . '</a>',
            ]) !!}
        @endif
    </p>

    <x-mm-divider />

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
        @if ($linear_token && $has_token)
            <button type="button" wire:click="revokeToken()" wire:loading.attr="disabled"
                class="inline-flex items-center justify-center w-full px-6 py-3 mx-auto overflow-hidden font-sans font-medium leading-none text-center text-white no-underline transition duration-200 ease-in-out transform border-none rounded-md shadow-sm cursor-pointer focus:outline-none focus:ring focus:border-transparent hover:text-white disabled:opacity-25 focus:outline-transparent focus:ring-gray-200/10 whitespace-nowrap disabled:cursor-not-allowed bg-gray-200/20 hover:bg-gray-200/10">
                {{ __('Disconnect') }}
            </button>
        @endif
        <a href="{{ route('linear.oauth.redirect') }}" wire:loading.attr="disabled"
            class="inline-flex items-center justify-center w-full px-6 py-3 mx-auto overflow-hidden font-sans font-medium leading-none text-center text-white no-underline transition duration-200 ease-in-out transform bg-indigo-600 border-none rounded-md shadow-sm cursor-pointer focus:border-none hover:text-white disabled:opacity-25 focus:outline-none focus:ring focus:ring-indigo-600/20 whitespace-nowrap disabled:cursor-not-allowed hover:bg-indigo-700">
            {{ __('Authenticate') }}
        </a>
    </div>
    @if ($linear_token && $has_token)
        <p class="pt-2 font-sans text-xs font-normal leading-6 text-opacity-80">
            {{ __('Linear is connected on :auth_date and will expire on :auth_expires', [
                'auth_date' => $linear_token->auth_date,
                'auth_expires' => $linear_token->auth_expires,
            ]) }}
        </p>
    @endif
</div>
