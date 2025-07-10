<?php
if (isset($this->session->userdata['logged_in'])) {
$role_id = $this->session->userdata['logged_in']['role_id'];
//echo $username;exit;
}?>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>  -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url()."assets/"; ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/select2/select2.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/select2/select2.min.js"></script>

<script src="<?php echo base_url()."assets/"; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url()."assets/"; ?>plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url()."assets/"; ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/adminlte.js"></script>
<!-- <script src="<?php echo base_url()."assets/"; ?>plugins/chartjs-old/Chart.min.js"></script> -->
<!-- FastClick -->
<script src="<?php echo base_url()."assets/"; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php //echo base_url()."assets/"; ?>dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/demo.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/chartjs-old/Chart.min.js"></script>
<!-- <script src="<?php echo base_url()."assets/"; ?>plugins/flot/jquery.flot.min.js"></script> 
 <script src="<?php echo base_url()."assets/"; ?>plugins/flot/jquery.flot.resize.min.js"></script> 
 <script src="<?php echo base_url()."assets/"; ?>plugins/flot/jquery.flot.pie.min.js"></script> 
 <script src="<?php echo base_url()."assets/"; ?>plugins/flot/jquery.flot.categories.min.js"></script> --> 


<script type="text/javascript">
    $(document).ready(function() {
  $(".select2").select2();
  //$(".date-picker").datepicker();
   $(".date-picker").datepicker({
        format: "dd-mm-yyyy",
        
        autoclose: true
    });
});
</script>
<script type="text/javascript">
  $(function () {
    // $("#example1").DataTable();
     $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
       "scrollX": true
    });
  });
</script>
<script type="text/javascript">
  $(function () {
   
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      // "ordering": false,
      "info": false,
       "scrollX": true
    });
  });
</script>

<script type="text/javascript">
  
  $(document).on('change','.mobile' , function(){
    
        if(!$('.mobile').val().match('[0-9]{10}')== true)  {
            alert("Please put 10 digit mobile number");
            $(this).val('');
            return true;
        }
    });
   $(document).on('change','.aadhaar_no' , function(){
        if(!$('.aadhaar_no').val().match('[0-9]{12}')== true)  {
            alert("Please put 12 digit Aadhaar Number, no white space allowed");
            $(this).val('');
            return true;
        } 
    });
   /* $(document).on('change','.gst_no1' , function(){
        if(!$('.gst_no1').val().match('[0-9]{2}')== true)  {
            alert("Please put 2 digit state code");
            $(this).val('');
            return true;
        }
    });*/

    // $(document).on('change','.email',function(){
    //   var emailtext=$(this).val();
    //       var reg = /^([A-Za-z0-9_\-\.])+\([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    //       if (reg.test(emailtext) == false) 
    //       {
    //           alert('Invalid Email Address');
    //           $(this).val('');
    //           return false;
    //       }else{
    //       return true;
    //     }
    // });
     $(document).on('change','.pan_no',function(){
      var pan_no=$(this).val();
          var reg = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
          if (reg.test(pan_no) == false) 
          {
              alert('Invalid PAN Number');
              $(this).val('');
              return false;
          }else{
          return true;
        }
    });
     $(document).on('change','.tan_number',function(){
          var tan_number=$(this).val();
          var reg = /[A-z]{4}\d{5}[a-zA-Z]{1}/; 
          if (reg.test(tan_number) == false) 
          {
              alert('Invalid TAN Number');
              $(this).val('');
              return false;
          }else{
          return true;
        }
    });
     $(document).on('change',".gstnumber", function(){    
        var inputvalues = $(this).val();
        var gstinformat = new RegExp('^[0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9]{1}[a-zA-Z]{2}$');
        if (gstinformat.test(inputvalues)) {
           return true;
          } else {
              alert('Please Enter Valid GSTIN Number');
              $(".gstnumber").val('');
              $(".gstnumber").focus();
          }
      });
   //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    var url = window.location; 
   
    $('ul.flex-column li.nav-item a').filter(function() {
      return this.href == url;
    }).closest('li.nav-item a').addClass('active');

     $('ul.flex-column li.nav-item a').filter(function() {
      return this.href == url;
    }).parentsUntil(".flex-column > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');


// var i = 0;
// function change() {
//   var doc = document.getElementById("about_ago");
//   var color = ["purple", "#17a2b8", "sky", "green","#dc7629 "];
//   doc.style.backgroundColor = color[i];
//   i = (i + 1) % color.length;
// }
// setInterval(change, 1000);

setTimeout(function() {
 <?php unset($_SESSION['success']);unset($_SESSION['failed']); ?>
  $('.alert-dismissible').fadeOut('fast');
}, 2000); // <-- time in milliseconds

</script>
<!-- <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','Decemeber'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [8, 59, 80, 81, 56, 55, 40,44,67,89,90,34]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90,34,56,78,90,12]
        },  
        {
          label               : ' Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [32, 48, 40, 19, 86, 27, 90,34,56,78,90,12]
        },
        {
          label               : ' profit',
          fillColor           : 'red',
          strokeColor         : 'red',
          pointColor          : 'red',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [89, 48, 40, 19, 86, 27, 90,34,56,78,90,12]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 700,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Chrome'
      },
      {
        value    : 500,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'IE'
      },
      {
        value    : 400,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'FireFox'
      },
      {
        value    : 600,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Safari'
      },
      {
        value    : 300,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Opera'
      },
      {
        value    : 100,
        color    : '#d2d6de',
        highlight: '#d2d6de',
        label    : 'Navigator'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script> -->