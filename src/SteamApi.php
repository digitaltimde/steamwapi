<?php

namespace SteamApi;

use SteamApi\Configs\Apps;
use SteamApi\Requests\InspectItem;
use SteamApi\Requests\InspectItemV2;
use SteamApi\Requests\ItemListings;
use SteamApi\Requests\ItemNameId;
use SteamApi\Requests\ItemOrdersHistogram;
use SteamApi\Requests\ItemPricing;
use SteamApi\Requests\SaleHistory;

class SteamApi
{
    private $detailed = false;

    private $multiRequest = false;

    private $proxy = [];

    private $select = [];
    private $makeHidden = [];

    private $curlOpts = [];


    /**
     * @param $proxy
     * @return $this
     */
    public function withProxy($proxy): SteamApi
    {
        $this->proxy = $proxy;
        return $this;
    }

    /**
     * @return $this
     */
    public function detailed(): SteamApi
    {
        $this->detailed = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function multiRequest(): SteamApi
    {
        $this->multiRequest = true;
        return $this;
    }

    /**
     * @param array $select
     * @return $this
     */
    public function select(array $select = []): SteamApi
    {
        $this->select = $select;
        return $this;
    }

    /**
     * @param array $makeHidden
     * @return $this
     */
    public function makeHidden(array $makeHidden = []): SteamApi
    {
        $this->makeHidden = $makeHidden;
        return $this;
    }

    /**
     * @param array $curlOpts
     * @return $this
     */
    public function withCustomCurlOpts(array $curlOpts): SteamApi
    {
        $this->curlOpts = $curlOpts;
        return $this;
    }



    /**
     * @param int $appId
     * @param array $options
     * @return mixed
     * @throws Exception\InvalidClassException
     * @throws Exception\InvalidOptionsException
     */
    public function getItemListings(int $appId = Apps::CSGO_ID, array $options = [])
    {
        return (new ItemListings($appId, $options))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response($this->select, $this->makeHidden);
    }

    /**
     * @param int $appId
     * @param array $options
     * @return mixed
     * @throws Exception\InvalidClassException
     * @throws Exception\InvalidOptionsException
     */
    public function getItemOrdersHistogram(int $appId = Apps::CSGO_ID, array $options = [])
    {
        return (new ItemOrdersHistogram($appId, $options))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response($this->select, $this->makeHidden);
    }

    /**
     * @param int $appId
     * @param array $options
     * @return mixed
     * @throws Exception\InvalidClassException
     * @throws Exception\InvalidOptionsException
     */
    public function getSaleHistory(int $appId = Apps::CSGO_ID, array $options = [])
    {
        return (new SaleHistory($appId, $options))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response($this->select, $this->makeHidden);
    }

    /**
     * @param int $appId
     * @param array $options
     * @return mixed
     * @throws Exception\InvalidClassException
     * @throws Exception\InvalidOptionsException
     */
    public function getItemNameId(int $appId = Apps::CSGO_ID, array $options = [])
    {
        return (new ItemNameId($appId, $options))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response();
    }

    /**
     * @param int $appId
     * @param array $options
     * @return mixed
     * @throws Exception\InvalidClassException
     * @throws Exception\InvalidOptionsException
     */
    public function getItemPricing(int $appId = Apps::CSGO_ID, array $options = [])
    {
        return (new ItemPricing($appId, $options))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response($this->select, $this->makeHidden);
    }

    /**
     * @param string $inspectLink
     * @return mixed
     * @throws Exception\InvalidClassException
     */
    public function inspectItem(string $inspectLink)
    {
        return (new InspectItem($inspectLink))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response($this->select, $this->makeHidden);
    }

    /**
     * @param string $inspectLink
     * @return mixed
     * @throws Exception\InvalidClassException
     */
    public function inspectItemV2(string $inspectLink)
    {
        return (new InspectItemV2($inspectLink))
            ->call($this->proxy, $this->detailed, $this->multiRequest, $this->curlOpts)
            ->response($this->select, $this->makeHidden);
    }
}