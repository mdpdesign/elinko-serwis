<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"         => ":attribute musi zostać zaakceptowany.",
	"active_url"       => ":attribute jest nieprawidłowym adresem URL.",
	"after"            => ":attribute musi być datą późniejszą od :date.",
	"alpha"            => ":attribute może zawierać jedynie litery.",
	"alpha_dash"       => ":attribute może zawierać jedynie litery, cyfry i myślniki.",
	"alpha_num"        => ":attribute może zawierać jedynie litery i cyfry.",
	"array"            => ":attribute musi być tablicą.",
	"before"           => ":attribute musi być datą wcześniejszą od :date.",
	"between"          => array(
		"numeric" => ":attribute musi zawierać się w granicach :min - :max.",
		"file"    => ":attribute musi zawierać się w granicach :min - :max kilobajtów.",
		"string"  => ":attribute musi zawierać się w granicach :min - :max znaków.",
		"array"   => ":attribute musi składać się z :min - :max elementów."
	),
	"confirmed"        => "Potwierdzenie :attribute nie zgadza się.",
	"date"             => ":attribute nie jest prawidłową datą.",
	"date_format"      => ":attribute nie jest w formacie :format.",
	"different"        => ":attribute oraz :other muszą się różnić.",
	"digits"           => ":attribute musi składać się z :digits cyfr.",
	"digits_between"   => ":attribute musi mieć od :min do :max cyfr.",
	"email"            => "Format :attribute jest nieprawidłowy.",
	"exists"           => "Zaznaczony :attribute jest nieprawidłowy.",
	"image"            => ":attribute musi być obrazkiem.",
	"in"               => "Zaznaczony :attribute jest nieprawidłowy.",
	"integer"          => ":attribute musi być liczbą całkowitą.",
	"ip"               => ":attribute musi być prawidłowym adresem IP.",
	"max"              => array(
		"numeric" => ":attribute nie może być większy niż :max.",
		"file"    => ":attribute nie może być większy niż :max kilobajtów.",
		"string"  => ":attribute nie może być dłuższy niż :max znaków.",
		"array"   => ":attribute nie może mieć więcej niż :max elementów."
	),
	"mimes"            => ":attribute musi być plikiem typu :values.",
	"min"              => array(
		"numeric" => ":attribute musi być nie mniejszy od :min.",
		"file"    => ":attribute musi mieć przynajmniej :min kilobajtów.",
		"string"  => ":attribute musi mieć przynajmniej :min znaków.",
		"array"   => ":attribute musi mieć przynajmniej :min elementów."
	),
	"not_in"           => "Zaznaczony :attribute jest nieprawidłowy.",
	"numeric"          => ":attribute musi być liczbą.",
	"regex"            => "Format :attribute jest nieprawidłowy.",
	"required"         => "Pole :attribute jest wymagane.",
	"required_if"      => "Pole :attribute jest wymagane gdy :other jest :value.",
	"required_with"    => "Pole :attribute jest wymagane gdy :values jest obecny.",
	"required_without" => "Pole :attribute jest wymagane gdy :values nie jest obecny.",
	"same"             => "Pole :attribute i :other muszą się zgadzać.",
	"size"             => array(
		"numeric" => ":attribute musi mieć :size.",
		"file"    => ":attribute musi mieć :size kilobajtów.",
		"string"  => ":attribute musi mieć :size znaków.",
		"array"   => ":attribute musi zawierać :size elementów."
	),
	"unique"           => "Taki :attribute już występuje.",
	"url"              => "Format :attribute jest nieprawidłowy.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
		"firstname" => "Imię",
		"lastname"  => "Nazwisko",
		"email"     => "E-mail",
		"password"  => "Hasło",
		
		"accesories"    => trans('admin.message.order_accessories'),
		"client"        => trans('admin.message.order_client'),
		"client_phone"  => trans('admin.message.order_client_phone'),
		"comments"      => trans('admin.message.order_comments'),
		"description"   => trans('admin.message.order_description'),
		"ext_service"   => trans('admin.message.order_ext_service'),
		"item"          => trans('admin.message.order_item'),
		"pa_fv"         => trans('admin.message.order_document'),
		"price_netto"   => trans('admin.message.order_price_netto'),
		"serial_number" => trans('admin.message.order_serial_number'),
	),

);
