<?php
namespace AppBundle\Controller;

use CurrencyExchangeService\CurrencyExchangeService;
use CurrencyExchangeService\Provider\SwapAdapterProviderFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyExchangeController extends Controller
{

    /**
     * number of places to round
     * @var int
     */
    private $precisionRound;

    /**
     * Value multiplier e.g. ['RUB/PLN' => 0.5]
     * @var array
     */
    private $rangeArray;

    /**
     * @param int $precisionRound number of places to round
     * @param array $rangeArray e.g. ['RUB/PLN' => 0.5]
     */
    public function __construct(int $precisionRound, array $rangeArray)
    {
        $this->precisionRound = $precisionRound;
        $this->rangeArray = $rangeArray;
    }

    /**
     * @Route("/convert", name="convert")
     * 
     * API to exchange convert
     * 
     * get amount of currency and type currency original and destination
     */
    public function convertAction(Request $request)
    {
        $value = (float) str_replace(',', '.', $request->get('value', ''));
        $from = $request->get('from', null);
        $to = $request->get('to', null);

        $providerConvertFactory = new SwapAdapterProviderFactory();
        $providerConvertFactory->setParameters([
            'precisionRound' => $this->precisionRound,
            'rangeArray' => $this->rangeArray
        ]);

        $currencyExchangeService = new CurrencyExchangeService($providerConvertFactory);

        $dataResponse = [];
        $dataResponse['value'] = $currencyExchangeService->convert($value, $from, $to);
        $dataResponse['value'] = str_replace('.', ',', $dataResponse['value']);
        $dataResponse['currency'] = $to;

        return new JsonResponse($dataResponse);
    }
}
