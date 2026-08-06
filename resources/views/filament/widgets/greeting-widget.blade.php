@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section class="fi-account-widget-section">
        <x-filament-panels::avatar.user size="lg" :user="$user" />
            <div class="fi-account-widget-main">
                <h1 class="fi-account-widget-heading grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    {{ $this->getGreeting() }}
                </h1>
                <p class="fi-account-widget-user-name text-sm text-gray-500 dark:text-gray-400">
                    {{ filament()->getUserName($user) }}
                </p>
            </div>

            <form
                action="{{ filament()->getLogoutUrl() }}"
                method="post"
                class="fi-account-widget-logout-form"
            >
                @csrf
                <x-filament::button
                    color="gray"
                    icon="heroicon-m-arrow-left-on-rectangle"
                    icon-alias="panels::widgets.account.logout-button"
                    labeled-from="sm"
                    tag="button"
                    type="submit"
                >
                    Sign out
                </x-filament::button>
            </form>
    </x-filament::section>
</x-filament-widgets::widget>
