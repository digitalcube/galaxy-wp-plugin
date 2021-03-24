<?php
/**
 * Galaxy_Index_Replica class file.
 *
 * @author  WebDevStudios <contact@webdevstudios.com>
 * @since   0.0.0
 *
 * @package DigitalCube\Galaxy
 */

/**
 * Class Galaxy_Index_Replica
 *
 * @since 1.0.0
 */
class Galaxy_Index_Replica {

	const ORDER_ASC  = 'asc';
	const ORDER_DESC = 'desc';

	/**
	 * The attribute name.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @var string
	 */
	private $attribute_name;

	/**
	 * The order.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @var string
	 */
	private $order;

	/**
	 * Galaxy_Index_Replica constructor.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @param string $attribute_name The attribute name.
	 * @param string $order          The order.
	 *
	 * @throws InvalidArgumentException If order is not `asc` or `desc`.
	 */
	public function __construct( $attribute_name, $order ) {
		$this->attribute_name = (string) $attribute_name;

		if ( self::ORDER_ASC !== $order && self::ORDER_DESC !== $order ) {
			throw new InvalidArgumentException( 'Order should be one of \'asc\' or \'desc\'.' );
		}

		$this->order = $order;
	}

	/**
	 * Get replica index name.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @param Galaxy_Index $index The Galaxy_Index instance.
	 *
	 * @return string
	 */
	public function get_replica_index_name( Galaxy_Index $index ) {
		return (string) $index->get_name() . '_' . $this->attribute_name . '_' . $this->order;
	}

	/**
	 * Get ranking.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @return array
	 */
	public function get_ranking() {
		return array( $this->order . '(' . $this->attribute_name . ')', 'typo', 'geo', 'words', 'filters', 'proximity', 'attribute', 'exact', 'custom' );
	}

	/**
	 * Get attribute name.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @return string
	 */
	public function get_attribute_name() {
		return $this->attribute_name;
	}

	/**
	 * Get order.
	 *
	 * @author WebDevStudios <contact@webdevstudios.com>
	 * @since  1.0.0
	 *
	 * @return string
	 */
	public function get_order() {
		return $this->order;
	}
}
