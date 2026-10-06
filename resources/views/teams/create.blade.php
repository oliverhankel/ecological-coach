<x-layouts::app :title="__('Create team')">
    <div class="mx-auto w-full max-w-xl space-y-6">
        <div>
            <flux:heading size="xl">{{ __('Create a team') }}</flux:heading>
            <flux:text>{{ __('Give your team a name to get started.') }}</flux:text>
        </div>

        <form method="POST" action="{{ route('teams.store') }}" class="space-y-6">
            @csrf

            <flux:input name="name" :label="__('Team name')" :value="old('name')" required autofocus maxlength="255" />

            <flux:button type="submit" variant="primary">
                {{ __('Create team') }}
            </flux:button>
        </form>
    </div>
</x-layouts::app>
