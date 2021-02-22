<?php

namespace App\Import;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ImportableInterface
 * @package App\Import
 */
interface ImportableInterface
{
    public function __construct(string $path);

    public function load(): void;

    public function toCollection(): Collection;
}
