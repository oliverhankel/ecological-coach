<x-layouts::app :title="__('Dashboard')">
    <div class="flex flex-col gap-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <flux:heading size="xl">{{ __('Your teams') }}</flux:heading>
                <flux:text>{{ __('Teams you are responsible for.') }}</flux:text>
            </div>

            <flux:button variant="primary" :href="route('teams.create')" wire:navigate>
                {{ __('Create team') }}
            </flux:button>
        </div>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($teams as $team)
                <a href="{{ route('teams.show', $team) }}" wire:navigate class="rounded-xl border border-zinc-200 p-5 hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800">
                    <flux:heading size="lg">{{ $team->name }}</flux:heading>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts::app>
