
$('.admin-tooltip').tooltip();
$('.rma-link').tooltip();

$( '.btn-details' ).click(function() {
	$(this).parents('tr').toggleClass('info');
});

$( ".warning" ).focus(function() {
    $(this).removeClass('warning');
});

$( '.btn-delete-order' ).click(function() {
    var value = $(this).attr('data-order-id');
    var $deleteForm = $('#form-delete-confirm');
    var location = window.location;
    $deleteForm.find('#order-to-delete').attr('value', value);
    $deleteForm.attr('action', location+'/'+value);
});

// Funkcjonalnosc Checkboxa Zaznacz wszystkie
$('#check-all').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});

if ($('.collapsible-details').length > 0)
{
	var $open = $( '.open-all' );
	var $close = $( '.close-all' );
	var $collapsible = $('.collapsible-details');

	$collapsible.collapse({
		'toggle': false
	});

	$open.parent().removeClass('disabled');
	$close.parent().removeClass('disabled');

	$open.click(function(event) {
		var $collapsible = $('.collapsible-details');
		var $tableHeading = $('.rma-table-heading');
		$tableHeading.addClass('info');
		$collapsible.collapse('show');
		event.preventDefault();
	});

	$close.click(function(event) {	
		var $collapsible = $('.collapsible-details');
		var $tableHeading = $('.rma-table-heading');
		$tableHeading.removeClass('info');
		$collapsible.collapse('hide');
		event.preventDefault();
	});
}
else
{

	var $open = $( '.open-all' );
	var $close = $( '.close-all' );

	$open.parent().addClass('disabled');
	$close.parent().addClass('disabled');

	$('.open-all, .close-all').click(function(event) {
		event.preventDefault();
	});
}

// SORTOWANIE TABELI ZLECEN
$('.status-order').change(function(e) {
	window.location.href = '/admin/orders?orderBy=' + $(this).val();
});