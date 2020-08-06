<?php namespace SkeletonWindows;

/**
 * Класс модели конструкции
 *
 * Все изделия являются прямоугольными и выстроеными по верхнему краю слева направо без соединителей
 */
final class Model {
	/**
	 * Пользовательские конструкции
	 */
	use UserParametersTrait;

	private $units;

	public function __construct() {
		$this->units = array();
	}

	/**
	 * Возвращает количество изделий
	 */
	public function getUnitCount(): int {
		return count($this->units);
	}

	/**
	 * Возвращает изделие по индексу
	 */
	public function getUnit(int $index): UnitFrame {
		return $this->units[$index];
	}

	/**
	 * Добавление изделия
	 *
	 * Добавляет и возвращает изделие с заданными типом, шириной и высотой
	 */
	public function add(string $itemTypeCode, float $width, float $height): UnitFrame {
		$unit = new UnitFrame($itemTypeCode, $width, $height);
		array_push($this->units, $unit);
		return $unit;
	}

	/**
	 * Добавление изделия
	 */
	public function addUnit(UnitFrame $unitFrame): self {
		array_push($this->units, $unitFrame);
		return $this;
	}

	/**
	 * Очистка списка изделий
	 */
	public function clear(): self {
		$this->units = array();
		return $this;
	}
}