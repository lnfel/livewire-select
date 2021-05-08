@props([
    'options'
])

<div x-data="selectMultiple()" class="relative">
    <select class="hidden" name="multiple" id="" multiple>
        <template x-for="(option, index) in options" :key="index">
            <option x-bind:value="option['id']" x-text="option['name']" x-bind:selected="option['selected']"></option>
        </template>
        {{-- @forelse ($options as $option)
            <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
        @empty
            
        @endforelse --}}
    </select>

    <div class="relative">
        <input x-model="search" class="rounded-lg" type="search" name="select-multiple-search">
        <div>
            <template x-for="(option, index) in filteredOptions" :key="index">
                <ul>
                    <li x-bind:value="option['id']" x-text="option['name']" x-bind:data-selected="option['selected']"></li>
                </ul>
            </template>
        </div>
    </div>
</div>

@push('select-multiple')
    <script>
        window.select = document.querySelector('[name="multiple"]');
        function selectMultiple() {
            return {
                open: false,
                options: @entangle('subCategory'),
                search: '',

                get filteredOptions() {
                    if(this.search === '') {
                        return this.options;
                    }

                    return this.options.filter((option) => {
                        return option['name'].toLowerCase().includes(this.search.toLowerCase());
                    });
                },
            }
        } 
    </script>    
@endpush
