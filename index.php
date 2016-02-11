<?
// Store to session
session_start();
$site='https://paypal.ismaris.com/paypal/';
if(empty($_SESSION['loggedIn'])) {
      header('Location: '.$site.'_functions/login.php');
  }
require('_include/header.html');

require_once '/home/ismaris/paypal-vzero/vendor/braintree/braintree_php/lib/Braintree.php';
Braintree\Configuration::environment('sandbox');
Braintree\Configuration::merchantId('LAC2EWY38WXUL');
Braintree\Configuration::publicKey('/home/ismaris/.ssh/id_rsa.pub');
Braintree\Configuration::privateKey('/home/ismaris/.ssh/id_rsa');
$gateway = new Braintree_Gateway(array(
    'accessToken' => 'access_token$sandbox$9v2fx47jbdbkfqg8$6353d6f3547f98f86f12c737cb046923',
));
?>
<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <div class="container">
        <div class="row">
        <div class="pre_2 col_8">
            <form id="form" class="form" target="_top" method="post" enctype="https://www.paypal.com/cgi-bin/webscr" accept-charset="UTF-8">
				<h1 id="mainTitle">PayPal Express Checkout Demo</h1>
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
							<div id="paypal-container"></div>
						</div>
					</div>
				</div>	
            </form>
            </div>	
        </div>
     </div> 
    <script type="text/javascript">
        var token = "<?php echo($clientToken = $gateway->clientToken()->generate());?>";
        braintree.setup(token, "custom", {
          paypal: {
            container: "paypal-container",
            singleUse: true, // Required
            amount: 1.00, // Required
            currency: 'USD', // Required
            locale: 'en_us',
            enableShippingAddress: 'true',
            shippingAddressOverride: {
              recipientName: 'Scruff McGruff',
              streetAddress: '1234 Main St.',
              extendedAddress: 'Unit 1',
              locality: 'Chicago',
              countryCodeAlpha2: 'US',
              postalCode: '60652',
              region: 'IL',
              phone: '123.456.7890',
              editable: false
            }
          },
            onPaymentMethodReceived: function (obj) {
            doSomethingWithTheNonce(obj.nonce);
          }
        });
    </script>
<?php include('./_include/footer.html'); ?>
