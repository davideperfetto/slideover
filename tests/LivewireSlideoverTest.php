<?php

namespace LivewireUI\Slideover\Tests;

use Livewire\Livewire;
use LivewireUI\Slideover\Slideover;
use LivewireUI\Slideover\Tests\Components\DemoSlideover;
use LivewireUI\Slideover\Tests\Components\InvalidSlideover;

use function PHPUnit\Framework\assertArrayNotHasKey;

class LivewireSlideoverTest extends TestCase
{
    public function testOpenSlideoverEventListener(): void
    {
        // Demo slideover component
        Livewire::component('demo-slideover', DemoSlideover::class);

        // Event attributes
        $component = 'demo-slideover';
        $componentAttributes = [ 'message' => 'Foobar' ];
        $slideoverAttributes = [ 'hello' => 'world', 'closeOnEscape' => true, 'maxWidth' => '2xl',  'maxWidthClass' => 'sm:max-w-md md:max-w-xl lg:max-w-2xl', 'closeOnClickAway' => true, 'closeOnEscapeIsForceful' => true, 'dispatchCloseEvent' => false, 'destroyOnClose' => false ];

        // Demo slideover unique identifier
        $id = md5($component . serialize($componentAttributes));

        Livewire::test(Slideover::class)
            ->emit('openSlideover', $component, $componentAttributes, $slideoverAttributes)
            // Verify component is added to $components
            ->assertSet('components', [
                $id => [
                    'name'            => $component,
                    'attributes'      => $componentAttributes,
                    'slideoverAttributes' => $slideoverAttributes,
                ],
            ])
            // Verify component is set to active
            ->assertSet('activeComponent', $id)
            // Verify event is emitted to client
            ->assertEmitted('activeSlideoverComponentChanged', $id);
    }

    public function testDestroyComponentEventListener(): void
    {
        // Demo slideover component
        Livewire::component('demo-slideover', DemoSlideover::class);

        $component = 'demo-slideover';
        $componentAttributes = [ 'message' => 'Foobar' ];
        $slideoverAttributes = [ 'hello' => 'world', 'closeOnEscape' => true, 'maxWidth' => '2xl', 'maxWidthClass' => 'sm:max-w-md md:max-w-xl lg:max-w-2xl', 'closeOnClickAway' => true, 'closeOnEscapeIsForceful' => true, 'dispatchCloseEvent' => false, 'destroyOnClose' => false ];

        // Demo slideover unique identifier
        $id = md5($component . serialize($componentAttributes));

        Livewire::test(Slideover::class)
            ->emit('openSlideover', $component, $componentAttributes, $slideoverAttributes)
            ->assertSet('components', [
                $id => [
                    'name'            => $component,
                    'attributes'      => $componentAttributes,
                    'slideoverAttributes' => $slideoverAttributes,
                ],
            ])
            ->emit('destroyComponent', $id)
            ->assertSet('components', []);

    }

    public function testSlideoverReset(): void
    {
        Livewire::component('demo-slideover', DemoSlideover::class);

        Livewire::test(Slideover::class)
            ->emit('openSlideover', 'demo-slideover')
            ->set('components', [
                'some-component' => [
                    'name'            => 'demo-slideover',
                    'attributes'      => 'bar',
                    'slideoverAttributes' => [],
                ],
            ])
            ->set('activeComponent', 'some-component')
            ->call('resetState')
            // Verify properties are reset
            ->assertSet('activeComponent', null)
            ->assertSet('components', []);
    }

    public function testIfExceptionIsThrownIfSlideoverDoesNotImplementContract(): void
    {
        $component = InvalidSlideover::class;
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("[{$component}] does not implement [LivewireUI\Slideover\Contracts\SlideoverComponent] interface.");

        Livewire::component('invalid-slideover', $component);
        Livewire::test(Slideover::class)->emit('openSlideover', 'invalid-slideover');
    }
}
