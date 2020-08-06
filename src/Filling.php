<?php namespace SkeletonWindows;

/**
 * Класс заполнения
 */
final class Filling extends Inset {
	/**
	 * Пользовательские параметры заполнения
	 */
	use UserParametersTrait;

	public $isSandwich = false;

	public function __construct(Aperture $parentAperture, bool $isSandwich) {
		parent::__construct($parentAperture);

		$this->isSandwich = $isSandwich;
	}

	/**
	 * Тип заполнения
	 *
	 * Возвращает true, если заполнение является сэндвичем, и false, если заполнение является стеклопакетом
	 */
	public function getIsSandwich(): bool {
		return $this->isSandwich;
	}

	/**
	 * Смена типа заполнения
	 */
	public function setIsSandwich(bool $value): self {
		$this->isSandwich = $value;
		return $this;
	}
}