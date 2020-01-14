<?php

namespace Softworx\RocXolid\Communication\Events\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface Sendable
{
    public function getRecipients(): Collection;

    public function getSendableVariables(): array;

    public function getSendingModel(): Model;
}
