<div>
    <div class="container mx-auto p-10">
        <form wire:submit.prevent="save" class="space-y-4 mb-4">
            <x-input.select-multiple :options="$subCategory" wire:model="selected"></x-input.select-multiple>
            <button class="px-4 py-2 rounded-lg text-white bg-blue-500 hover:bg-blue-400 focus:bg-blue-500">Submit</button>
        </form>
        <button wire:click="loadSelected()" class="px-4 py-2 rounded-lg text-white bg-blue-500 hover:bg-blue-400 focus:bg-blue-500 mr-2">Load Selection</button>
        <button wire:click="loadAnother()" class="px-4 py-2 rounded-lg text-white bg-blue-500 hover:bg-blue-400 focus:bg-blue-500">Load Another</button>
    </div>
</div>
