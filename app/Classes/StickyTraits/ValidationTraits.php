<?php

namespace App\Classes\StickyTraits;

use Exception;

/**
 * Trait ValidationTraits
 */
trait ValidationTraits
{
    private $validateResponse;

    /** Validate API Payload
     *
     * @param array $payload
     * @param array $rules
     * @param int $key - this will use for multiple item update
     */
    private function payloadValidation(array $payload, array $rules, int $key = 0): void
    {
        $this->validateResponse[$key] = json_decode(validator($payload, $rules)->errors(), true);

        if ($this->validateResponse[$key]) {
            throw new Exception(__('sticky.invalid_payload'));
        }
    }
}
