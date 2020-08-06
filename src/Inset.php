<?php namespace SkeletonWindows;

/**
 * Класс вставки проёма
 */
abstract class Inset {
	private $parentAperture;

	public function __construct(Aperture $parentAperture) {
		$this->parentAperture = $parentAperture;
	}

	/**
	 * Возвращает родителький проём
	 */
	public function getParentAperture(): Aperture {
		return $this->parentAperture;
	}
}
