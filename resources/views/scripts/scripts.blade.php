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

      var arrayTd;
      calculateAmount();
      $(".dropdown-content.select-dropdown li").on( "click", function() {
          var that = this;
          setTimeout(function(){
          if($(that).parent().hasClass('active')){
                  $(that).parent().removeClass('active');
                  $(that).parent().hide();
          }
          },100);
      });

      if ($("#otherFeeList tbody").children().length == 0) {
          $("#otherFeeList tbody").html("<tr><td colspan='4' style='text-align: center;'><em><strong> No Records Found </strong></em></td></tr>");
      }

      if ($("#courseFeeList tbody").children().length == 0) {
          $("#courseFeeList tbody").html("<tr><td colspan='5' style='text-align: center;'><em><strong> No Records Found </strong></em></td></tr>");
      }

      $('.add-item').click(function(){
        console.log(desc);
        var desc = $('#desc option:selected').text();
        var amount = $('#amount').val();

        if((desc != '') && (amount != '') && (desc != 'Select Particular')) {
          $('.items').append('<tr><td width="42%">'+desc+'</td><td>₱ '+ parseFloat(amount).toFixed(2) +'</td>' +
            '<td class>' +
              '<a href="#modal2" style="margin-right: 5%;" class="modal-trigger btn-floating waves-effect waves-light grey darken-4 edit-item">' +
                  '<i class="mdi-content-create"></i>'+
              '</a>' +
              '<a style="margin-right: 5%;" class="btn-floating waves-effect waves-light grey darken-4 delete-item">' +
                  '<i class="mdi-action-delete"></i>' +
              '</a>'+
            '</td></tr>');
        }
        calculateAmount();
      });

      

      $(document).on("click", ".delete-item", function(){
        $(this).parent().parent().remove();
        calculateAmount();
      });

      $(document).on("click", ".center-align .modal-trigger", function(){
          var amount = $(this).parent().parent().find('.amount').html();
          $('#amount').val(amount);
      });

      $(document).on('click', '.edit-item', function(e){
        e.preventDefault();
        var tr = $(this).closest('tr'); //get the parent tr
        arrayTd = $(tr).find('td'); //get data in a row
        $("#eAmount").val((arrayTd[1].textContent).trim().replace('₱ ',''));
        $("#eAmountLabel").prop('class','active');
        $('#modal2').openModal();
        
      });

      $('.delete-item').click(function(){
          $(this).parent().parent().remove();
          calculateAmount();
      });

      $('#edit-item').click(function(){
        $('.lean-overlay').hide();
        val = $('#eAmount').val();
        console.log(arrayTd[1].textContent);
        if($('#eAmount').val()){
          arrayTd[1].textContent = ('₱ ' + parseFloat($('#eAmount').val()).toFixed(2));
        }
        calculateAmount();
      });

      $(document).on("click", "#invBtn", function(e){
          e.preventDefault();
          var data='';
          var _token = $('meta[name="_token"]').attr('content');
          var _method = $('meta[name="_method"]').attr('content');
          var studentId = $('meta[name="student_id"]').attr('content');
          var invoiceId = $('meta[name="invoice_id"]').attr('content');
          var dueDate = $('#paymentDueDate').val();
          var table = $('#itemsTable tbody');
          var totalAmount = $("#amountCalc tbody tr:eq(2) td:nth-child(2)").text().replace('₱ ','');

          console.log('../../invoice' + (_method==='POST'?'':(invoiceId+'/edit')));
          if(dueDate >=  getTodaysDate()){
            table.find('tr').each(function(rowIndex, r){
              $(this).find('td').each(function (colIndex, c) {
                if(c.textContent.trim())
                  data+=( (c.textContent.replace('₱ ',''))+',');
                });
            });
            if(data){
              data = data.substring(0,data.length - 1);
              $.ajax({
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                url: '../../invoice' + (_method==='POST'?'':('/'+invoiceId)),
                type: _method,
                data: { 'data':data,
                        'student_id': studentId,
                        'total_amount': totalAmount,
                        'payment_due_date': dueDate},
                success: function(response)
                {
                  //alert(response);
                  location.href="../../invoice/"+response;
                }, error: function(xhr, ajaxOptions, thrownError){
                  alert(xhr.status);
                  alert(thrownError);
                }
              });
            }else{
              alert('Please Input data into table.');
            }
            
          }else{
            alert('Payment Due Date must be greater than or equal today');
          }
          
          
      });

      function getTodaysDate(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        } 

        today = mm+'/'+dd+'/'+yyyy;
        return today;
      }

      function calculateAmount(){
        var grandtotal = 0;
        var subTotal = 0;
        var vatTotal = 0;
        //Get all amount in the table
        $("#itemsTable tbody td:nth-child(2)").each(function() {
          grandtotal += parseFloat($(this).text().replace('₱ ',''));
        });
        vatTotal = (grandtotal*.12).toFixed(2);
        subTotal = (grandtotal-vatTotal).toFixed(2);
        //Putting the total amount in another table for viewing
        $("#amountCalc tbody tr:eq(0) td:nth-child(2)").text('₱ ' + subTotal);
        $("#amountCalc tbody tr:eq(1) td:nth-child(2)").text('₱ ' + vatTotal);
        $("#amountCalc tbody tr:eq(2) td:nth-child(2)").text('₱ ' + grandtotal.toFixed(2));
        $("#totDue").text('₱ ' + grandtotal.toFixed(2));
      }

      $(document).on('click', '.add-entry', function(){
        var selectOptionVal = $('meta[name="account-list"]').attr('content');
        var jsonParse = JSON.parse(selectOptionVal);
        var isDuplicate = checkIfDuplicate();
        if(isDuplicate){
          alert(isDuplicate)
        }else{
          $('.journal-entries tbody').append(
            '<tr>' +
               '<td>' +
                  '<select name="drcr" id="">' +
                     '<option value="1">Debit</option>' +
                     '<option value="2">Credit</option>' +
                  '</select>' +
               '</td> ' +
               '<td>' +
                  '<select class="select-dropdown" name="account_title" id="">' +
                  '</select>' +
               '</td>' +
               '<td style="width: 20%;">' +
                  '<div class="input-field" id="textarea-input-field">' +
                     '<textarea class="materialize-textarea" name="" id="desc" cols="30" rows="10"></textarea>' +
                     '<label for="">Description</label>' +
                  '</div>' +
               '</td>' +
               '<td>' +
                  '<div class="input-field">' +
                     '<input type="number" min="0" step="0.01" id="dr-amt" value="0.00">' +
                     '<label for="" class="active">Amount</label>' +
                  '</div>' +
               '</td>' +
               '<td>' +
                  '<div class="input-field">' +
                     '<input type="number" id="cr-amt" value="0.00" disabled="disabled">' +
                     '<label for="cr-amt" class="active">Amount</label>' +
                  '</div>' +
               '</td>' +
               '<td>' +
                  '<a class="waves-effect waves-light btn red add-entry">Add</a>' +
                  '<a class="waves-effect waves-light btn red delete-entry">Delete</a>'+
               '</td>' +
            '</tr>'
          );
          

          $('.journal-entries tr:last td').each(function(){
            console.log('last table');
            var selectTitle = $(this).find('select');
            if(selectTitle.attr('name')){
              if(selectTitle.attr('name') == 'account_title'){
                for(var i = 0; i < jsonParse.length; i++) {
                  selectTitle.append($('<option>',{
                    value: jsonParse[i]['id'],
                    text: jsonParse[i]['account_title_name']
                  }));
                }
              }
            }
          });

          $("select[name='drcr']").on('change',function(){
            var drInput = $(this).closest('tr').find("td #dr-amt");
            var crInput = $(this).closest('tr').find("td #cr-amt");
            if($(this).val() == '1'){
              drInput.attr('disabled',false);
              crInput.attr('disabled',true);
            }else{
              drInput.attr('disabled',true);
              crInput.attr('disabled',false);
            }
            drInput.val('0.00');
            crInput.val('0.00');
          });

          $('select').material_select();
        }

        $('.delete-entry').click(function(){
          $(this).parent().parent().remove();
        });
        
      });

      $("select[name='drcr']").on('change',function(){
        var drInput = $(this).closest('tr').find("td #dr-amt");
        var crInput = $(this).closest('tr').find("td #cr-amt");
        if($(this).val() == '1'){
          drInput.attr('disabled',false);
          crInput.attr('disabled',true);
        }else{
          drInput.attr('disabled',true);
          crInput.attr('disabled',false);
        }
        drInput.val('0.00');
        crInput.val('0.00');
      });

      /*
       * @author:        Kristopher Veraces
       * @description:   Validation in Journal 
                            -Checks if duplicated account title is inputted
                            -Checks if credit or debit amount in not zero
       */
      function checkIfDuplicate(){
        var accountTitles =  [];
        var tAccountTitle = NaN;
        var is_duplicate = NaN;
        var amount = 0;
        $('.journal-entries tbody').find('tr').each(function(rowIndex, r){
           amount = 0;
           $(this).find('td ').each(function (colIndex, c) {
              var selectAccountTitle = $(this).find("select");
              var input = $(this).find("input:enabled");
              if(input.attr('type')==='number' && amount==0){
                 amount = input.val() == ''?0:input.val();
              }
              // console.log(amount);
              if(selectAccountTitle.attr('name')=='account_title'){
                 tAccountTitle = selectAccountTitle.val();
              }
              
           });
           
           if(amount <= 0){
              is_duplicate = 'CR/DR amount must be greater than zero';
              return true;
           }

           if(tAccountTitle){
              if($.inArray(tAccountTitle,accountTitles) != -1){
                 is_duplicate = 'Duplicate Account Title Detected';
                 return true;
              }else{
                 accountTitles.push(tAccountTitle);
              } 
           }
        });
        return is_duplicate;
      }

      $("#sbmt_jour_entry").click(function(e){
        e.preventDefault;
        var data= '';
        var isDup = checkIfDuplicate();
        var _token = $('meta[name="csrf-token"]').attr('content');
        if(isDup){
          alert(isDup);
        }else{
          $(".journal-entries tbody tr td").each(function() {
            var input = $(this).find("input:enabled");
            var select = $(this).find('select');
            var textArea = $(this).find('textarea');

            if(select.attr('name')){
              data += (select.val() + ',');
            }

            if(textArea.attr('id')){
              data += (textArea.val() + ',');
            }

            if(input.attr('type')=='number'){
              data += (input.val() + ',');
            }
          });
          data = data.slice(0,-1);
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': _token
            },
            url: '/journal/create',
            type: 'POST',
            data: {'data':data},
            success: function(response)
            {
                alert(response);
                //location.href="/account";
            }, error: function(xhr, ajaxOptions, thrownError){
              alert(xhr.status);
              alert(thrownError);
            }
          });
        }
      });
  });


</script>