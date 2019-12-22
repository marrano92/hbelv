<?php

namespace Hbelv\Decorator;

use Hbelv\Decorator;

class DecoratorRooms extends Decorator {

	public function get_size() {
		return sprintf( '%sm²', $this->_obj->meta['_room-size'][0] ?? __( 'ND', 'hbelv' ) ) ;
	}

	public function get_price( string $key = 'low' ) {
		$value = $this->_obj->meta[ sprintf( '_room-price-%s', $key ) ][0] ?? null;

		return $this->get_currency( $value ) ?? null;
	}

	public function get_description() {
		return $this->_obj->meta['_room-description'][0] ?? null;
	}

	public function get_guests() {
		return sprintf( __( '%s Personnes', 'hbelv' ), $this->_obj->meta['_room-guest'][0]  ?? null );
	}

	public function get_name() {
		return $this->_obj->meta['_room-name'][0] ?? null;
	}

	public function get_image( $size ) {
		return $this->_obj->images[ $size ];
	}

	public function get_bed() {
		return sprintf( __( '%s bed', 'hbelv' ), $this->_obj->meta['_room-bed'][0] ?? null );
	}
}
