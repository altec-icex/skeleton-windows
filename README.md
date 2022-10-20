# skeleton-windows

Набор классов для создания и упаковки простых моделей окон, стеклопакетов, сэндвичей и москитных сеток.

## Установка
Установка осуществляется стандартно через менеджер пакетов.

```
composer require altec-icex/skeleton-windows
```

## Описание модели

Модель конструкции состоит из изделий, пристыкованных друг к другу слева направо.

### Изделие
Изделия основаны на прямоугольных рамах, заданных шириной и высотой (нижняя балка параллельна полу).
Верхние балки рам всех изделий конструкции лежат на одной прямой.
Каждое изделие имеет тип (окно или балконная дверь), который задаётся кодом.

Левый верхний угол изделия является началом системы координат: ось X направлена вправо, ось Y направлена вниз.

Балки рамы образуют контур, содержащий первый проём изделия.

### Проём
Проём образуется контуром балок, в него может быть установлена "вставка" и только одна.

Типы вставок:
* заполнение;
* створка;
* импост;
* группа импостов.

### Заполнение
Заполнение - это стеклопакет или сэндвич.

### Створка
Створка характеризуется типом открывания. Контур балок створки образует проём.
Допустимы следующие типы открывания:
* поворотная влево;
* поворотно-откидная влево;
* поворотная вправо;
* поворотно-откидная вправо;
* откидная;
* верхнеподвесная.

К каждой створке может быть добавлена москитная сетка.

### Импост
Импост является разделителем проёма и образует два дочерних проёма.
Балка импоста имеет ориентацию - вертикальная или горизонтальная, устанавливается в заданное местоположение - координата по оси X для вертикального импоста и по оси Y для горизонтального.

Два проёма импоста обозначаются как "левый-верхний" и "правый-нижний".

### Группа импостов
Группа импостов состоит из нескольких (N) одинаково ориентированных балок и образует несколько (N+1) проёмов.


Конструкция, изделия, створки и заполнения могут быть дополнены значениями пользовательских параметров.


### Примечания к распаковке в программе
- все элементы модели будут снабжены всеми пользовательскими параметрами со значениями по умолчанию;
- все балки будут иметь "авто" артикул профиля и армирования;
- изделия будут стыковаться через соединители, длина которых будет определена наименьшей высотой соседних изделий;
- тип ручки у створок будет выбран на основе типа изделия и типа открывания;
- ручки будут установлены в положение "авто";
- заполнения будут обрамлены штапиком.

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
// Устанавливаем пользовательский параметр изделия
$frame->setUserParameterValue('base_profile', true);

// Берём проём рамы
$aperture = $frame->getAperture();
// Вставляем в проём вертикальный импост в положение 700 мм
$impost = $aperture->insertImpost(false, 700);

// Берём левый проём импоста
$aperture = $impost->getLeftTopAperture();
// Вставляем в проём створку с типом открывания "поворотное влево"
$sash = $aperture->insertSash(SashFrame::LeftTurn);
// Устанавливаем польз. параметры створки
$sash->setUserParameterValue('micro_airing', true);
// Устанавливаем москитную сетку из системы с кодом "system_code" к створке
$mosquito = $sash->addMosquito('system_code');
// Устанавливаем польз. параметры москитной сетки
$mosquito->setUserParameterValue('anti_cat', true);
// Берём проём створки
$aperture = $sash->getAperture();
// Вставляем в проём стеклопакет
$aperture->insertFilling(false);

// Берём правый проём импоста
$aperture = $impost->getRightBottomAperture();
// Вставляем в проём стеклопакет
$filling = $aperture->insertFilling(false);
// Устанавливаем пользовательский параметр cтеклопакета
$filling->setUserParameterValue('coating', 'low_e');

// Добавляем раму изделия c типом "balcony_door" и габаритами 800 x 2000 мм
$frame = $model->add('balcony_door', 800, 2000);

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
