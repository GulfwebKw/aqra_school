<x-filament-panels::page>
{{ $this->form }}
    <button type="button" class="bg-primary-500 border-2 border-primary-500 btn btn-g hover:bg-custom-50 px-3 py-2 rounded-md w-max"
            wire:loading.attr="disabled"
            wire:click.prevent="save"
    >Save Changes
    </button>
</x-filament-panels::page>
