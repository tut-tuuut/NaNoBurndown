<?php

class NanowrimoApi
{
    protected $base_url = 'http://nanowrimo.org/wordcount_api/';
    protected $target = 50000;
    protected $nb_of_days = 30;

    protected $services = [
        'user_wc_history' => 'wchistory/',
    ];

    protected $user = '';
    protected $user_name = '';
    protected $wc;
    protected $total;

    public function getUserWcHistory($user = '')
    {
        if (!$user && !$this->user) {
            echo '<p class="error">give me a user plz</p>';
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
        $expected_total = 0;
        foreach ($xml->wordcounts->wcentry as $k => $entry) {
            $total += (int)$entry->wc;
            $expected_total += ceil($this->target/$this->nb_of_days);
            $wc[] = [
                'date' => $entry->wcdate,
                'wc' => $entry->wc,
                'subtotal' => $total,
                'expected' => $expected_total,
                ];
        }
        $this->wc = $wc;
        $this->total = $total;
        return $wc;
    }

    public function setUserId($user)
    {
        $this->user = $user;
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     *  Get number of words before having a "round" count
     *  on total and today's word count 
     */
    public function getWineAndCheese()
    {

        $today = end($this->wc)['wc'];
        $total = $this->total;

        $wine = $today != 0 ? $today%1000 : 1000;
        $cheese = $total != 0 ? $total%1000 : 1000;

        return array(
            'total' => $total,
            'today' => $today,
            'wine'  => $wine,
            'cheese'=> $cheese,
        );
    }
}