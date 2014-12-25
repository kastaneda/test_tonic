
Привет. Меня зовут Дмитрий Колесников.

Некоторое время назад со мной связалась Виктория Кудина, рекрутер
компании Tonic, и предложила выполнить тестовое задание в рамках
собеседования на позицию программиста.

Сейчас я решил попробовать сделать это тестовое задание.

-----

Priority 1

 * ~~Добавить кастомные поля (nameFirst, nameLast) в форму регистрации~~
 * ~~Добавить поле referral code~~
    - ~~генерация кодов~~ при сохранении новых пользователей (как правильно?)
 * ~~Создать лог переходов по реф. ссылке~~
    - ~~DK/Referral/Entity/LogEntry~~
    - ~~глобальное правило в роутинге (как это сделать в sf2?)~~
    - сохранять не integer из cookie, а связь между LogEntry и User! (на каком уровне? контроллер?)

Priority 2

 * Улучшить внешний вид
    - ~~включить Navbar с каким-нибудь меню~~
    - добавить в Navbar форму логина (для неавторизированных пользователей)
    - username, ссылка на profile и кнопка logout (для авторизированных)
    - ~~разобраться, почему не появляется class="form-horizontal" в form~~

Priority 3

 * i18n (в первую очередь убрать hard-coded строки из кода)
 * Покрыть unit-тестами
 * Сделать функциональные тесты

-----

Так, формально всё должно соответствовать, хотя я результатом недоволен.
Кое-как кое-что работает, конечно.

За девять часов я прочитал много документации, наступил на много граблей,
впервые встретился с FOSUserBundle. Это само по себе достаточно интересно.

Но, пожалуй, такие тестовые задания не для меня.

-----

Привет, мир! Пожалуй, предыдущая реализация оставила чувство незавершённости.
Надо всё это добро немного причесать, сделать красивую картинку, убрать два
реально плохих момента в коде (с генерацией рефкода и с сохранением ссылки
на строку в истории хитов рефкодов).

Может быть, я даже тесты нарисую. Тесты — это очень прикольно, хоть и хлопотно.

Значит, так. Краткий план действий на ближайшие несколько часов.

 * Раз уж я всё это вывалил на GitHub, то надо пользоваться его возможностями.
   Сейчас напишу вот этот вот список требований, а после этого перенесу его
   в Issues проекта.
 * Проекту определённо нужна живая демонстрация. Сейчас у меня есть только
   домашний сервер. (Людям, которые имеют отношение к этому тестовому заданию,
   если они действительно будут это читать: у меня когда-то был свой небольшой
   бизнес, скромный такой хостинг на скромном (но своём) 1U сервере в ДЦ у
   одного провайдера). Короче, надо на домашнем сервере запилить отдельный
   сайтец под это дело.
 * Сделать автоматические билды.
 * Проект надо причесать визуально.
    - Тестовое задание как отдельная страница
    - Форма логина в navbar'е
    - Сделать так, чтобы нигде не торчали огрызки недо-i18n
 * Проект надо причесать внутренне.
    - Нормальные связи между сущностями
    - Надёжная и адекватная генерация рефкода (и протестировать!)
 * Запланировать реализацию тестов.

Поехали!

