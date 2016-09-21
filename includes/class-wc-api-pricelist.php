<?php
class WC_API_Pricelist extends WC_API_Resource {
  protected $base = '/pricelist';

  public function register_routes( $routes ) {
    $routes[ $this->base ] = array(
      array( array( $this, 'get_pricelist' ), WC_API_Server::READABLE ),
    );

    return $routes;
  }

  public function get_pricelist() {
    return array(
      'pricelist' => 'Prislista 4',
      'description' => 'Beskrivning av Prislista 4',
      'comments' => 'Kommentarer av Prislista 4',
      'last_update' => '2016-09-21',
    );
  }
}
