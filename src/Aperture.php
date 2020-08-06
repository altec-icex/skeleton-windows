<?php namespace SkeletonWindows;

/**
 * Класс проёма
 */
final class Aperture {
	private $inset;

	/**
	 * Возвращает вставку в проём
	 */
	public function getInset(): ?Inset {
		return $this->inset;
	}

	/**
	 * Вставка заполнения
	 *
	 * Замещает текущую вставку заполнением и возвращает его
	 */
	public function insertFilling(bool $isSandwich): Filling {
		$filling = new Filling($this, $isSandwich);
		$this->inset = $filling;
		return $filling;
	}

	/**
	 * Вставка створки
	 *
	 * Замещает текущую вставку сторкой и возвращает её
	 */
	public function insertSash(int $openType): SashFrame {
		$sash = new SashFrame($this, $openType);
		$this->inset = $sash;
		return $sash;
	}

	/**
	 * Вставка импоста
	 *
	 * Замещает текущую вставку импостом и возвращает его
	 */
	public function insertImpost(bool $isHorizontal, float $position): Impost {
		$impost = new Impost($this, $isHorizontal, $position);
		$this->inset = $impost;
		return $impost;
	}

	/**
	 * Вставка группы импостов
	 *
	 * Замещает текущую вставку группой импостов и возвращает её
	 */
	public function insertImpostGroup(bool $isHorizontal, int $quantity): ImpostGroup {
		$impostGroup = new ImpostGroup($this, $isHorizontal, $quantity);
		$this->inset = $impostGroup;
		return $impostGroup;
	}

	/**
	 * Удаление вставки
	 */
	public function removeInset(): self {
		$this->inset = null;
		return $this;
	}
}