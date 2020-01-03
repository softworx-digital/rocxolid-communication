<?php

namespace Softworx\RocXolid\Communication\Contracts;

use Illuminate\Support\Collection;

// @todo - doplnit + typy
interface Sendable
{
    public function getSendingModel($action);

    public function getEvent();

    public function getSender($flat = false);

    public function getRecipients(): Collection;

    public function getContent(): string; // @todo - nejako inak renderovat content - asi cez fetchovanie componentu, ak to pojde

    public function logActivity($sucess);
}