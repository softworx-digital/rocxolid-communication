<?php

namespace Softworx\RocXolid\Communication\Events\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
// rocXolid common models
use Softworx\RocXolid\Common\Models\Language;

/**
 * Interface to enable event to be further passed to a sending service.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
interface Sendable
{
    /**
     * Retrieve the recipients to send notification to.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRecipients(): Collection;

    /**
     * Retrieve the variables that are available to the blade content.
     *
     * @return array
     */
    public function getSendableVariables(): array;

    /**
     * Retrieve the sending model (the model that is assigned to the event).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSendingModel(): Model;

    /**
     * Retrieve Language reference.
     *
     * @return \Softworx\RocXolid\Common\Models\Language|null
     */
    public function getLanguage(): ?Language;
}
