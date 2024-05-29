<?php

namespace App\Services\Src\API\Requests;

use App\Models\User;
use App\Services\Src\API\Classes\ClientInfo;
use App\Services\Src\API\Classes\Transaction;
use App\Services\Src\API\Interfaces\Normalize;
use Illuminate\Http\Request;

abstract class API implements Normalize
{
    /**
     * @var \SoapClient $soapClient
     * @var ClientInfo $clientInfo
     * @var Transaction $transaction
     */
    protected $soapClient;
    protected $clientInfo;
    protected $transaction;
    protected $test_wsdl;
    protected $live_wsdl;
    protected $environment;

    public function __construct(Request $request)
    {
        $user = auth()->user();

        $aramex_credentials = \DB::table('aramex_credentials')->where("organization_id", $user->organization_id)->where('delivery_service_id', $request->delivery_service_id)->first();

        $credential = $aramex_credentials;
        $aramex_credentials->isTest ? $this->useTestAsEnvironment() : $this->useLiveAsEnvironment();
        $username = $credential->isTest ? $credential->test_username : $credential->live_username;
        $password = $credential->isTest ? $credential->test_password : $credential->live_password;
        $number = $credential->isTest ? $credential->test_number : $credential->live_number;
        $pin = $credential->isTest ? $credential->test_pin : $credential->live_pin;
        $version = config('aramex.' . $this->environment . '.version');

        $this->fillClientInfoFromEnv($credential->country_code, $credential->entity, $number, $pin, $username, $password, $version);

        $this->soapClient = new \SoapClient($this->getWsdlAccordingToEnvironment(), array('trace' => 1));
    }

    public function setClientInfo(ClientInfo $clientInfo)
    {
        $this->clientInfo = $clientInfo;
        return $this;
    }

    /**
     * @return ClientInfo
     */
    public function getClientInfo()
    {
        return $this->clientInfo;
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param $transaction
     * @return $this
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    /**
     * @param $environment
     * @return $this
     */
    protected function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }

    public function useTestAsEnvironment()
    {
        return $this->setEnvironment('test');
    }

    public function useLiveAsEnvironment()
    {
        return $this->setEnvironment('live');
    }

    /**
     * @return bool
     */
    public function isTest()
    {
        return $this->environment === "test";
    }

    /**
     * @return bool
     */
    public function isLive()
    {
        return $this->environment === "live";
    }

    /**
     * @return string
     */
    public function getWsdlAccordingToEnvironment()
    {
        if ($this->isLive()) {
            return $this->live_wsdl;
        } else {
            return $this->test_wsdl;
        }
    }

    /**
     * @throws \Exception
     */
    protected function validate()
    {
        if (!$this->clientInfo) {
            throw new \Exception('Client Info Not Provided');
        }
    }

    /**
     * @return $this
     */
    private function fillClientInfoFromEnv($country_code, $entity, $number, $pin, $username, $password, $version)
    {
        $this->clientInfo = (new ClientInfo())
            ->setAccountCountryCode($country_code)
            ->setAccountEntity($entity)
            ->setAccountNumber($number)
            ->setAccountPin($pin)
            ->setUserName($username)
            ->setPassword($password)
            ->setVersion($version);

        return $this;
    }

    // public function getAccountNumber()
    // {
    //     return config("aramex.$this->environment.number");
    // }

    public function normalize(): array
    {
        return [
            'ClientInfo' => $this->getClientInfo()->normalize(),
            'Transaction' => optional($this->getTransaction())->normalize(),
        ];
    }
}
