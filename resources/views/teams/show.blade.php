<x-layouts::app :title="$team->name">
    <div class="space-y-6">
        <flux:link :href="route('dashboard')" wire:navigate>{{ __('Back to dashboard') }}</flux:link>
        <flux:heading size="xl">{{ $team->name }}</flux:heading>
    </div>
</x-layouts::app>
