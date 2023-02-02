import $ from 'jquery';

$( "#search-form" ).hide();
$( "#search-icon" ).click(function() {
  $( "#search-form" ).toggle( "slow" );
});

