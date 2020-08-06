<?php namespace SkeletonWindows;

/**
 * Общий интерфейс упаковщиков модели
 */
interface ModelPackerInterface {
	/**
	 * Возвращает сериализованное представление модели
	 */
	public function pack(Model $model): string;
}