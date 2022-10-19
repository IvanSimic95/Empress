<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "<?php echo $title; ?>",
  "image": "https://psychic-artist.com<?php echo $image; ?>",
  "sku": "0446310786",
  "description": "<?php echo $sdescription; ?>",
  "mpn": "925872",
  "brand": {
        "@type": "Brand",
        "name": "Psychic Artist"
      },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?php echo $avgrating; ?>",
    "reviewCount": "<?php echo $reviews; ?>"
  },
  "offers": {
    "@type": "Offer",
    "url": "<?php echo $url; ?>",
    "priceCurrency": "USD",
    "price": "<?php echo $price; ?>",
    "priceValidUntil": "2022-01-25",
    "itemCondition": "http://schema.org/UsedCondition",
    "availability": "http://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Psychic Artist"
    }
  }
}
</script>