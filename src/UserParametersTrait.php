<?php namespace SkeletonWindows;

/**
 * Расширение пользовательских параметров
 */
trait UserParametersTrait {
	private $userParameters = array();

	/**
	 * Возвращает true, если значение пользовательского параметра по имени $name было задано, иначе false
	 */
	public function hasUserParameterValue(string $name): bool {
		return array_key_exists($name, $this->userParameters);
	}

	/**
	 * Возвращает заданное значение пользовательского параметра по имени $name, если оно было задано, иначе $defautValue
	 */
	public function getUserParameterValue(string $name, $defaultValue = null) {
		return array_key_exists($name, $this->userParameters) ? $this->userParameters[$name] : $defaultValue;
	}

	/**
	 * Устанавливает значение пользовательского параметра по имени $name
	 */
	public function setUserParameterValue(string $name, $value) {
		$this->userParameters[$name] = $value;
		return $this;
	}

	/**
	 * Возвращает ассоциативный массив установленных значений пользовательских параметров
	 */
	public function getUserParameters(): array{
		return $this->userParameters;
	}
}