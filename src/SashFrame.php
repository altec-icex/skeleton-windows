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
	private $mosquito;

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
	public function setOpenType(int $value): self {
		$this->openType = $value;
		return $this;
	}

	/**
	 * Возвращает москитную сетку
	 */
	public function getMosquito(): ?Mosquito {
		return $this->mosquito;
	}

	/**
	 * Вставка москитной сетки
	 * 
	 * Добавляет москитную сетку и возвращает её
	 */
	public function addMosquito(string $systemCode): Mosquito {
		$this->mosquito = new Mosquito($this, $systemCode);
		return $this->mosquito;
	}

	/**
	 * Удаление москитной сетки
	 */
	public function removeMosquito(): self {
		$this->mosquito = null;
		return $this;
	}

	/**
	 * Возвращает проём створки
	 */
	public function getAperture(): Aperture {
		return $this->aperture;
	}
}