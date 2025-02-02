<?php

namespace Infrastructure;

class View
{
    /**
     * @param array<mixed> $data
     */
    public function __construct(protected string $name, protected array $data = [])
    {
    }
    public function render(): void
    {
        extract($this->data);
        require __DIR__ . "/../views/{$this->name}.php";
    }
}
