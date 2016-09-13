
require(['core/first'], function() {
    require(['jquery','theme_shoelace/bootstrap', 'theme_shoelace/anti_gravity', 'core/log', 'theme_shoelace/jquery.dataTables'], function($,bootstrap, ag, log, datatables) {
        log.debug('Shoelace JavaScript initialised');
        //run the frontpage slider if its there
        $('#myCarousel').carousel();
        
        //transform tables beautifully. specifically the course search table on front page
        $('.shoelace_datatable').DataTable({
        	"autoWidth": true,
        	"order": [[ 0, "desc" ]]	
        });
    });
});
