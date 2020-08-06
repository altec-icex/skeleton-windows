<?php namespace SkeletonWindows;

/**
 * Класс группы одинаково ориентированных импостов
 *
 * Импосты распологаются слева направо или сверху вниз в зависимости от ориентации
 */
final class ImpostGroup extends Inset {
	private $isHorizontal = false;
	private $beams;
	private $apertures;

	public function __construct(Aperture $parentAperture, bool $isHorizontal, int $quantity) {
		parent::__construct($parentAperture);

		$this->isHorizontal = $isHorizontal;
		$this->beams = array();
		$this->apertures = array();

		for ($i = 0; $i < $quantity; $i++) {
			array_push($this->beams, new ImpostBeam($this, $i));
		}

		for ($i = 0; $i < $quantity + 1; $i++) {
			array_push($this->apertures, new Aperture());
		}
	}

	/**
	 * Возвращает true, если импосты группы является горизонтальными, иначе false
	 */
	public function getIsHorizontal(): bool {
		return $this->isHorizontal;
	}

	/**
	 * Возвращает количество балок
	 */
	public function getBeamCount(): int {
		return count($this->beams);
	}

	/**
	 * Возвращает балку по индексу
	 */
	public function getBeam(int $index): ImpostBeam {
		return $this->beams[$index];
	}

	/**
	 * Возвращает количество проёмов
	 */
	public function getApertureCount(): int {
		return count($this->beams) + 1;
	}

	/**
	 * Возвращает проём по индексу
	 */
	public function getAperture(int $index): Aperture {
		return $this->apertures[$index];
	}
}