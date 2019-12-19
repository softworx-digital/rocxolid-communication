<?php

namespace Softworx\RocXolid\Communication\Contracts;

// @todo - doplnit + typy
interface Sendable
{
    public function getSendingModel($action);

    public function getEvent();

    public function getSender($flat = false);

    public function getRecipient(): string;

    public function getContent(): string; // @todo - nejako inak renderovat content - asi cez fetchovanie componentu, ak to pojde

    public function logActivity($sucess);
}