<?php namespace SkeletonWindows;

/**
 * Класс импоста
 */
final class Impost extends Inset implements ImpostBeamInterface {
	private $isHorizontal;
	private $position;
	private $leftTopAperture;
	private $rightBottomAperture;

	public function __construct(Aperture $parentAperture, bool $isHorizontal, float $position) {
		parent::__construct($parentAperture);

		$this->isHorizontal = $isHorizontal;
		$this->position = $position;
		$this->leftTopAperture = new Aperture();
		$this->rightBottomAperture = new Aperture();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIsHorizontal(): bool {
		return $this->isHorizontal;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getPosition(): float {
		return $this->position;
	}

	/**
	 * Устанавливает местоположение балки
	 */
	public function setPosition(float $value) {
		$this->position = $value;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLeftTopAperture(): Aperture {
		return $this->leftTopAperture;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getRightBottomAperture(): Aperture {
		return $this->rightBottomAperture;
	}
}