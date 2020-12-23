<!--Load JQuery-->
<script src="assets/themes/js/jquery.min.js"></script>
<!-- Load CSS3 Animate It Plugin JS -->
<script src="assets/themes/js/plugins/css3-animate-it-plugin/css3-animate-it.js"></script>
<script src="assets/themes/js/bootstrap.min.js"></script>

<!--Plugins-->
<script type="text/javascript" src="assets/admin/plugins/dcjqaccordion/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/admin/plugins/scrollTo/js/jquery.scrollTo.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/nicescroll/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/admin/plugins/jquery.validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="assets/admin/plugins/jquery.validation/js/additional-methods.js" type="text/javascript"></script>
<script src="assets/admin/plugins/jquery-ui/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/chosen/js/chosen.jquery.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/datatable/js/datatable.jquery1.10.10.js" type="text/javascript"></script>
<script src="assets/admin/plugins/datatable/js/datatable_bootstrap.js" type="text/javascript"></script>

<script src="assets/admin/plugins/switch/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="assets/admin/plugins/timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/daterangepicker/js/moment.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>
<script src="assets/admin/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/admin/plugins/colorpicker/js/colorpicker.js"></script>
<script src="assets/admin/plugins/colorpicker/js/jscolor.js"></script>
<script src="assets/admin/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>

<script src="assets/themes/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="assets/themes/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="assets/themes/js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--Float Charts-->
<script src="assets/themes/js/functions.js"></script>

<script src="assets/themes/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/themes/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/themes/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/themes/js/plugins/datatables/jszip.min.js"></script>
<script src="assets/themes/js/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/themes/js/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/themes/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="assets/themes/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="assets/themes/js/plugins/select2/select2.full.min.js"></script>
<script src="assets/themes/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<!--common script for all pages-->
@include("admin.partials.froala.js")
<script src="assets/admin/js/common-scripts.js"></script>
<script src="assets/admin/js/custom.js"></script>
 <script src="https://wefix-eg.com/public/assets/js/stand-alone-button.js"></script>



@if(App\Libs\Adminauth::user())

 @if(App\Libs\Adminauth::user()->id == 2)
     <script src="https://www.gstatic.com/firebasejs/5.7.2/firebase-app.js"></script>
     <script src="https://www.gstatic.com/firebasejs/5.7.2/firebase-auth.js"></script>
     <script src="https://www.gstatic.com/firebasejs/5.7.2/firebase-database.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

     <script type="text/javascript">
 $(document).ready(function(){
   var config = {
     apiKey: "AIzaSyDlWFJonyZZ8C_wiTjtX1e1t365-dpjxfI",
     authDomain: "akran-db.firebaseapp.com",
     databaseURL: "https://akran-db.firebaseio.com",
     projectId: "akran-db",
     storageBucket: "akran-db.appspot.com",
     messagingSenderId: "746441394008" ,
   };

   firebase.initializeApp(config);

   var db = firebase.database();
   db_adminRef =  db.ref('notifications/clinic/currentPatient');
   db_adminRef.endAt().limitToLast(1).on('child_added',function(snap)
   {
     var kor = snap.val();
     toastr.options = {
           "closeButton": false,
           "debug": false,
           "newestOnTop": false,
           "progressBar": true,
           "positionClass": "toast-bottom-left",
           "preventDuplicates": true,
           "rtl": true,
           "onclick": null,
           "showDuration": "300",
           "hideDuration": "1000",
           "timeOut": "5000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
     };
     var diffe = Math.abs((new Date().getTime() - new Date(kor.date).getTime())/1000);

     var link = "{{url('/ar/admin/patients/view')}}";
     console.log(diffe);

     if(diffe < 30){
       link = link+"/"+kor.current_patient_id;
       toastr.info('<a href="'+link+'" target="_blank">'+kor.current_patient+'</a>');
     }
   });
 });
 </script>
 @endif
 @endif
