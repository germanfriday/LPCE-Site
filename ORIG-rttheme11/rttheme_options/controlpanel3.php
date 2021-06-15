<?php
$options3 = array (
		/*portfolio*/
		array(
				"name" => "Select Your Portfolio Page",
				"id" => $shortname."_portf_page",
				"options" => $rt_getpages,
				"type" => "select"),

		/*portfolio start category*/
		array(
				"name" => "Select Portfolio Start Category",
				"desc" => "If you don't select a category the product start page will display all products.",
				"id" => $shortname."_portf_start_cat",
				"options" => $rt_getportfterm,
				"type" => "select"), 

		array(  "name" => "Don't Show Portfolio Items On Start Page",
				"desc" => "Check this box if you don't want to show portfolio items when clicked your portfolio start page on navigation bar.",
				"id" => $shortname."_portf_first_page_hide",
				"type" => "checkbox",
				"std" => "false"),
 		
		array(
				"name" => "Don't show portfolio categories on single portfolio item's sidebar",
				"id" => $shortname."_portfolio_hide_categories",
				"type" => "checkbox"),
		
		array("name" => "Select portfolio layout",
				"id" => $shortname."_portfolio_layout",
				"options" =>  array(
                                    4 => "4 column",
                                    3 => "3 column",
                                    2 => "2 column" 
                                ),
				"type" => "select"),
		
 		array(
				"name" => "How many portfolio item do you want to display per page?",
				"id" => $shortname."_portf_pager",
				"type" => "text"),

		array(
				"name" => "OrderBy Parameter",
				"desc" => "sort your portfolio by this parameter",
				"id" => $shortname."_portf_list_orderby",
				"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
				"type" => "select"),

		array(
				"name" => "Order",
				"desc" => "Designates the ascending or descending order of the ORDERBY parameter",
				"id" => $shortname."_portf_list_order",
				"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
				"type" => "select"),

		array(
				"name" => "Remove links to post details from items",
				"desc" => "If you don't need to portfolio detail page you can disable linking by checking this box.",
				"id" => $shortname."_portf_no_detail",
				"type" => "checkbox",
				"std" => "false"),
		 
		array(  "name" => "Disable auto resize function for portfolio images",
				"id" => $shortname."_auto_disable_box",
				"type" => "checkbox",
				"std" => "false"),
	
		
		
);

$this_file3="controlpanel3.php";
if ( 'save' == $_REQUEST['action'] & 'controlpanel3.php' == $_REQUEST['page'] ) {
 
		foreach ($options3 as $value) {

				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

		
			 header("Location:?page=".$_REQUEST['page'] ."&saved=true");

		die;
}
?>