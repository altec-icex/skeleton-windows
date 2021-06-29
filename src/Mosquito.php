<?php namespace SkeletonWindows;

/**
 * Класс москитной сетки
 */
class Mosquito {
	/**
	 * Пользовательские параметры створки
	 */
	use UserParametersTrait;
	
	private $sashFrame;
	private $systemCode;

	public function __construct(SashFrame $sashFrame, string $systemCode) {
		$this->sashFrame = $sashFrame;
		$this->systemCode = $systemCode;
	}

	/**
	 * Возвращает код системы москитной сетки
	 */
	public function getSystemCode(): string {
		return $this->systemCode;
	}

	/**
	 * Устанавливает код системы москитной сетки
	 */
	public function setSystemCode(int $value): self {
		$this->systemCode = $value;
		return $this;
	}

	/**
	 * Возвращает родителькую створку
	 */
	public function getSashFrame(): SashFrame {
		return $this->sashFrame;
	}
}