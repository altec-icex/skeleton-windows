<?php namespace SkeletonWindows;

//	version: 0,
//	frames: [{
//		width: value in mm,
//		height: value in mm,
//		fillType: [[undefined|0]|1|2],
//		openType: [undefined|0..5],
//		mosquito: [[undefined|false]|true],
//		divDir: [0|1],
//		divs: [{
//			pos: value in mm or %,
//			posType: [[undefined|0]|1]
//		}, ..],
//		apertures: [{
//			fillType,
//			openType,
//			mosquito,
//			divDir,
//			divs,
//			apertures
//		}, ..]
//	}, ..],

//	version: 1,
//	frames: [{
//		itemType: 'code', //v1
//		width: value in mm,
//		height: value in mm,
//		fillType: [[undefined|0]|1|2],
//		openType: [undefined|0..5],
//		mosquito: [[undefined|false]|true],
//		divDir: [0|1],
//		divs: [{
//			pos: value in mm or %,
//			posType: [[undefined|0]|1]
//		}, ..],
//		apertures: [{
//			fillType,
//			openType,
//			mosquito,
//			divDir,
//			divs,
//			apertures
//		}, ..]
//	}, ..],

//	version: 2,
//	frames: [{
//		itemType: 'code',
//		width: value in mm,
//		height: value in mm,
//		unitUserParameters: {}, //v2
//		fillType: [[undefined|0]|1|2],
//		fillingUserParameters: {}, //v2
//		openType: [undefined|0..5],
//		mosquito: [[undefined|false]|true],
//		sashUserParameters: {}, //v2
//		divDir: [0|1],
//		divs: [{
//			pos: value in mm or %,
//			posType: [[undefined|0]|1]
//		}, ..],
//		apertures: [{
//			fillType,
//			fillingUserParameters,
//			openType,
//			mosquito,
//			sashUserParameters,
//			divDir,
//			divs,
//			apertures
//		}, ..]
//	}, ..],
//	userParameters: {} //v2

//	version: 3,
//	frames: [{
//		itemType: 'code',
//		width: value in mm,
//		height: value in mm,
//		unitUserParameters: {}, 
//		fillType: [[undefined|0]|1|2],
//		fillingUserParameters: {}, 
//		openType: [undefined|0..5],
//		sashUserParameters: {},
//		mosquito: [[undefined|false]|true],
//		mosquitoSystem: 'code', //v3
//		mosquitoUserParameters: {}, //v3
//		divDir: [0|1],
//		divs: [{
//			pos: value in mm or %,
//			posType: [[undefined|0]|1]
//		}, ..],
//		apertures: [{
//			fillType,
//			fillingUserParameters,
//			openType,
//			sashUserParameters,
//			mosquito,
//			mosquitoSystem,
//			mosquitoUserParameters,
//			divDir,
//			divs,
//			apertures
//		}, ..]
//	}, ..],
//	userParameters: {}

/**
 * Класс упаковщика модели
 */
class ModelPacker implements ModelPackerInterface {

	/**
	 * Упаковка пользовательских параметров
	 */
	private function packUserParameters(array $userParameters): object {
		return (object) $userParameters;
	}

	/**
	 * Упаковка заполнения
	 */
	private function packFilling(Filling $filling): array{
		return array(
			'fillType' => ($filling->getIsSandwich() ? 2 : 1),
			'fillingUserParameters' => $this->packUserParameters($filling->getUserParameters())
		);
	}

	/**
	 * Упаковка створки
	 */
	private function packSash(SashFrame $sash): array{
		$pack = array(
			'openType' => $sash->getOpenType(),
			'sashUserParameters' => $this->packUserParameters($sash->getUserParameters())
		);

		$mosquito = $sash->getMosquito();
		if ($mosquito) {
			$pack['mosquito'] = true;
			$pack['mosquitoSystem'] = $mosquito->getSystemCode();
			$pack['mosquitoUserParameters'] = $this->packUserParameters($mosquito->getUserParameters());
		} else {
			$pack['mosquito'] = false;
		}

		$pack['apertures'] = array($this->packAperture($sash->getAperture()));

		return $pack;
	}

	/**
	 * Упаковка импоста
	 */
	private function packImpost(Impost $impost): array{
		$divs = array(array(
			'pos' => $impost->getPosition()
		));
		$apertures = array(
			$this->packAperture($impost->getLeftTopAperture()),
			$this->packAperture($impost->getRightBottomAperture())
		);

		$pack = array(
			'divDir' => ($impost->getIsHorizontal() ? 1 : 0),
			'divs' => $divs,
			'apertures' => $apertures
		);

		return $pack;
	}

	/**
	 * Упаковка группы импостов
	 */
	private function packImpostGroup(ImpostGroup $group): array{
		$divs = array();
		for ($i = 0; $i < $group->getBeamCount(); $i++) {
			$beam = $group->getBeam($i);
			array_push($divs, array(
				'pos' => $beam->getPosition()
			));
		}

		$apertures = array();
		for ($i = 0; $i < $group->getApertureCount(); $i++) {
			$aperture = $group->getAperture($i);
			array_push($apertures, $this->packAperture($aperture));
		}

		$pack = array(
			'divDir' => ($group->getIsHorizontal() ? 1 : 0),
			'divs' => $divs,
			'apertures' => $apertures
		);

		return $pack;
	}

	/**
	 * Упаковка проёма
	 */
	private function packAperture(Aperture $aperture): array{
		$inset = $aperture->getInset();

		switch (true) {
		case $inset instanceof Filling:
			$pack = $this->packFilling($inset);
			break;
		case $inset instanceof SashFrame:
			$pack = $this->packSash($inset);
			break;
		case $inset instanceof Impost:
			$pack = $this->packImpost($inset);
			break;
		case $inset instanceof ImpostGroup:
			$pack = $this->packImpostGroup($inset);
			break;
		default:
			$pack = array();
		}

		return $pack;
	}

	/**
	 * Упаковка рамы
	 */
	private function packFrame(UnitFrame $frame): array{
		$pack = array(
			'itemType' => $frame->getItemTypeCode(),
			'width' => $frame->getWidth(),
			'height' => $frame->getHeight(),
			'unitUserParameters' => $this->packUserParameters($frame->getUserParameters())
		);

		$pack['apertures'] = array($this->packAperture($frame->getAperture()));

		return $pack;
	}

	/**
	 * Упаковка рам изделий
	 */
	private function packFrames(Model $model): array{
		$frames = array();
		for ($i = 0; $i < $model->getUnitCount(); $i++) {
			$frame = $this->packFrame($model->getUnit($i));
			array_push($frames, $frame);
		}

		return $frames;
	}

	/**
	 * {@inheritdoc}
	 */
	public function pack(Model $model): string {
		if ($model === null) {
			return '';
		}

		$pack = array(
			'version' => 3,
			'frames' => $this->packFrames($model),
			'userParameters' => $this->packUserParameters($model->getUserParameters())
		);

		return json_encode($pack, JSON_UNESCAPED_SLASHES);
	}
}