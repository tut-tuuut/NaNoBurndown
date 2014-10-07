<?php

class NanowrimoApi
{
    protected $base_url = 'http://nanowrimo.org/wordcount_api/';

    protected $services = [
        'user_wc_history' => 'wchistory/',
    ];

    protected $user = '';
    public $user_name = '';

    public function getUserWcHistory($user = '')
    {
        if (!$user && !$this->user) {
            echo 'give me a user plz';
            return;
        } elseif (!$user) {
            $user = $this->user;
        }
        $response = file_get_contents($this->base_url.$this->services['user_wc_history'].$user);
        $xml = new SimpleXmlElement($response);
        if (!empty($xml->error)) {
            throw new Exception($xml->error);
        }
        $this->user_name = $xml->uname;
        $wc = array();
        $total = 0;
        foreach ($xml->wordcounts->wcentry as $k => $entry) {
            $total += (int)$entry->wc;
            $wc[] = [
                'date' => $entry->wcdate,
                'wc' => $entry->wc,
                'subtotal' => $total,
                ];
        }
        return $wc;
    }
}