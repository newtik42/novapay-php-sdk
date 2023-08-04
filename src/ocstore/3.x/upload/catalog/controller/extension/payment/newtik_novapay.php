<?php

class ControllerExtensionPaymentNewtikNovapay extends Controller {

    public $path = 'extension/payment/newtik_novapay';
    public $code = 'newtik_novapay';
    private $setting;
    private $settingDefault = [];

    public function settingDefault($settingDefault, &$val) {



        foreach ($settingDefault as $key => $value) {

            if (is_array($value)) {
                
                if(!isset($val[$key])){
                    $val[$key] = [];
                }
                $this->settingDefault($value, $val[$key]);
                
            } else {
                if (!isset($val[$key])) {
                    $val[$key] = $value;
                }
            }
        }
    }

    public function __construct($registry) {
        parent::__construct($registry);

        $this->load->model('checkout/order');
        $this->language->load($this->path);

        $settingDefault = [
            'merchant_id' => "",
            'public_key' => "",
            'private_key' => "",
            'geo_zone_id' => "0",
            'private_key' => "",
            'sort_order' => "0",
            'qr_code' => "0",
            'holding' => "0",
            'send_info' => [
                'customer' => "1",
                'product' => "1"
            ],
            'order_status' => [],
            'view' => [
                'title_default' => '1',
                'icon' => '1',
                'title' => [],
            ],
            'sandbox' => [
                'status' => '0',
                'log' => '0',
            ],
        ];

        $this->setting = $this->config->get('payment_newtik_novapay');
        $this->settingDefault($settingDefault, $this->setting);

        if ($this->setting['sandbox']['log'] === "1") {
            $this->extlog = new Log('rozetkapay');
        }

        $this->rpay = new \Payment\NovaPay\NovaPay();

        if ($this->setting['sandbox']['status'] === "1") {
            $this->rpay->setBasicAuthTest();
        } else {
            $this->rpay->setBasicAuth($this->config->get($this->prefix . 'rozetkapay_login'), $this->config->get($this->prefix . 'rozetkapay_password'));
        }
    }

    public function index() {
        $this->load->language($this->path);

        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['button_pay'] = $this->language->get('button_pay');

        $data['path'] = $this->path;

        return $this->load->view($this->path, $data);
    }

    public function createPay() {

        $json = [];

        $json['qrcode'] = $this->setting['qr_code'];
        $json['pay'] = false;
        $json['pay_holding'] = $this->setting['holding'];

        $json['alert'] = [];

        if ($this->session->data['payment_method']['code'] != $this->code) {
            return;
        }
        

        $order_id = $this->session->data['order_id'];

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info['order_status_id'] != $setting['order_status']['init']) {
            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('NovaPay init'));
        }

        $this->rpay->setResultURL($this->url->link($this->path . '/result', 'order_id=' . $order_id, true));
        $this->rpay->setCallbackURL($this->url->link($this->path . '/callback', 'order_id=' . $order_id, true));

        $order_info = $this->model_checkout_order->getOrder($order_id);

        $dataCheckout = new \Payment\RozetkaPay\Model\PaymentCreateRequest();

        if ($this->setting['send_info']['customer'] == "1") {

            $customer = new \Payment\RozetkaPay\Model\Customer();

            $customer->email = $order_info['email'];

            $customer->first_name = (empty($order_info['payment_firstname'])) ? $order_info['firstname'] : $order_info['payment_firstname'];
            $customer->last_name = (empty($order_info['payment_lastname'])) ? $order_info['lastname'] : $order_info['payment_lastname'];

            $customer->country = $order_info['payment_iso_code_2'];
            $customer->city = $order_info['payment_city'];
            $customer->postal_code = $order_info['payment_postcode'];
            $customer->address = $order_info['payment_address_1'];
            $customer->phone = $order_info['telephone'];

            $langs = explode("-", $order_info['language_code']);

            if (isset($langs[0])) {
                $customer->locale = strtoupper($langs[0]);
            }

            $dataCheckout->customer = $customer;
        }

        if ($this->config->get($this->prefix . 'rozetkapay_send_info_products_status') == "1") {

            $this->load->model('tool/image');
            $this->load->model('catalog/product');

            $products = $this->model_checkout_order->getOrderProducts($order_id);

            foreach ($products as $product_) {

                $product_info = $this->model_catalog_product->getProduct($product_['product_id']);

                $productNew = new \Payment\RozetkaPay\Model\Product();

                $productNew->id = $product_['product_id'];
                $productNew->name = $product_['name'];

                if (!empty($product_info['image'])) {
                    $productNew->image = $image = $this->model_tool_image->resize(
                            $product_info['image'],
                            $this->config->get('theme_' . $this->config->get('config_theme') . '_image_cart_width'),
                            $this->config->get('theme_' . $this->config->get('config_theme') . '_image_cart_height'));
                }
                $productNew->quantity = $product_['quantity'];
                $productNew->net_amount = $product_['total'];
                $productNew->vat_amount = $product_['tax'];

                $productNew->url = $this->url->link('product/product', 'product_id=' . $product_['product_id'], true);

                $dataCheckout->products[] = $productNew;
            }
        }

        if ($order_info['currency_code'] != "UAH") {
            $order_info['total'] = $this->currency->convert($order_info['total'], $order_info['currency_code'], "UAH");
            $order_info['currency_code'] = "UAH";
        }

        $dataCheckout->amount = $order_info['total'];
        $dataCheckout->external_id = $order_id;
        $dataCheckout->currency = $order_info['currency_code'];

        list($result, $error) = $this->rpay->paymentCreate($dataCheckout);

        $json['pay'] = false;
        if ($error === false && isset($result->is_success)) {
            if (isset($result->action) && $result->action->type == "url") {
                $json['pay_href'] = $result->action->value;
                $json['pay'] = true;
            }
        } else {
            //$json['alert'][] = $this->language->get('error_code_' . $error->code);
            $json['alert'][] = $error->message;
        }

        if ($status_qrcode && $json['pay']) {
            $json['pay_qrcode'] = (new \chillerlan\QRCode\QRCode)->render($json['pay_href']);
        }

        if ($status_holding) {

            $dataCheckout->callback_url = $this->url->link($this->path . '/callback', 'order_id=' . $order_id . "&holding", true);
            $dataCheckout->result_url = $this->url->link($this->path . '/result', 'order_id=' . $order_id . "&holding", true);
            list($result, $error) = $this->rpay->paymentCreate($dataCheckout);

            $json['pay_holding'] = false;

            if ($error === false && isset($result->is_success)) {

                if (isset($result->action) && $result->action->type == "url") {

                    $json['pay_holding_href'] = $result->action->value;
                    $json['pay_holding'] = true;
                }
            } else {
                //$json['alert'][] = $this->language->get('error_code_' . $error->code);
                $json['alert'][] = $error->message;
            }

            if ($status_qrcode && $json['pay_holding']) {

                $json['pay_holding_qrcode'] = (new \chillerlan\QRCode\QRCode)->render($json['pay_holding_href']);
            }
        }

        if (isset($result->data)) {
            $json['message'] = $result->data['message'];
        } elseif (isset($result->message)) {
            $json['message'] = $result->message;
        }



        $this->log($this->rpay->debug);
        $this->log($json['alert']);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
