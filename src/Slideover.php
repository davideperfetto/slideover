<?php

namespace LivewireUI\Slideover;

use Exception;
use Illuminate\View\View;
use Livewire\Component;
use ReflectionClass;

class Slideover extends Component
{
    public ?string $activeComponent;

    public array $components = [];

    public function resetState(): void
    {
        $this->components = [];
        $this->activeComponent = null;
    }

    public function openSlideover($component, $componentAttributes = [], $SlideoverAttributes = []): void
    {
        $requiredInterface = \LivewireUI\Slideover\Contracts\SlideoverComponent::class;
        $componentClass = app('livewire')->getClass($component);
        $reflect = new ReflectionClass($componentClass);

        if ($reflect->implementsInterface($requiredInterface) === false) {
            throw new Exception("[{$componentClass}] does not implement [{$requiredInterface}] interface.");
        }

        $id = md5($component . serialize($componentAttributes));
        $this->components[$id] = [
            'name'            => $component,
            'attributes'      => $componentAttributes,
            'slideoverAttributes' => array_merge([
                'closeOnClickAway' => $componentClass::closeSlideoverOnClickAway(),
                'closeOnEscape' => $componentClass::closeSlideoverOnEscape(),
                'closeOnEscapeIsForceful' => $componentClass::closeSlideoverOnEscapeIsForceful(),
                'dispatchCloseEvent' => $componentClass::dispatchCloseEvent(),
                'destroyOnClose' => $componentClass::destroyOnClose(),
                'maxWidth' => $componentClass::SlideoverMaxWidth(),
                'maxWidthClass' => $componentClass::SlideoverMaxWidthClass(),
            ], $SlideoverAttributes),
        ];

        $this->activeComponent = $id;

        $this->emit('activeSlideoverComponentChanged', $id);
    }

    public function destroyComponent($id): void
    {
        unset($this->components[$id]);
    }

    public function getListeners(): array
    {
        return [
            'openSlideover',
            'destroyComponent'
        ];
    }

    public function render(): View
    {
        return view('livewire-ui-slideover::slideover');
    }
}
