<x-app-layout>
    <x-page-content >
        <div x-data="{ selected_brand: null }"
             @click.outside="selected_brand = null"
             @close.stop="selected_brand = null"
             class="m-4"
        >
            <div class="text-lg text-center">
                Select a brand to see your stores.
            </div>

            <div class="flex border-blue justify-center">
                @foreach(Auth::user()->store_brands as $brand)
                    <div @click="selected_brand = selected_brand === {{$brand->id}} ? null : {{$brand->id}}">
                        <x-brand :brand="$brand"/>
                    </div>
                @endforeach
            </div>

            <div x-cloak x-show="selected_brand !== null">

                <div class="flex justify-center mt-4 flex-wrap">
                    @foreach(Auth::user()->stores as $store)
                        <div x-show="{{$store->brand_id}} === selected_brand">
                            <x-store :store="$store"/>
                        </div>
                    @endforeach
                </div>

            </div>


        </div>

    </x-page-content>
</x-app-layout>
