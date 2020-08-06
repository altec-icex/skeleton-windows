# skeleton-windows


## Пример использования
```php
use SkeletonWindows\Model;
use SkeletonWindows\SashFrame;
use SkeletonWindows\ModelPacker;

// Создаём новую модель
$model = new Model();
$model->setUserParameterValue('installation', true);

// Добавляем раму изделия c типом "window" и габаритами 1400 x 1400 мм
$frame = $model->add('window', 1400, 1400);
$frame->setUserParameterValue('base_profile', true);

// Берём проём рамы
$aperture = $frame->getAperture();
// Вставляем в проём вертикальный импост в положение 700 мм
$impost = $aperture->insertImpost(false, 700);

// Берём левый проём импоста
$aperture = $impost->getLeftTopAperture();
// Вставляем в проём створку с типом открывания "поворотное влево"
$sash = $aperture->insertSash(SashFrame::LeftTurn);
// Устанавливаем москитную сетку к створке
$sash->setMosquito(true);
$sash->setUserParameterValue('micro_airing', true);
// Берём проём створки
$aperture = $sash->getAperture();
// Вставляем в проём стеклопакет
$aperture->insertFilling(false);

// Берём правый проём импоста
$aperture = $impost->getRightBottomAperture();
// Вставляем в проём стеклопакет
$filling = $aperture->insertFilling(false);
$filling->setUserParameterValue('coating', 'low_e');

// Добавляем раму изделия c типом "door" и габаритами 800 x 2000 мм
$frame = $model->add('door', 800, 2000);

// Берём проём рамы
$aperture = $frame->getAperture();
// Вставляем в проём створку с типом открывания "поворотное вправо"
$sash = $aperture->insertSash(SashFrame::RightTurn);

// Берём проём створки
$aperture = $sash->getAperture();
// Вставляем в проём горизонтальный импост в положение 1400 мм
$impost = $aperture->insertImpost(true, 1400);

// Берём верхний проём импоста
$aperture = $impost->getLeftTopAperture();
// Вставляем в проём стеклопакет
$aperture->insertFilling(false);

// Берём нижний проём импоста
$aperture = $impost->getRightBottomAperture();
// Вставляем в проём сэндвич
$filling = $aperture->insertFilling(true);


// Создаём упаковщика модели
$packer = new ModelPacker();

// Запаковываем модель для api
$pack = $packer->pack($model);

// Посмотрим, что получилось
echo '<pre>' . json_encode(json_decode($pack), JSON_PRETTY_PRINT) . '</pre>';
```
