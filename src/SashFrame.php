<?php namespace SkeletonWindows;

/**
 * Класс створки
 */
final class SashFrame extends Inset {
	/**
	 * Пользовательские параметры створки
	 */
	use UserParametersTrait;

	/**
	 * Поворотная влево
	 */
	const LeftTurn = 0;
	/**
	 * Поворотно-откидная влево
	 */
	const LeftTurnAndTilt = 1;
	/**
	 * Поворотная вправо
	 */
	const RightTurn = 2;
	/**
	 * Поворотно-откидная вправо
	 */
	const RightTurnAndTilt = 3;
	/**
	 * Откидная
	 */
	const Tilt = 4;
	/**
	 * Верхнеподвесная
	 */
	const TopHung = 5;

	private $openType;
	private $mosquito = false;
	private $aperture;

	public function __construct(Aperture $parentAperture, int $openType) {
		parent::__construct($parentAperture);

		$this->openType = $openType;
		$this->aperture = new Aperture();
	}

	/**
	 * Возвращает тип открывания
	 */
	public function getOpenType(): int {
		return $this->openType;
	}

	/**
	 * Устанавливает тип открывания
	 */
	public function setOpenType(int $value) {
		$this->openType = $value;
		return $this;
	}

	/**
	 * Признак наличия москитной сетки
	 *
	 * Возвращает true, если створке нужна москитная сетка, иначе false
	 */
	public function getMosquito(): bool {
		return $this->mosquito;
	}

	/**
	 * Устанавливает наличие москитной сетки
	 */
	public function setMosquito(bool $value) {
		$this->mosquito = $value;
		return $this;
	}

	/**
	 * Возвращает проём створки
	 */
	public function getAperture(): Aperture {
		return $this->aperture;
	}
}