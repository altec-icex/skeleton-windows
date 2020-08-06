<?php namespace SkeletonWindows;

/**
 * Балка группы импостов
 */
final class ImpostBeam implements ImpostBeamInterface {
	private $group;
	private $index;
	private $position;

	public function __construct(ImpostGroup $group, int $index) {
		$this->group = $group;
		$this->index = $index;
		$this->position = 0;
	}

	/**
	 * Возвращает родительскую группу импостов
	 */
	public function getGroup(): ImpostGroup {
		return $this->group;
	}

	/**
	 * Возвращает индекс в родительской группе импостов
	 */
	public function getIndex(): int {
		return $this->index;
	}

	/**
	 * Возвращает родителький проём
	 */
	public function getParentAperture(): Aperture {
		return $this->group->getParentAperture();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIsHorizontal(): bool {
		return $this->group->getIsHorizontal();
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
		return $this->group->getAperture($this->index);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getRightBottomAperture(): Aperture {
		return $this->group->getAperture($this->index + 1);
	}
}