@props([
    'options'
])

<div x-data="selectMultiple()" x-on:editing.window="renderSelected(event.detail.selected)" class="relative">
    <select {{ $attributes->class(['hidden'])->merge(['class' => '', 'name' => 'multiple', 'multiple' => 'true']) }}>
        <template x-for="(option, index) in options" :key="index">
            <option x-bind:value="option['id']" x-text="option['name']" x-bind:selected="option['selected']"></option>
        </template>
        {{-- @forelse ($options as $option)
            <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
        @empty
            
        @endforelse --}}
    </select>

    <div class="p-2 bg-white border border-blue-500 rounded-lg">

    </div>

    <div class="relative" style="width: fit-content;" x-on:click="open = true" x-on:click.away="open = false">
        <input x-model="search" class="rounded-lg mb-2" type="search" name="select-multiple-search">
        <div wire:ignore x-show="open" class="rounded w-full -bottom-20 z-10 max-h-52 overflow-y-auto shadow">
            <ul class="multiple-select-list bg-white">
                <template x-for="(option, index) in filteredOptions" :key="index">
                    <li
                        class="px-4 py-.5 cursor-pointer"
                        :x-ref="`multiple-${option['id']}`"
                        x-bind:value="option['id']"
                        x-text="option['name']"
                        x-bind:data-selected="option['selected']"
                        x-on:click="select(`${option['id']}`, `${option['name']}`, )"
                    ></li>
                </template>
            </ul>
        </div>
    </div>
</div>

@push('select-multiple')
    <script>
        window.select = document.querySelector('[name="multiple"]');
        function selectMultiple() {
            return {
                open: false,
                options: {!! $options !!},
                selected: @entangle('selected'),
                search: '',

                get filteredOptions() {
                    if(this.search === '') {
                        return this.options;
                    }

                    return this.options.filter((option) => {
                        return option['name'].toLowerCase().includes(this.search.toLowerCase());
                    });
                },

                select(id, name, el) {
                    let listContainer = document.querySelector('.multiple-select-list');

                    let listItem = listContainer.querySelector(`li[value="${id}"]`);
                    listItem.classList.add('bg-blue-500', 'text-white');

                    this.selected.indexOf(`${id}`) === -1 ? this.selected.push(`${id}`) : console.log(`${name} is already selected.`);
                    [...select.options].filter((x) => x.value == id)[0].selected = true;
                },

                renderSelected(selectedItems) {
                    let listContainer = document.querySelector('.multiple-select-list');

                    for(let i = 0; i < selectedItems.length; i++) {
                        let listItem = listContainer.querySelector(`li[value="${selectedItems[i]}"]`);
                        listItem.classList.add('bg-blue-500', 'text-white');
                        this.selected.indexOf(`${selectedItems[i]}`) === -1 ? this.selected.push(`${selectedItems[i]}`) : console.log(`Nothing to see here Jotaro!`);
                        [...select.options].filter((x) => x.value == `${selectedItems[i]}`)[0].selected = true;
                        console.log(listItem);
                    }
                },
            }
        } 
    </script>    
@endpush
