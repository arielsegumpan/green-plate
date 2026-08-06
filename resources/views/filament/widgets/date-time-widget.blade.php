<x-filament-widgets::widget class="fi-datetime-widget">
    <x-filament::section class="fi-datetime-widget-section flex items-center gap-x-3">

         <x-slot>
            <x-filament::icon-button icon="heroicon-o-clock" class="text-3xl" />
        </x-slot>

        <x-slot>

            <div class="fi-datetime-widget-main flex-1" x-data="{
                now: new Date({{ $this->getServerTimestamp() }}),
                init() {
                    setInterval(() => {
                        this.now = new Date(this.now.getTime() + 1000);
                    }, 1000);
                },
                formattedTime() {
                    return this.now.toLocaleTimeString(undefined, {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    });
                },
                formattedDate() {
                    return this.now.toLocaleDateString(undefined, {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                    });
                },
            }">
                <h1 class="fi-account-widget-heading grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                    x-text="formattedTime()"></h1>
                <p class="fi-datetime-widget-date text-gray-500 dark:text-gray-400" x-text="formattedDate()">
                </p>
            </div>
        </x-slot>


    </x-filament::section>
</x-filament-widgets::widget>
