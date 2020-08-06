<?php namespace SkeletonWindows;

/**
 * Класс рамы изделия
 */
final class UnitFrame {
	/**
	 * Пользовательские изделия
	 */
	use UserParametersTrait;

	private $itemTypeCode;
	private $width;
	private $height;
	private $aperture;

	public function __construct(string $itemTypeCode, float $width, float $height) {
		$this->itemTypeCode = $itemTypeCode;
		$this->width = $width;
		$this->height = $height;
		$this->aperture = new Aperture();
	}

	/**
	 * Возвращает код типа изделия
	 */
	public function getItemTypeCode(): string {
		return $this->itemTypeCode;
	}

	/**
	 * Устанавливает код типа изделия
	 */
	public function setItemTypeCode(string $value): self {
		$this->itemTypeCode = $value;
		return $this;
	}

	/**
	 * Возвращает ширину рамы
	 */
	public function getWidth(): float {
		return $this->width;
	}

	/**
	 * Устанавливает ширину рамы
	 */
	public function setWidth(float $value) {
		$this->width = $value;
		return $this;
	}

	/**
	 * Возвращает высоту рамы
	 */
	public function getHeight(): float {
		return $this->height;
	}

	/**
	 * Устанавливает высоту рамы
	 */
	public function setHeight(float $value) {
		$this->height = $value;
		return $this;
	}

	/**
	 * Возвращает проём рамы
	 */
	public function getAperture(): Aperture {
		return $this->aperture;
	}
}