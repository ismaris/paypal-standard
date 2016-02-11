<?
// Store to session
session_start();
$site='https://paypal.ismaris.com/paypal-standard/';
if(empty($_SESSION['loggedIn'])) {
      header('Location: '.$site.'_functions/login.php');
  }
require('_include/header.html');
?>
<div class="container">
        <div class="row">
        <div class="pre_2 col_8">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<h1 id="mainTitle">PayPal Payment Buttons Demo (Button Generator Tool)</h1>
				<div class="content">
					<div id="section0" >
						<div class="field" id="usernameField"><label for="CC">Username:</label><input type="text" id="CC" name="CC" disabled="disabled" size="15" value="<? echo $_SESSION['user'];?>"</input></div>
						<div class="field"><label for="CC">Email:</label><input type="text" id="CC" name="CC" size="15" placeholder="johndoe@indiana.edu"></div>
						<div class="field"><label for="Options">Sample Drop Down</label>
								<select id="Options" required>
									<option value="Empty">Select Option...</option>
									<option value="Linux">Option 1</option>
									<option value="Windows">Option 2</option>
								</select>
						</div>
						<div class="col_3">
							<input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="PT5BKM7BJLF5U">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</div>
					</div>
				</div>	
            </form>
            </div>	
        </div>
        <div class="row">
            <div class="col_12">&nbsp;</div>
        </div>
    <div class="row">
            <div class="col_12">&nbsp;</div>
        </div>
     </div> 


<?php include('./_include/footer.html'); ?>
