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

                            <div class="relative flex-1">
                                <!-- Replace with your content -->
                                        @forelse($components as $id => $component)
                                            <div x-show="activeComponent == '{{ $id }}'" x-ref="{{ $id }}">
                                                @livewire($component['name'], $component['attributes'], key($id))
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                <!-- /End replace -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
