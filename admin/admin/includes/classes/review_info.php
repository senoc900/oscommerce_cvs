<?
  class reviewInfo {
    var $id, $products_id, $products_name, $products_image, $customers_id, $author, $date_added, $read, $text_size, $rating, $average_rating, $text;

// class constructor
    function reviewInfo($rInfo_array) {
      $this->id = $rInfo_array['reviews_id'];
      $this->products_id = $rInfo_array['products_id'];
      $this->products_name = tep_get_products_name($this->products_id);
      $this->products_image = $rInfo_array['products_image'];
      $this->customers_id = $rInfo_array['customers_id'];
      $this->author = tep_customers_name($rInfo_array['customers_id']);
      $this->date_added = $rInfo_array['date_added'];
      $this->read = $rInfo_array['reviews_read'];
      $this->text_size = $rInfo_array['reviews_text_size'];
      $this->rating = $rInfo_array['reviews_rating'];
      $this->average_rating = $rInfo_array['average_rating'];
      $this->text = stripslashes($rInfo_array['reviews_text']);
    }
  }
?>