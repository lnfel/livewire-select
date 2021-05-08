@props([
    'options'
])

<div x-data="selectMultiple()" class="relative">
    <select {{ $attributes->merge(['class' => 'hidden', 'name' => 'multiple', 'multiple' => 'true']) }}>
        <template x-for="(option, index) in options" :key="index">
            <option x-bind:value="option['id']" x-text="option['name']" x-bind:selected="option['selected']"></option>
        </template>
        {{-- @forelse ($options as $option)
            <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
        @empty
            
        @endforelse --}}
    </select>

    <div class="relative" style="width: fit-content;" x-on:click="open = true" x-on:click.away="open = false">
        <input x-model="search" class="rounded-lg mb-2" type="search" name="select-multiple-search">
        <div x-show="open" class="rounded w-full -bottom-20 z-10 max-h-36 overflow-y-auto shadow">
            <ul class="multiple-select-list bg-white">
                <template x-for="(option, index) in filteredOptions" :key="index">
                    <li
                        class="px-4 cursor-pointer"
                        :x-ref="`multiple-${option['id']}`"
                        x-bind:value="option['id']"
                        x-text="option['name']"
                        x-bind:data-selected="option['selected']"
                        x-on:click="select(`${option['id']}`, `${option['name']}`, this.$el)"
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
                    let a = document.querySelector(`[x-ref="multiple-${id}"]`);
                    a.setAttribute('data-selected', 'true');
                    console.log(a);
                    this.selected.indexOf(`${id}`) === -1 ? this.selected.push(`${id}`) : console.log(`${name} is already selected.`)
                },
            }
        } 
    </script>    
@endpush
