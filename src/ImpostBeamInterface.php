<?php namespace SkeletonWindows;

/**
 * Интерфейс балки импоста
 */
interface ImpostBeamInterface {
	/**
	 * Ориентация импоста
	 *
	 * Возвращает true, если импост является горизонтальным, иначе false
	 */
	public function getIsHorizontal(): bool;

	/**
	 * Возвращает местоположение балки от левого или верхнего края родительского проёма в зависимости от ориентации импоста
	 */
	public function getPosition(): float;

	/**
	 * Возвращает левый-верхний прилегающий проём
	 */
	public function getLeftTopAperture(): Aperture;

	/**
	 * Возвращает правый-нижний прилегающий проём
	 */
	public function getRightBottomAperture(): Aperture;
}