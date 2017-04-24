<?php
class BankReviewJson
{
    private $image;
    private $bankName;
    private $address;
    private $priceRange;
    private $url;
    private $rating;
    private $reviewName;
    private $reviewBody;
    public function __construct($bankName, $address, $image, $priceRange, $url, $rating, $reviewName, $reviewBody)
    {
        $this->image = $image;
        $this->bankName = $bankName;
        $this->address = $address;
        $this->priceRange = $priceRange;
        $this->url = $url;
        $this->rating = $rating;
        $this->reviewName = $reviewName;
        $this->reviewBody = $reviewBody;
    }
    public function toJson()
    {
        $review = array(
        "@context" => "http://schema.org/",
        "@type" => "Review",
        "itemReviewed" => array(
          "@type"=> "BankOrCreditUnion",
          "image"=> $this->image,
          "name"=>  $this->bankName,
          "address"=>  $this->address,
          "priceRange"=>  $this->priceRange,
          "url"=>  $this->url
        ),
        "reviewRating" => array(
          "@type" => "Rating",
          "ratingValue" =>  $this->rating
        ),
        "name" =>  $this->reviewName,
        "author" => array(
          "@type"=> "Organization",
          "name"=> "Topbanque.net"
        ),
        "reviewBody" => $this->reviewBody,
        "publisher" => array(
          "@type"=> "Organization",
          "name" => "Topbanque.net"
        ),
        "copyrightHolder"=> array(
          "@type" => "Organization",
          "name" => "Topbanque.net"
        )
      );
        return json_encode($review, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
