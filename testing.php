<?php
namespace Tech\System\Cron;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;

class TechIntegration
{
    
    /**
     * @var Curl
     */
    protected $curlClient;

    /**
     * @var string
     */
    protected $urlPrefix = 'https://';

    /**
     * @var string
     */
    protected $apiUrl = 'td-dev40f46a5c4290ffb3devaos.cloudax.dynamics.com/data/ReleasedProductsV2';

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */

    protected $productRepository;

    /**
     * @var \Magento\Catalog\Api\Data\ProductInterfaceFactory
     */

    protected $productInterfaceFactory;


    /**
     * @param Curl $curl
     * @param ProductInterfaceFactory $productInterfaceFactory
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(Curl $curl, ProductInterfaceFactory $productInterfaceFactory, ProductRepositoryInterface $productRepository)
    {
        $this->curlClient = $curl;
        $this->productInterfaceFactory = $productInterfaceFactory;
        $this->productRepository =$productRepository;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        $number = 3;
        return $this->urlPrefix . $this->apiUrl .'?' .'$top='. $number;
    }

    /**
     * Gets productInfo json
     *
     * @return array
     */
    public function execute()
    {
        $apiUrl = $this->getApiUrl();

            $this->getCurlClient()->addHeader("Content-Type", "application/json");
            $this->getCurlClient()->addHeader("Authorization", "BearereyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IjJaUXBKM1VwYmpBWVhZR2FYRUpsOGxWMFRPSSIsImtpZCI6IjJaUXBKM1VwYmpBWVhZR2FYRUpsOGxWMFRPSSJ9.eyJhdWQiOiJodHRwczovL3RkLWRldjQwZjQ2YTVjNDI5MGZmYjNkZXZhb3MuY2xvdWRheC5keW5hbWljcy5jb20iLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC80NzNhMGJjNC0zYjI0LTQxZGQtODYzNy0zMWQxZDM0YWU0NjgvIiwiaWF0IjoxNjU4NDAyODMwLCJuYmYiOjE2NTg0MDI4MzAsImV4cCI6MTY1ODQwNjczMCwiYWlvIjoiRTJaZ1lHaHVDWGwydHVIRWdSL1BPamkzL1Rza0FRQT0iLCJhcHBpZCI6IjYzNThmNDlhLTE2YzgtNGFlZC1iYzQwLTJkZjlkYmY2NmU3ZiIsImFwcGlkYWNyIjoiMSIsImlkcCI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzQ3M2EwYmM0LTNiMjQtNDFkZC04NjM3LTMxZDFkMzRhZTQ2OC8iLCJvaWQiOiJiNTQyZDEyNC00NGZmLTQxZDQtODA0My1iMzQwY2U5ODlhYjMiLCJyaCI6IjAuQVF3QXhBczZSeVE3M1VHR056SFIwMHJrYUJVQUFBQUFBQUFBd0FBQUFBQUFBQUFNQUFBLiIsInN1YiI6ImI1NDJkMTI0LTQ0ZmYtNDFkNC04MDQzLWIzNDBjZTk4OWFiMyIsInRpZCI6IjQ3M2EwYmM0LTNiMjQtNDFkZC04NjM3LTMxZDFkMzRhZTQ2OCIsInV0aSI6IlZqcU4tQ2JhUjBTeU9MeVBoTEJMQUEiLCJ2ZXIiOiIxLjAifQ.gokiZ_gFUr3ifCs8nkzQgdPFWrE_RBWIbIuRrFUBUcadDg01h-TVXx0x3cnh2Fujp3hK-NtqtmtiNtourQrwQqHVMt-ddFFVOszeKGKWPPuwxYJf8A2yqgf0ZfMAPH3QT40j2LckOWpTfgKtx91FIkpMfokHHHkp5BTcF7O9p-RcYtmIz5K3aoyBaobPgAoZXiDWzlqy-seM7lI4nYuO3m4-knRl6PGwwEDMiNQtvDqNLSywqTd87mEWOwrJ_4Bai-vHaQ2ZLNT9z5WUgoZ71MDpxG5evXgJXRiB0cMDz--t86Vbuw7xNGohjHz-DgtIwrc1BVlaJj2tHJgnt3nOCg");
            $this->getCurlClient()->get($apiUrl);
            $response = json_decode($this->getCurlClient()->getBody());
            
            $ola = json_encode($response->{'value'});
		
            $te = json_decode($ola);
	//var_dump($te);
	//die();

	 foreach ($te as $item) {
	
            /** @var \Magento\Catalog\Api\Data\ProductInterface $newData */
               
                    $newData = $this->productInterfaceFactory->create();
	       $newData->setTypeId(\Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
	       $newData->setAttributeSetId(4);
	       $newData->setName($iem->SearchName);
                    $newData->setSku($item->ItemNumber);
	       
                   $this->productRepository->save($newData);
	      // $this->productRepository->save($newData);
	      		
		
		
                    
                    }

            
                
       
    }

    /**
     * @return Curl
     */
    public function getCurlClient()
    {
        return $this->curlClient;
    }
}