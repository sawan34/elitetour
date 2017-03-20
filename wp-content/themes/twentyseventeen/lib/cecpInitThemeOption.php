<?php

require_once locate_template('/lib/themeOptionOtherInfo.php');
require_once locate_template('/lib/ceoCoalitionThemeOptionSetting.php');
require_once locate_template('/lib/socialThemeOptionMediaSetting.php');
require_once locate_template('/lib/inflationvaluesetting.php');

function themeSettingsPage() {
	 ?>
	    <div class="wrap">
	    <h1>Theme Panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}


function ceoRepresentationfrontPageSetting(){ ?>
 <div class="wrap">
	    <h1>Theme Panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("coalition-represent-front-page-section");
	            do_settings_sections("coalition-represent-front-page-theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
<?php
}

function themeOtherOption(){ ?>
	<h1>Theme Panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("cecp-other-info-page-section");
	            do_settings_sections("cecp-other-info-front-page-theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
<?php
}



function addThemeOption()
{
	add_menu_page("Theme Panel", "CECP Setting", "manage_options", "theme-panel", "themeSettingsPage", null, 99);

	add_submenu_page( "theme-panel", "CEO Coalition Data Setting", "CEO Coalition Data Setting", "manage_options", "theme-panel-front-page", "ceoRepresentationfrontPageSetting" );


	add_submenu_page( "theme-panel", "Footer Setting", "CECP Home Page Other Info", "manage_options", "theme-panel-home-other-info", "themeOtherOption" );
}

add_action("admin_menu", "addThemeOption"); //theme option added






function displayThemePanelList()
{
	add_settings_section("section", "Social Media Settings", null, "theme-options");

	$socialMediaArray = array(
           'facebook',
           'twitter',
           'linkedin',
            'flickr',
            'pinterest',
             'youtube',
             'blogger'



		);
	
	
	registerSocialMediaSetting($socialMediaArray);
	
	/*
	 * Coalition Front page setting 
	 */
	add_settings_section("coalition-represent-front-page-section", "Home Page Other Setting", null, "coalition-represent-front-page-theme-options");

	 $companyRepresentationArray = array(
           								'companies',
           								'assets',
           								'revenue',
           								'investment',
           								'employeeengagement'
										);

	 registerThemeCoalitionSetting($companyRepresentationArray);


	 add_settings_section("cecp-other-info-page-section", "Home Page General Setting", null, "cecp-other-info-front-page-theme-options");

	 //$infoPlaceHolder = ();
	otherOptionInfoSetting();
}

add_action("admin_init", "displayThemePanelList");














