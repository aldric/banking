<?php
class BankCatalogJson
{
    private $image;
    private $bankName;
    private $address;
    private $priceRange;
    private $telephone;
    private $url;

    public function __construct($bankName, $address, $telephone, $image, $priceRange, $url)
    {
        $this->image = $image;
        $this->bankName = $bankName;
        $this->address = $address;
        $this->priceRange = $priceRange;
        $this->telephone = $telephone;
        $this->url = $url;
    }

    public function toJson($pages)
    {
        $review = array(
        "@context" => "http://schema.org/",
        "@type" => "Service",
        "serviceType" => "Banque en ligne",
         "areaServed" => array(
            "@type" => "State",
            "name" => "France"
         ),
        "provider" => array(
          "@type"=> "BankOrCreditUnion",
          "image"=> $this->image,
          "name"=>  $this->bankName,
          "address"=>  $this->address,
          "priceRange"=>  $this->priceRange,
          "telephone"=>  $this->telephone,
          "url"=>  $this->url
        ),
        "hasOfferCatalog" => array(
            "@type" => "OfferCatalog",
            "name" => "Services proposés",
            "itemListElement" => array(
                 "@type" => "OfferCatalog",
                 "name" => $pages->title,
                 "url" => $pages->permalink
                )
        )
      );
        foreach($pages->children as $children) {
            $subs =  $this->getCatalog($children);
            if(count($subs) > 0)
                array_push($review["hasOfferCatalog"]["itemListElement"], $subs);
        }

        return json_encode($review, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function getCatalog($childrenPage) {
        $sub = array();
        foreach($childrenPage as $child) {
            array_push($sub, new BankOffer("Service", $child->title, $child->permalink).toData());
            if(count($child->children) >0) {

            }
        }
    }
}
class BankOffer {
    public $name;
    public $type;
    public $url;

    public function __construct($type, $name, $url){
        $this->type = $type;
        $this->name = $name;
        $this->url = $url;
    }

    public function toData() {
        return array(
            "@type" => $thid->type,
            "name" => $thid->name,
            "url" => $thid->url;
        );
    }
}
