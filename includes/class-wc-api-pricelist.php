<?php
class WC_API_Pricelist extends WC_API_Resource {
  protected $base = '/pricelist';

  public function register_routes( $routes ) {

    # GET/POST /pricelist
		$routes[ $this->base ] = array(
			array( array( $this, 'get_pricelist' ), WC_API_Server::READABLE ),
			array( array( $this, 'create_pricelist' ), WC_API_SERVER::CREATABLE | WC_API_Server::ACCEPT_DATA ),
		);

    # GET /pricelist/list
		$routes[ $this->base . '/list' ] = array(
			array( array( $this, 'get_pricelist_list' ), WC_API_Server::READABLE ),
		);

    return $routes;
  }

  /**
	 * Get the pricelist for the given ID
	 *
	 * @since 2.1
	 * @param int $id the pricelist ID
	 * @return array
	 */
  public function get_pricelist($id = null) {
    return array(
      'pricelist' => 'Prislista 4',
      'description' => 'Beskrivning av Prislista 4',
      'comments' => 'Kommentarer av Prislista 4',
      'last_update' => '2016-09-21',
    );
  }
  /**
	 * Get a list of price lists
	 *
	 * @since 2.1
	 * @return array
	 */
  public function get_pricelist_list() {
    return array(
      'pricelist' => 'Prislista 4',
      'description' => 'Beskrivning av Prislista 4',
      'comments' => 'Kommentarer av Prislista 4',
      'last_update' => '2016-09-21',
    );
  }
}
