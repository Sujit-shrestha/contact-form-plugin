
jQuery( document ).on( "keyup" , '#cfp_form_entry_search', function( e ) {
  console.log(this.value);

  jQuery.ajax({
    url:cfp_jquery_object.ajax_url,

    data: {
      'data'   : this.value,
      'action' : 'admin_entries_search_action',
      'nonce'  : cfp_jquery_object.cfp_nonce_search
    },
    type: 'post',

    success : function ( result ) {
    jQuery("#cfp_table_entries").html( result  );
    }

  });
} );

jQuery( document ).on( "click" , '.cfp_sorting_unit' ,
function ( e ) {
  $orderby = jQuery(e.currentTarget).attr('id');
  // console.log($v);
  
  $sortstatus = jQuery(e.currentTarget).attr('sortStatus');

  if( $sortstatus == 'ASC' ){
     jQuery(e.currentTarget).attr("sortStatus", 'DESC');
  }
  else{
    $sortstatus = jQuery(e.currentTarget).attr("sortStatus", 'ASC');

  }
  $sortstatus = jQuery(e.currentTarget).attr('sortStatus');

console.log($sortstatus);

jQuery.ajax({
  url:cfp_jquery_object.ajax_url,

  DESCata: {
    'sortby'   : $sortstatus,
    'orderby'  : $orderby,
    'action' : 'admin_entries_sort_action',
    'nonce'  : cfp_jquery_object.cfp_nonce_search
  },
  type: 'post',

  success : function ( result ) {
  jQuery("#cfp_table_rows").html( result  );
  }

});
  
  
}

);
