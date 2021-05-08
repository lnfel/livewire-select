@props([
    'options'
])

<div wire:ignore.self x-data="selectMultiple()" x-on:editing.window="renderSelected(event.detail.selected)" class="relative">
    <select {{ $attributes->class(['hidden'])->merge(['class' => '', 'name' => 'multiple', 'multiple' => 'true']) }}>
        <template x-for="(option, index) in options" :key="index">
            <option x-bind:value="option['id']" x-text="option['name']" x-bind:selected="option['selected']"></option>
        </template>
        {{-- @forelse ($options as $option)
            <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
        @empty
            
        @endforelse --}}
    </select>

    <div wire:ignore class="multiple-selected-container p-2 pt-0 bg-white border border-blue-500 rounded-lg mb-4 flex flex-wrap">
        <div class="flex items-center text-sm rounded mr-2 mt-2 bg-blue-500 text-white overflow-hidden" data-value="3">
            <div class="py-2 px-2">Wafer</div> <i class="fas fa-times px-2 py-3 hover:bg-blue-400 cursor-pointer"></i>
        </div>
        <div class="flex items-center text-sm rounded mr-2 mt-2 bg-blue-500 text-white overflow-hidden" data-value="3">
            <div class="py-2 px-2">A very long selected option lies here</div> <i class="fas fa-times px-2 py-3 hover:bg-blue-400 cursor-pointer"></i>
        </div>
        <div class="flex items-center text-sm rounded mr-2 mt-2 bg-blue-500 text-white overflow-hidden" data-value="3">
            <div class="py-2 px-2">A very long selected option lies here</div> <i class="fas fa-times px-2 py-3 hover:bg-blue-400 cursor-pointer"></i>
        </div>
        <div class="flex items-center text-sm rounded mr-2 mt-2 bg-blue-500 text-white overflow-hidden" data-value="3">
            <div class="py-2 px-2">A very long selected option lies here</div> <i class="fas fa-times px-2 py-3 hover:bg-blue-400 cursor-pointer"></i>
        </div>
    </div>

    <template id="tagTemplate">
        <div class="tag flex items-center text-sm rounded mr-2 mt-2 bg-blue-500 text-white overflow-hidden" data-value="">
            <div class="tag-name py-2 px-2"></div> <i class="tag-button fas fa-times px-2 py-3 hover:bg-blue-400 cursor-pointer"></i>
        </div>
    </template>

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

                    if(this.selected.indexOf(`${id}`) === -1 ? this.selected.push(`${id}`) : console.log(`${name} is already selected.`)){
                        selectMultiple().addTag(listItem.value, listItem.textContent);
                    };
                    [...select.options].filter((x) => x.value == id)[0].selected = true;
                },

                renderSelected(selectedItems) {
                    let listContainer = document.querySelector('.multiple-select-list');
                    let tagContainer = document.querySelector('.multiple-selected-container');
                    tagContainer.innerHTML = "";
                    this.selected = [];
                    // reset list styles and style updated selection
                    let resetStyle = listContainer.querySelectorAll(`li`);
                    Array.from(resetStyle).forEach(x => x.classList.remove('bg-blue-500', 'text-white'));
                    for(let i = 0; i < selectedItems.length; i++) {
                        let listItem = listContainer.querySelector(`li[value="${selectedItems[i]}"]`);
                        listItem.classList.add('bg-blue-500', 'text-white');
                        this.selected.indexOf(`${selectedItems[i]}`) === -1 ? this.selected.push(`${selectedItems[i]}`) : console.log(`Nothing to see here Jotaro!`);
                        [...select.options].filter((x) => x.value == `${selectedItems[i]}`)[0].selected = true;
                        //console.log(listItem);

                        selectMultiple().addTag(listItem.value, listItem.textContent);
                    }
                },

                addTag(id, name) {
                    let tagContainer = document.querySelector('.multiple-selected-container');
                    let template = document.querySelector('#tagTemplate');
                    let clone = template.content.cloneNode(true);
                    let tag = clone.querySelector(".tag");
                    let tagName = clone.querySelector(".tag-name");
                    let remove = clone.querySelector(".tag-button");

                    remove.setAttribute('x-on:click', `$wire.emit('removeTag', ${id})`);

                    //remove.addEventListener('click', function(el) {
                    //    console.log(el, el.target.parentNode.dataset.value);
                    //    selectMultiple().removeTag(el.target.parentNode.dataset.value, selected);
                    //});

                    tag.dataset.value = id;
                    tagName.textContent = name;
                    tagContainer.appendChild(clone);
                    console.log(`tag: ${id} ${name}`);
                    console.log('tag container', tagContainer, 'template', template);
                },

                removeTag(id, selected) {
                    let tag = document.querySelector(`.tag[data-value="${id}"]`);
                    console.log("to be removed", tag, id, this.selected);
                    tag.parentNode.removeChild(tag);
                    selected.indexOf(`${id.toString()}`) > -1 ? selected.splice(index, 1) : console.log(`But there is nothing here DIO!`);
                },
            }
        } 
    </script>    
@endpush
