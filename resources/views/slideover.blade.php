<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset

    <div
            x-data="LivewireUISlideover()"
            x-init="init()"
            x-on:close.stop="show = false"
            x-on:keydown.escape.window="closeSlideoverOnEscape()"
            x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
            x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
            x-show="show"
            class="fixed inset-0 z-10 overflow-y-auto"
            style="display: none;"
    >
        <div class="fixed inset-0 overflow-hidden" x-show="show && showActiveComponent" x-transition:enter="ease-in-out duration-500"

        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">


            <div class="absolute inset-0 overflow-hidden" x-show="show && showActiveComponent  " x-transition:enter="ease-in-out duration-500"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                >

                <div class="absolute inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"
                    x-show="show && showActiveComponent" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
        x-on:click="closeSlideoverOnClickAway()"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" ></div>

                <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 pr-0 transition-all duration-500 ease-in-out transform scale-100"
                     x-show="show && showActiveComponent"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-end="translate-x-full">

                    <div class="relative w-screen" x-bind:class="slideoverWidth">


                        <div class="flex flex-col h-full overflow-y-auto bg-white shadow-xl">
                            {{-- <div class="flex justify-between px-4 sm:px-6">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">
                                    Panel title
                                </h2>
                                <div class="" x-show="show && showActiveComponent" @click="show = false">
                                    <button
                                        class="text-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                                        <span class="sr-only">Close panel</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div> --}}
                            <div class="relative flex-1"> <!-- px-4 mt-6 sm:px-6 -->
                                <!-- Replace with your content -->
                                {{-- <div class="absolute inset-0 px-4 sm:px-6">
                                    <div class="h-32 border-2 border-gray-200 border-dashed"
                                    aria-hidden="true"> --}}
ss
                                        @forelse($components as $id => $component)
                                            <div x-show="activeComponent == '{{ $id }}'" x-ref="{{ $id }}">
                                                @livewire($component['name'], $component['attributes'], key($id))
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                {{-- </div> --}}
                                <!-- /End replace -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{{-- <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-10 text-center sm:block sm:p-0">
            <div
                    x-show="show"
                    x-on:click="closeSlideoverOnClickAway()"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-all transform"
            >
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                    x-show="show && showActiveComponent"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-bind:class="modalWidth"
                    class="inline-block w-full overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-full"
            >
                @forelse($components as $id => $component)
                    <div x-show.immediate="activeComponent == '{{ $id }}'" x-ref="{{ $id }}">
                        @livewire($component['name'], $component['attributes'], key($id))
                    </div>
                @empty
                @endforelse
            </div>
        </div> --}}
