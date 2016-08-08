<!-- ================================================
Scripts
================================================ -->
<!-- jQuery Library -->
<script type="text/javascript" src="{{ URL::asset('js/plugins/jquery-1.11.2.min.js')}}"></script>
<!--materialize js-->
<script type="text/javascript" src="{{ URL::asset('js/materialize.js')}}"></script>
<!--prism -->
<script type="text/javascript" src="{{ URL::asset('js/prism/prism.js')}}"></script>
<!--scrollbar-->
<script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<!-- data-tables -->
<script type="text/javascript" src="{{ URL::asset('js/plugins/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/plugins/data-tables/data-tables-script.js')}}"></script>
<!-- chartist -->
<script type="text/javascript" src="{{ URL::asset('js/plugins/chartist-js/chartist.min.js')}}"></script>

<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="{{ URL::asset('js/plugins.js')}}"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="{{ URL::asset('js/custom-script.js')}}"></script>
<script type="text/javascript">
  /*Show entries on click hide*/
  $(document).ready(function(){
      $(".dropdown-content.select-dropdown li").on( "click", function() {
          var that = this;
          setTimeout(function(){
          if($(that).parent().hasClass('active')){
                  $(that).parent().removeClass('active');
                  $(that).parent().hide();
          }
          },100);
      });

      $('.add-item').click(function(){
        var desc = $('#desc option:selected').text();
        var amount = $('#amount').val();
        console.log(desc);
        if((desc != '') && (amount != '')) {
          $('.items').append('<tr>'+
                             '<td>'+desc+'</td>'+
                             '<td>₱ '+amount+'</td>'+
                             '<td>' +
                             '<a href="#modal2" style="margin-right: 5%;" class="modal-trigger btn-floating waves-effect waves-light grey darken-4"> <i class="mdi-content-create"></i> </a>' +
                             '<a style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4 delete-item"><i class="mdi-action-delete"></i></a>'+
                             '</td>'+
                             '</tr>');
        }
      });

      $('.delete-item').click(function(){
        $(this).parent().parent().remove();
      });
  });
</script>