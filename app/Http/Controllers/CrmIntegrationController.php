<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrmIntegrationController extends Controller
{
    public function index()
    {
        return view('add-contact-form');
    }

    public function integrateData()
    {
//        dd(request()->all());
        $name 		    = isset($_POST['name']) ? $_POST['name'] : '';
        $phone 		    = isset($_POST['phone']) ? $_POST['phone'] : '';
        $description      = isset($_POST['description']) ? $_POST['description'] : '';
        $email 			= isset($_POST['email']) ? $_POST['email'] : '';
        $company          = isset($_POST['company']) ? $_POST['company'] : '';

        $arProduct = $_POST['product']['price'];

        $contact = array(
            'NAME' => $name,
            'PHONE' => $phone,
            'DESCRIPTION' => $description,
            'EMAIL' => $email,
            'COMPANY' => $company,
            'CONTACT_ID' => 0,
            'COMPANY_ID' => 0,
            'DEAL_ID' => 0,
            'PRICE' => $arProduct,
        );

        //check if contact exists if exist return id if not add and return id
        $contact['CONTACT_ID'] = $this->addContact($contact);

        //check / add product
        $contact['PRODUCT_ID'] = $this->addProduct($contact);

        //add deal
        $contact['DEAL_ID'] = $this->addDeal($contact);

        //add product to deal
        $this->addProductToDeal($contact);

    }

    protected function sendDataToBitrix($method, $data)
    {
            $queryUrl =  "https://bitrix.vrcode.kz/rest/3/haxh8qodoix8bei7/" . $method ;
            $queryData = http_build_query($data);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $queryUrl,
                CURLOPT_POSTFIELDS => $queryData,
            ));

            $result = curl_exec($curl);
            curl_close($curl);
            return json_decode($result, 1);
    }

    protected function addDeal($contact)
    {
        $dealData = $this->sendDataToBitrix('crm.deal.add', [
            'fields' => [
                'TITLE' => 'Test Заявка с сайта',
                'STAGE_ID' => 'NEW',
                'CONTACT_ID' => $contact['CONTACT_ID'],
            ], 'params' => [
                'REGISTER_SONET_EVENT' => 'Y'
            ]
        ]);

        return $dealData['result'];
    }

    protected function addContact($contact) {
        $check = $this->checkContact($contact);
        if($check['total'] != 0) return $check['result'][0]['ID'];
        $contactData = $this->sendDataToBitrix('crm.contact.add', [
            'fields' => [
                'NAME' => $contact['NAME'],
                'EMAIL' => [['VALUE' => $contact['EMAIL'], 'VALUE_TYPE' => 'WORK']],
                'PHONE' => [['VALUE' => $contact['PHONE'], 'VALUE_TYPE' => 'WORK']],
                'TYPE_ID' => 'CLIENT',
                'COMPANY_ID' => $contact['COMPANY_ID'],
            ], 'params' => [
                'REGISTER_SONET_EVENT' => 'Y'
            ]
        ]);

        return $contactData['result'];
    }

    protected function addProduct($contact) {

        $check = $this->checkProduct($contact);
        if($check['total'] != 0) return $check['result'][0]['ID'];

        $contactData = $this->sendDataToBitrix('crm.product.add', [
            'fields' => [
                "NAME" => "1С-Битрикс: Управление сайтом - Старт",
                "CURRENCY_ID" => "RUB",
                "PRICE" => 4900,
                "SORT" => 500
            ]
        ]);

        return $contactData['result'];
    }

    protected function addProductToDeal($contact) {
        $contactData = $this->sendDataToBitrix('crm.deal.productrows.set', [
            'id' => $contact['DEAL_ID'],
            'rows' => [
                [//product with auto calc tax
                    'PRODUCT_ID' => $contact['PRODUCT_ID'],
                    'PRICE_EXCLUSIVE' => $contact['PRICE'],
                    'QUANTITY' => 1
                ],
            ]
        ]);

        return $contactData['result'];
    }

    protected function checkContact($contact){
        $list = $this->sendDataToBitrix('crm.contact.list', [
            'filter' => [ 'PHONE' =>  $contact['PHONE']],
            'select' => [ 'ID'],
        ]);
        return $list;
    }

    protected function checkProduct($contact){
        $list = $this->sendDataToBitrix('crm.product.list', [
            'filter' => [ 'NAME' =>  "1С-Битрикс: Управление сайтом - Старт"],
            'select' => [ 'ID'],
        ]);
        return $list;
    }


}
