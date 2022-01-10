<?php

namespace LivewireUI\Slideover\Tests;

use Livewire\Livewire;
use LivewireUI\Slideover\Tests\Components\DemoSlideover;

class LivewireSlideoverComponentTest extends TestCase
{
    public function testCloseSlideover(): void
    {
        Livewire::test(DemoSlideover::class)
            ->call('closeSlideover')
            ->assertEmitted('closeSlideover', false, 0, false);
    }

    public function testForceCloseSlideover(): void
    {
        Livewire::test(DemoSlideover::class)
            ->call('forceClose')
            ->call('closeSlideover')
            ->assertEmitted('closeSlideover', true, 0, false);
    }

    public function testSlideoverSkipping(): void
    {
        Livewire::test(DemoSlideover::class)
            ->call('skipPreviousSlideovers', 5)
            ->call('closeSlideover')
            ->assertEmitted('closeSlideover', false, 5, false);

        Livewire::test(DemoSlideover::class)
            ->call('skipPreviousSlideover')
            ->call('closeSlideover')
            ->assertEmitted('closeSlideover', false, 1, false);

        Livewire::test(DemoSlideover::class)
            ->call('skipPreviousSlideover')
            ->call('destroySkippedSlideovers')
            ->call('closeSlideover')
            ->assertEmitted('closeSlideover', false, 1, true);
    }

    public function testSlideoverEventEmitting(): void
    {
        Livewire::test(DemoSlideover::class)
            ->call('closeSlideoverWithEvents', [
                'someEvent',
            ])
            ->assertEmitted('someEvent');

        Livewire::test(DemoSlideover::class)
            ->call('closeSlideoverWithEvents', [
                DemoSlideover::getName() => 'someEvent',
            ])
            ->assertEmitted('someEvent');

        Livewire::test(DemoSlideover::class)
            ->call('closeSlideoverWithEvents', [
                ['someEventWithParams', ['param1', 'param2']],
            ])
            ->assertEmitted('someEventWithParams', 'param1', 'param2');

        Livewire::test(DemoSlideover::class)
            ->call('closeSlideoverWithEvents', [
                DemoSlideover::getName() => ['someEventWithParams', ['param1', 'param2']],
            ])
            ->assertEmitted('someEventWithParams', 'param1', 'param2');
    }
}
