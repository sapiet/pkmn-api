https://pokemongohub.net/post/news/pokemon-go-spawn-rate/
var id = 0; jQuery('#tablepress-6 tr').each(function(){ console.log('UPDATE pokemon SET spawn_percentage = ' + parseInt(parseFloat(jQuery(this).find('td:eq(2)').text().replace(',', '')) * 100, 10) + ' WHERE id = ' + id); id++; });
