<?php

namespace LivewireUI\Slideover\Tests\Components;

use LivewireUI\Slideover\SlideoverComponent;

class DemoSlideover extends SlideoverComponent
{
    public function render()
    {
        return <<<'blade'
            <div>
                Hello
            </div>
        blade;
    }
}
