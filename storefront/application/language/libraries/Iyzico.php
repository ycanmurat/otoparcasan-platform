<?php 
/**
* 
*/
class Iyzico
{
	public function Auth()
	{	
		
		//$options->setApiKey(getenv('IYZICO_API_KEY'));
		//$options->setSecretKey(getenv('IYZICO_SECRET_KEY'));

		$options = new \Iyzipay\Options();

		$options->setApiKey(getenv('IYZICO_API_KEY'));
		$options->setSecretKey(getenv('IYZICO_SECRET_KEY'));
		$options->setBaseUrl("https://api.iyzipay.com");

		return $options;
	}

	public function InstallmentQuery($bin,$price,$cur)
	{
		$Auth = $this->Auth();

		# create request class
		$request = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
		$request->setLocale(\Iyzipay\Model\Locale::TR);
		$request->setbinNumber($bin);
		$request->setPrice($price);
		# make request
		$installmentInfo = \Iyzipay\Model\InstallmentInfo::retrieve($request, $Auth);
		# print result
		return $installmentInfo;
	}

	public function luhn_validate($number, $mod5 = false) {
		$parity = strlen($number) % 2;
		$total = 0;
		// Split each digit into an array
	  	$digits = str_split($number);
	  	foreach($digits as $key => $digit) { // Foreach digit
			// for every second digit from the right most, we must multiply * 2
		  	if (($key % 2) == $parity) 
			  	$digit = ($digit * 2);
			// each digit place is it's own number (11 is really 1 + 1)
		  	if ($digit >= 10) {
				// split the digits
			  	$digit_parts = str_split($digit);
				// add them together
			  	$digit = $digit_parts[0]+$digit_parts[1];
		  	}
			// add them to the total
			$total += $digit;
	  	}
		return ($total % ($mod5 ? 5 : 10) == 0 ? true : false); // If the mod 10 or mod 5 value is equal to zero (0), then it is valid
	}
	
	public function DoPayment($CardDetail,$products,$adresses,$cur)
	{
		$options = $this->Auth();
		        
		$request = new \Iyzipay\Request\CreatePaymentRequest();
		$request->setLocale(\Iyzipay\Model\Locale::TR);
		//$request->setConversationId("123456789");
		$request->setPrice($products->productsDb->productPriceSum);
		$request->setPaidPrice($products->productsDb->productPriceSum);
		$request->setCurrency($cur);
		$request->setInstallment($CardDetail->radioHire);
		$request->setBasketId($products->productsDb->Id);
		$request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
		$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);

		$paymentCard = new \Iyzipay\Model\PaymentCard();
		$paymentCard->setCardHolderName($CardDetail->ccName);
		$paymentCard->setCardNumber($CardDetail->ccNumber);
		$paymentCard->setExpireMonth($CardDetail->ccMonth);
		$paymentCard->setExpireYear($CardDetail->ccYear);
		$paymentCard->setCvc($CardDetail->ccCvv);
		$paymentCard->setRegisterCard(0);
		$request->setPaymentCard($paymentCard);


		$name = explode(" ", $adresses->adress->name);
		if (count($name)>1) {
			$last_name = $name[count($name)-1];
			array_pop($name);
			$name = implode(' ', $name);
		}else{
			$last_name = $name[0];
			$name = $name[0];
		}


		$buyer = new \Iyzipay\Model\Buyer();
		$buyer->setId($products->productsDb->Id);
		$buyer->setName($name);
		$buyer->setSurname($last_name);
		$buyer->setGsmNumber($adresses->adress->gsm);
		$buyer->setEmail("info@ebask.com");//test
		$buyer->setIdentityNumber("11111111111");
		$buyer->setRegistrationAddress($adresses->adress->content);
		$buyer->setIp($_SERVER['REMOTE_ADDR']);
		$buyer->setCity("Istanbul");
		$buyer->setCountry("Turkey");
		$request->setBuyer($buyer);

		$shippingAddress = new \Iyzipay\Model\Address();
		$shippingAddress->setContactName($adresses->adress->name);
		$shippingAddress->setCity("Istanbul");
		$shippingAddress->setCountry("Turkey");
		$shippingAddress->setAddress($adresses->adress->content);
		$request->setShippingAddress($shippingAddress);

		$billingAddress = new \Iyzipay\Model\Address();
		$billingAddress->setContactName($adresses->billing->name);
		$billingAddress->setCity("Istanbul");
		$billingAddress->setCountry("Turkey");
		$billingAddress->setAddress($adresses->billing->content);
		$request->setBillingAddress($billingAddress);

		$basketItems = array();
		foreach ($products->productsCart as $key => $val) {
			if ($val->design == 1) {
				$product_price = $val->price+$val->creative_price;
			}else{
				$product_price = $val->price;
			}

			$BasketItem = new \Iyzipay\Model\BasketItem();
			$BasketItem->setId($val->product_id);
			$BasketItem->setName($val->product_name);
			$BasketItem->setCategory1("Urun");
			$BasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
			$BasketItem->setPrice($product_price);
			$basketItems[$key] = $BasketItem;
		}

