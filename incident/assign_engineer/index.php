                <div class="form-group">
                    <label class="col-sm-4 control-label">Choose Engineer Category</label>            
                    <div class="col-sm-7">
                        <select id="engineer_specialization" class="form-control"></select>
                        <p class="help-block"></p>
                    </div>
                </div>        
                <div class="form-group" style="clear:both">
                    <label class="col-sm-4 control-label">Choose Engineer </label>            
                    <div class="col-sm-7">
                        <select id="engineer_list" class="form-control"></select>
                        <p class="help-block"></p>
                    </div>

                </div>      
                <div class="form-group" style="clear:both">
                    <label class="col-sm-4 control-label">Note for Engineer </label>            
                    <div class="col-sm-7">
                        <textarea id="engineer_note" class="form-control" placeholder="Note for Engineer"></textarea>
                        <p class="help-block"></p>
                    </div>

                </div>                                     
                <script type="text/javascript">
                    $('select#engineer_specialization').load('../lookup/specialization.php?selected=', function() {  })    

                    $('select#engineer_specialization').change(function(){
                        $('select#engineer_list').load('../lookup/engineer.php?selected='+$(this).val(), function() {  })    
                    })       
                      
                      $('#btn_assign_engineer').click('assign_engineer/assign.php',function(){
                        if ( (typeof $("#engineer_list").val() === "undefined") || ($("#engineer_list").val() === null) || ($("#engineer_list").val()=="")) {alert('Oppss!! Please choose engineer before hitting assign button');return false;};
                          $.ajax({
                            async: "false",
                            type: "POST",
                            url: "assign_engineer/assign.php",
                            data: ({
                                    case_id : $('#case_id').val(),
                                    engineer: $("#engineer_list").val() ,
                                    engineer_name: $("#engineer_list option:selected").text() ,
                                    note    : $("#engineer_note").val() 
                                  }) ,

                            success: function(auth){
                              // alert(auth)
                              if(auth=="false"){ 
                                alert('Oppss!! Unable to assign.');
                              }
                              else{
                                alert('This case is now assign to ' +  $("#engineer_list option:selected").text() );
                                $('#engineer_name').text($("#engineer_list option:selected").text());
                                $('#modal_assign_engineer').modal('hide');

                              }
                            }
                          });    

                      });                                       
                </script>