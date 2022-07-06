<?php

namespace Spatie\LaravelOptions\Providers;

use Illuminate\Support\Collection;
use Spatie\LaravelOptions\SelectOption;
use TypeError;

/**
 * @implements Provider<SelectOption>
 */
class SelectOptionsProvider implements Provider
{
    public function __construct(
        protected readonly array|Collection|SelectOption $items,
    ) {
    }

    public function provide(): Collection
    {
        return match (true) {
            $this->items instanceof SelectOption => collect([$this->items]),
            $this->items instanceof Collection => $this->items,
            is_array($this->items) => collect($this->items),
            default => throw new TypeError('Unknown select options type')
        };
    }

    public function map(mixed $item): SelectOption
    {
        return $item;
    }
}