		$request->setBasketItems($basketItems);

		$payment = \Iyzipay\Model\Payment::create($request, $options);

		$sonuc = $payment->GetrawResult();
		$sonuc = json_decode($sonuc);

		return $sonuc;
		//  6l0krHtqbn9JxnrMDz4RJQSrFexd17Kg
		//  LxTPLhGuQL5hisW0AHxG3BUrYaHzGHbU	
	}

	public function Do3dLastPayment($data)
	{
		$options = $this->Auth();
		$request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
		$request->setLocale(\Iyzipay\Model\Locale::TR);
		$request->setConversationId("123456789");
		$request->setPaymentId($data->paymentId);

		if (isset($data->conversationData)) {
			$request->setConversationData($data->conversationData);
		}

		$threedsPayment = \Iyzipay\Model\ThreedsPayment::create($request, $options);
		
		$sonuc = $threedsPayment->GetrawResult();
		$sonuc = json_decode($sonuc);

		return $sonuc;
	}

	public function Do3dPayment($CardDetail,$products,$adresses,$cur)
	{
		$options = $this->Auth();
		        
		$request = new \Iyzipay\Request\CreatePaymentRequest();
		$request->setLocale(\Iyzipay\Model\Locale::TR);
		//$request->setConversationId("123456789");
		$request->setPrice($products->productsDb->productPriceSum);
		$request->setPaidPrice($products->productsDb->productPriceSum);
		$request->setCurrency($cur);
		$request->setInstallment($CardDetail->radioHire);
		$request->setBasketId($products->productsDb->Id);
		$request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
		$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
		$request->setCallbackUrl("https://ebask.com/Cart/FinishStep/11");

		$paymentCard = new \Iyzipay\Model\PaymentCard();
		$paymentCard->setCardHolderName($CardDetail->ccName);
		$paymentCard->setCardNumber($CardDetail->ccNumber);
		$paymentCard->setExpireMonth($CardDetail->ccMonth);
		$paymentCard->setExpireYear($CardDetail->ccYear);
		$paymentCard->setCvc($CardDetail->ccCvv);
		$paymentCard->setRegisterCard(0);
		$request->setPaymentCard($paymentCard);

		$name = explode(" ", $adresses->adress->name);
		if (count($name)>1) {
			$last_name = $name[count($name)-1];
			array_pop($name);
			$name = implode(' ', $name);
		}else{
			$last_name = $name[0];
			$name = $name[0];
		}

		$buyer = new \Iyzipay\Model\Buyer();
		$buyer->setId($products->productsDb->Id);
		$buyer->setName($name);
		$buyer->setSurname($last_name);
		$buyer->setGsmNumber($adresses->adress->gsm);
		$buyer->setEmail("info@ebask.com");//test
		$buyer->setIdentityNumber("11111111111");
		$buyer->setRegistrationAddress($adresses->adress->content);
		$buyer->setIp($_SERVER['REMOTE_ADDR']);
		$buyer->setCity("Istanbul");
		$buyer->setCountry("Turkey");
		$request->setBuyer($buyer);

		$shippingAddress = new \Iyzipay\Model\Address();
		$shippingAddress->setContactName($adresses->adress->name);
		$shippingAddress->setCity("Istanbul");
		$shippingAddress->setCountry("Turkey");
		$shippingAddress->setAddress($adresses->adress->content);
		$request->setShippingAddress($shippingAddress);

		$billingAddress = new \Iyzipay\Model\Address();
		$billingAddress->setContactName($adresses->billing->name);
		$billingAddress->setCity("Istanbul");
		$billingAddress->setCountry("Turkey");
		$billingAddress->setAddress($adresses->billing->content);
		$request->setBillingAddress($billingAddress);

		$basketItems = array();
		foreach ($products->productsCart as $key => $val) {
			if ($val->design == 1) {
				$product_price = $val->price+$val->creative_price;
			}else{
				$product_price = $val->price;
			}

			$BasketItem = new \Iyzipay\Model\BasketItem();
			$BasketItem->setId($val->product_id);
			$BasketItem->setName($val->product_name);
			$BasketItem->setCategory1("Urun");
			$BasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
			$BasketItem->setPrice($product_price);
			$basketItems[$key] = $BasketItem;
		}

		$request->setBasketItems($basketItems);

		$threedsInitialize = \Iyzipay\Model\ThreedsInitialize::create($request, $options);

		$sonuc = $threedsInitialize->GetrawResult();
		$sonuc = json_decode($sonuc);

		return $sonuc;
		//  6l0krHtqbn9JxnrMDz4RJQSrFexd17Kg
		//  LxTPLhGuQL5hisW0AHxG3BUrYaHzGHbU	

	
	}
}

?>