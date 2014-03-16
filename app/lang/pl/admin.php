<?php

return array(
    /*
      |--------------------------------------------------------------------------
      | Lokalizacja opisow w panelu administracyjnym
      |--------------------------------------------------------------------------
      |
      |
      |
     */

    'message' => array(
        'appname'                     => 'Serwis Elinko',
		'app_settings'					=> 'Ustawienia aplikacji',
		'switch_nav'					=> 'Przełącz nawigację',
		'show_orders'					=> 'Pokaż zlecenia:',
		'show_all'						=> 'Rozwiń wszystkie',
		'hide_all'						=> 'Zwiń wszystkie',
		'statistics'					=> 'Statystyki:',
		'show_statistics'				=> 'Pokaż statystyki',
		'settings'						=> 'Ustawienia',
		'logout'						=> 'Wyloguj',
		'app_credits'					=> 'Projekt i wykonanie <a href="http://www.mdpdesign.pl">mdpdesign.pl</a> &copy; :date',
		
		'actual_date'					=> 'Aktualna data',
		'manage_users'					=> 'Zarządzaj Użytkownikami',
		'add_new_user'					=> 'Dodaj Użytkownika',
		
		'search_results'				=> 'Wyniki wyszukiwania dla słowa: ":search"',
        
		'contact_administrator'       => 'Wystąpił błąd skontaktuj się z administratorem: marek@mdpdesign.pl',
        'page_title'                  => 'Serwis Elinko - panel administracyjny',
        'edit_user'                   => 'Edytuj dane użytkownika',
        'logged_as'                   => 'Zalogowany jako: ',
        'user_firstname'              => 'Imię:',
        'user_lastname'               => 'Nazwisko:',
        'user_email'                  => 'E-mail:',
        'new_password'                => 'Nowe / obecne hasło:',
        'user_updated_at'             => 'Ostatnia aktualizacja danych:',
        'cannot_edit_other_user'      => 'Nie możesz edytować danych innego Użytkownika! Nie ładnie...',
        'user_data_changed_success'   => 'Dane użytkownika zostały zmienione poprawnie',
        'by_user'                     => 'przez Użytkownika:',
        
		'order_show_title'            => 'Zlecenie',
        'order_show_last_edited'      => 'Ostatnia edycja: ',
		
		'order_add_new'				=> 'Dodaj nowe zlecenie',
		'order_fill_all_fields'				=> 'Uzupełnij wszystkie pola',
		
        'order_show'                  => 'Pokaż szczegóły zlecenia',
        'order_added'                 => 'Nowe zlecenie dodane poprawnie.',
        'order_updated'               => 'Zlecenie zapisane poprawnie',
        'order_delete_success'        => 'Zlecenie usunięte poprawnie',
        'order_delete_title_single'   => 'Potwierdź usunięcie zlecenia: :rma',
        'order_delete_message_single' => 'Zamierzasz usunąć zlecenie :rma, ta operacja jest nieodwracalna i nie ma możliwości przywrócenia zlecenia.<br /><br /><strong>Potwierdź operację lub anuluj.</strong>',
        'order_delete_title'          => 'Potwierdź usunięcie zlecenia',
        'order_delete_message'        => 'Zamierzasz usunąć zlecenie, ta operacja jest nieodwracalna i nie ma możliwości przywrócenia zlecenia.<br /><br /><strong>Potwierdź operację lub anuluj.</strong>',
        'order_list'                  => 'Lista zleceń',
        'order_list_empty'            => 'Lista zleceń jest pusta.',
        'order_id'                    => 'ID',
        'order_status'                => 'Status',
        'order_creator'               => 'Przyjmujący zlecenie',
        'order_created_by'            => 'Utworzono nowe zlecenie przez: ',
        'order_modified_by'           => 'Modyfikacja zlecenia przez: ',
        'order_rma'                   => 'Numer RMA',
        'order_item'                  => 'Sprzęt',
        'order_client'                => 'Klient',
        'order_client_phone'          => 'Telefon',
        'order_branch'                => 'Oddział',
        'order_edit'                  => 'Edycja',
        'order_details'               => 'Szczegóły',
        'order_serial_number'         => 'Numer seryjny',
        'order_document'              => 'Dokument',
        'order_ext_service'           => 'Serwis zew.',
        'order_price_netto'           => 'Cena netto',
        'order_price_brutto'          => 'Cena brutto',
        'order_price_netto_currency'  => 'zł',
        'order_description'           => 'Opis zlecenia',
        'order_diagnose'              => 'Diagnoza / wykonane czynności',
        'order_comments'              => 'Uwagi do zlecenia',
        'order_accessories'           => 'Dołączone akcesoria',
		
        'linklabels' => array(
            'orders_home'      => 'Zlecenia',
            'orders_home_list' => 'Lista zleceń',
            'orders_add'       => 'Dodaj zlecenie',
            'orders_edit'      => 'Edytuj zlecenie',
            'orders_delete'    => 'Usuń zlecenie',
        ),
		
        'placeholders' => array(
            'user_firstname_pl'      => 'Twoje imię',
            'user_lastname_pl'       => 'Twoje Nazwisko',
            'user_email_pl'          => 'Twój E-mail',
            'new_password_pl'        => 'Twoje Nowe / obecne hasło',
            'order_item_pl'          => 'Wpisz co to za sprzęt, marka / model itp.',
            'order_client_pl'        => 'Imię i nazwisko Klienta',
            'order_client_phone_pl'  => '32-211-11-11 lub 600-300-200',
            'order_branch_pl'        => 'Oddział w którym przyjęte zostało zlecenie',
            'order_serial_number_pl' => 'Wpisz numer seryjny urządzenia, jeśli jest',
            'order_document_pl'      => 'Dokument sprzedaży Klienta',
            'order_ext_service_pl'   => 'Serwis zewnętrzny, jeśli trzeba',
            'order_price_netto_pl'   => 'Netto',
            'order_price_brutto_pl'  => 'Brutto',
            'order_description_pl'   => 'Wpisz możliwie dokładny opis uszkodzenia / zlecenia',
            'order_diagnose_pl'      => 'Wpisz diagnozę / wykonane czynności',
            'order_comments_pl'      => 'Wpisz uwagi do zlecenia',
            'order_accessories_pl'   => 'Wpisz dołączone akcesoria do sprzętu',
        ),
		
        'buttons' => array(
			'show'         => 'Pokaż',
            'edit'         => 'Edytuj',
            'save'         => 'Zapisz',
            'delete'       => 'Usuń',
            'cancel'       => 'Anuluj',
            'close'        => 'Zamknij',
            'back'         => 'Wstecz',
            'back_to_list' => 'Powrót do listy',
        ),
    ),
);
