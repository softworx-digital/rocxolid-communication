<?php

namespace Softworx\RocXolid\Communication\Models\Traits;

// @otodo - vo vseobecnosti inak - prerobit cele
trait FormatsPhoneNumber
{
    private $_phone_number_formatter_shop = null;

    public function getFormattedPhoneNumber($attribute, $prefix = '+') // prefix - false or string ('+', '00', ...)
    {
        return $this->formatPhoneNumber($this->$attribute, $prefix);
    }

    public function formatSystemPhoneNumber($value, $country = null)
    {
        return $this->formatPhoneNumber($value, false, false, false, $country);
    }

    public function formatPhoneNumber($value, $prefix = '+', $divide_length = 3, $divider = ' ', $country = null)
    {
        $phone_number = filter_var($value, FILTER_SANITIZE_NUMBER_INT);

        $phone_number = str_replace('+', '', $phone_number);

        if (substr($phone_number, 0, 1) == '0') {
            $phone_number = substr($phone_number, 1);
        }

        if (substr($phone_number, 0, 1) == '0') {
            $phone_number = substr($phone_number, 1);
        }

        if (strlen($phone_number) < 9) {
            //throw new \InvalidArgumentException(sprintf('Invalid phone number to format [%s] in [%s]', $phone_number, get_class($this)));
        }
        if ((strlen($phone_number) >= 9) && (strlen($phone_number) < 12)) {
            $phone_number = sprintf('%s%s', $country ? $country->calling_code : $this->getPhoneNumberFormatterShop()->country->calling_code, substr($phone_number, -9));
        } elseif (strlen($phone_number) > 12) {
            //$phone_number = substr($phone_number, -12);
        }

        if ($divide_length) {
            $phone_number = str_split($phone_number, $divide_length);
        }

        if ($divider) {
            $phone_number = str_replace(' ', $divider, $phone_number);
        }

        if ($prefix) {
            $phone_number = sprintf('%s%s', $prefix, $phone_number);
        }

        return $phone_number;
    }

    public function getPhoneNumberFormatterShop()
    {
        if (is_null($this->_phone_number_formatter_shop)) {
            if (method_exists($this, 'shop')) {
                $this->_phone_number_formatter_shop = $this->shop;
            } elseif (method_exists($this, 'order')) {
                $this->_phone_number_formatter_shop = $this->order->shop;
            } elseif (method_exists($this, 'invoice')) {
                $this->_phone_number_formatter_shop = $this->invoice->shop;
            }

            if (is_null($this->_phone_number_formatter_shop)) {
                throw new \RuntimeException(sprintf('Cannot resolve shop for [%s]', get_class($this)));
            }
        }

        return $this->_phone_number_formatter_shop;
    }
}
