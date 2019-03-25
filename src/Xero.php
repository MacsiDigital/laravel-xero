<?php

namespace MacsiDigital\Xero;

class Xero
{
    public $client;

    public function __construct($type = 'Private')
    {
        if ($this->applicationExists($type)) {
            $this->bootApplication($type);
        }
    }

    public function applicationExists($type)
    {
        return class_exists('MacsiDigital\Xero\Application\\'.$type.'Application');
    }

    public function bootApplication($type)
    {
        $class = 'MacsiDigital\Xero\Application\\'.$type.'Application';
        $this->client = (new $class());
    }

    public function __get($key)
    {
        return $this->getNode($key);
    }

    public function getNode($key)
    {
        preg_match_all('/(?:^|[A-Z])[a-z]+/', $key, $matches);
        $model = 'MacsiDigital\Xero\Models';
        $i = 1;
        foreach ($matches[0] as $node) {
            if ($i == 1) {
                $model .= '\\'.$node.'\\';
                $i++;
            } else {
                $model .= $node;
            }
        }
        if (class_exists($model)) {
            return new $model();
        }
    }

    public function hasContact($name)
    {
        $contacts = $this->xero->load('\plugins\xero\models\accounting\contact')->where('name', $name)->execute();
        if ($contact = $contacts->first()) {
            return true;
        }

        return false;
    }

    public function createContact($contact_array, $address)
    {
        $contact = new \plugins\xero\models\accounting\contact($this->xero);
        $contact->setName($contact_array['name']);
        $contact->setFirstName($contact_array['first_name']);
        $contact->setLastName($contact_array['last_name']);
        $contact->setEmailAddress($contact_array['email']);
        $contact->setIsCustomer('true');
        $contact->addAddress($address);
        $contact->save();
    }

    public function createAddress($address_array, $type = 'POBOX')
    {
        $address = new \plugins\xero\models\accounting\address($this->xero);
        $address->setAddressType($type);
        $address->setAddressLine1($address_array['address1']);
        $address->setAddressLine2($address_array['address2']);
        $address->setAddressLine3($address_array['address3']);
        $address->setCity($address_array['town']);
        $address->setPostalCode($address_array['post_code']);
        $address->setCountry($address_array['country']);
        $address->save();

        return $address;
    }

    public function createInvoice($contact, $lines, $type = 'ACCREC')
    {
        $invoice = new \plugins\xero\models\accounting\invoice($this->xero);
        $invoice->setType($type);
        $invoice->setContact($contact);
        foreach ($lines as $line) {
            $invoice_line = new \plugins\xero\models\accounting\invoice\lineitem($this->xero);
            $invoice_line->setDescription($line['description']);
            $invoice_line->setQuantity($line['quantity']);
            $invoice_line->setUnitAmount($line['cost']);
            if (isset($line['account_code'])) {
                $invoice_line->setAccountCode($line['account_code']);
            } else {
                $invoice_line->setAccountCode('200');
            }
            $invoice->addLineItem($invoice_line);
        }
        $invoice->save();

        return $invoice->getInvoiceNumber();
    }
}
