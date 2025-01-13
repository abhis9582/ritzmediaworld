 <!-- javascripts -->
   <script src="//code.jquery.com/jquery-1.12.4.js" ></script>
     <script src="<?=ADMIN_DIR?>js/jquery.dataTables.js" ></script>
    <!-- <script src="<?=ADMIN_DIR?>js/jquery.js"></script> -->
	<script src="<?=ADMIN_DIR?>js/jquery-ui-1.10.4.min.js"></script>
    <!--<script src="<?=ADMIN_DIR?>js/jquery-1.8.3.min.js"></script> -->
    <script type="text/javascript" src="<?=ADMIN_DIR?>js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="<?=ADMIN_DIR?>js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="<?=ADMIN_DIR?>js/jquery.scrollTo.min.js"></script>
    <script src="<?=ADMIN_DIR?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="<?=ADMIN_DIR?>assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="<?=ADMIN_DIR?>js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?=ADMIN_DIR?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?=ADMIN_DIR?>js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <<script src="<?=ADMIN_DIR?>js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="<?=ADMIN_DIR?>assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="<?=ADMIN_DIR?>js/calendar-custom.js"></script>
	<script src="<?=ADMIN_DIR?>js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="<?=ADMIN_DIR?>js/jquery.customSelect.min.js" ></script>
	<script src="<?=ADMIN_DIR?>assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="<?=ADMIN_DIR?>js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="<?=ADMIN_DIR?>js/sparkline-chart.js"></script>
    <script src="<?=ADMIN_DIR?>js/easy-pie-chart.js"></script>
	<script src="<?=ADMIN_DIR?>js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?=ADMIN_DIR?>js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?=ADMIN_DIR?>js/xcharts.min.js"></script>
	<script src="<?=ADMIN_DIR?>js/jquery.autosize.min.js"></script>
	<script src="<?=ADMIN_DIR?>js/jquery.placeholder.min.js"></script>
	<script src="<?=ADMIN_DIR?>js/gdp-data.js"></script>	
	<script src="<?=ADMIN_DIR?>js/morris.min.js"></script>
	<script src="<?=ADMIN_DIR?>js/sparklines.js"></script>	
	<script src="<?=ADMIN_DIR?>js/charts.js"></script>
	<script src="<?=ADMIN_DIR?>js/jquery.slimscroll.min.js"></script>
    
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
  $( function() {
    $( ".datepicker" ).datepicker();
	
  } );
  
  
  var dateToday = new Date();    
 $(function () {
     $(".fromdatepicker").datepicker({ 
         minDate: dateToday ,
		 dateFormat: 'yy-mm-dd'
     });
 });

 </script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

  </script>
   <script src="<?=ADMIN_DIR?>js/zd-video.js"></script>  
 