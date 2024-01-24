<x-filament-panels::page>
    <form wire:submit="check">
        {{ $this->form }}

        <x-filament::button class="mt-6" type="submit">
            Reserve Elements
        </x-filament::button>
    </form>
</x-filament-panels::page>
