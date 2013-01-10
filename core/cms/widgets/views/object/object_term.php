<div class="taxonomy_lang_<?php echo $term['lang']; ?> taxonomy_lang_wrap" id="taxonomy_<?php echo $term['id']; ?>_<?php echo $term['lang']; ?>">
<?php 
    $term_orders=ConstantDefine::getTermOrder();
?>
<div class="content-box">
        <div class="content-box-header">
        <h3><?php echo $term['name']; ?></h3>
        </div> 
        <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                  
                    <div class="list_terms">
                        <div class="list_terms_inner" id="list_terms_<?php echo $term['id']; ?>" >
                             <?php 
                             
                                            //Prepare terms name for this CAutoComplete
                                            $terms_name=array();
                                            foreach($term['terms'] as $k=>$t){
                                                $terms_name[]=$t['name'].'-'.$t['id'];
                                            }
                                            $this->widget('CAutoComplete', array(  
                                                    'name'=>'term_auto_'.$term['id'],
                                                    'data'=>$terms_name,                                                    
                                                    'multiple'=>true,
                                                    'mustMatch'=>true,
                                                    'htmlOptions'=>array('size'=>50,'class'=>'maxWidthInput','id'=>'term_auto_'.$term['id']),
                                                    'methodChain'=>".result(function(event,item){                                                            
                                                        var new_item=item.toString().split('-');                                                        
                                                        var k='item_'+new_item[new_item.length-1];                                                                                                                                                                                                                      
                                                        if(item!==undefined) {                                                            
                                                            if(\$('#list_terms_".$term['id']."').has('span[rel='+k+']')){
                                                                 var object=\$('#list_terms_".$term['id']."').children('span[rel='+k+']').clone();
                                                                 \$(object).children('input').prop('checked', true);
                                                                 \$(object).appendTo(\$('#selected_terms_".$term['id']."'));
                                                                 \$(object).children('a.term_order').show();
                                                                 \$(object).children('span.term_sep').show();
                                                                 \$('#list_terms_".$term['id']."').children('span[rel='+k+']').remove();

                                                            }

                                                            \$('#term_auto_".$term['id']."').val('');
                                                        }
                                                        

                                                    })",
                                            )); ?>
                        </div>
                    </div>
                    <div class="selected_terms">
                        <div class="selected_terms_inner" id="selected_terms_<?php echo $term['id']; ?>" ></div>
                    </div>
                   
                </div>       

        </div>
</div>

<script type="text/javascript">      
     <?php  

     //List of Terms of current Taxonomy
     echo 'var array_term_'.$term['id'].'='.json_encode($term['terms']).';'; 
          
     ?>
    //List of selected Terms         
     <?php if ((!empty($selected_terms))&&(isset($selected_terms[$key]))) : ?>
         <?php echo 'var array_selected_term_'.$term['id'].'='.json_encode($selected_terms[$key]['terms']).';'; 

         ?>
         //Create checkbox for selected terms  
         $.each(array_selected_term_<?php echo $term['id']; ?>, function(k,v) { 

                if(!$("#selected_terms_<?php echo $term['id']; ?>").children().children('#'+k).length>0){
                    var object_input=$('#selected_terms_<?php echo $term['id']; ?>').append('<span rel="'+k+'"><input value="'+v.id+'_<?php echo $term['id']; ?>_'+v.data+'" id="'+k+'" onChange="checkATerm<?php echo $term['id'];?>(\''+k+'\',this);" type="checkbox" name="terms[]" /> '+v.name+' <span class="term_sep">&#183;</span> <a class="term_order" id="link_'+k+'" href="javascript:void(0);">'+v.data_name+'</a><br/></span>');
                    $(object_input).children().children('input').prop("checked", true);
                }
         }); 
        
     <?php endif; ?>
       
     
     
     //Create checkbox for unchecked terms
     $.each(array_term_<?php echo $term['id']; ?>, function(k,v) {           
           if(!$("#selected_terms_<?php echo $term['id']; ?>").children().children('#'+k).length>0){
                $('#list_terms_<?php echo $term['id']; ?>').append('<span rel="'+k+'"><input value="'+v.id+'_<?php echo $term['id'].'_'.key($term_orders); ?>" id="'+k+'" onChange="checkATerm<?php echo $term['id'];?>(\''+k+'\',this);" type="checkbox" name="terms[]" /> '+v.name+' <span style="display:none;" class="term_sep">&#183;</span> <a style="display:none;" class="term_order" id="link_'+k+'" href="javascript:void(0);"><?php echo $term_orders[key($term_orders)]; ?></a><br/></span>');                
           }
     });      
     
     function checkATerm<?php echo $term['id'];?>(key,object){                   
             if($("#selected_terms_<?php echo $term['id']; ?>").children().children('#'+key).length>0){
                 var new_object=$(object).parent().clone();
                 $(new_object).appendTo($("#list_terms_<?php echo $term['id']; ?>"));
                 $(object).parent().empty().remove();                 
                 if($("#selected_terms_<?php echo $term['id']; ?>").html().trim()==''){                     
                     $("#selected_terms_<?php echo $term['id']; ?>").html('&nbsp;');
                 }
                 $(new_object).children('a.term_order').hide();
                 $(new_object).children('span.term_sep').hide();
             } else {                              
                 if($("#selected_terms_<?php echo $term['id']; ?>").html()=="&nbsp;"){                         
                     $("#selected_terms_<?php echo $term['id']; ?>").html("");
                 }                 
                 var new_object=$(object).parent().clone().prop("checked", false);
                 $(new_object).appendTo($("#selected_terms_<?php echo $term['id']; ?>"));                 
                 $(new_object).children('a.term_order').show();
                 $(new_object).children('span.term_sep').show();
                 $(object).parent().empty().remove();                 
             }                     
     }


</script>  
</div>

<script type="text/javascript"> 
$(function(){
    $.contextMenu({
        selector: '.term_order',
        trigger: 'left', 
        build: function($trigger, e) {
            // this callback is executed every time the menu is to be shown
            // its results are destroyed every time the menu is hidden
            // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
            return {
                callback: function(key, options) {
                    if(key=='quit'){                      
                        $(this).contextMenu('hide');
                    } else {
                        if($(this).parent().parent().hasClass('selected_terms_inner')){
                            var new_html_name=options.items[key].name;                                                    
                            var input_id=$(this).attr('id').replace('link_','');
                            var current_value=$('#'+input_id).val().toString().split('_');
                            $('#'+input_id).val(current_value[0]+'_'+current_value[1]+'_'+key);                                                                                                               
                            $(this).html(new_html_name);
                        }

                    }
                   
                },
                items: {
                       <?php 
                            $term_orders=ConstantDefine::getTermOrder();
                            foreach ($term_orders as $k=>$t):
                        ?>
                        "<?php echo $k; ?>": {name:"<?php echo $t; ?>", icon:"<?php echo $t; ?>"},                         
                        <?php endforeach; ?>                 
                        "sep1": "---------",
                        "quit": {name: "<?php echo t('cms','quit'); ?>", icon: "quit"}
                }
            };
        }
    });
});
</script>