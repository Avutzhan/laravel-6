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
        $name 		    = isset($_POST['name']) ? $_POST['name'] : '';
        $phone 		    = isset($_POST['phone']) ? $_POST['phone'] : '';
        $description      = isset($_POST['description']) ? $_POST['description'] : '';
        $email 			= isset($_POST['email']) ? $_POST['email'] : '';
        $company          = isset($_POST['company']) ? $_POST['company'] : '';

        $contact = array(
            'NAME' => $name,
            'PHONE' => $phone,
            'DESCRIPTION' => $description,
            'EMAIL' => $email,
            'COMPANY' => $company,
            'CONTACT_ID' => 0,
            'COMPANY_ID' => 0,
            'DEAL_ID' => 0,
        );

        $contact['COMPANY_ID'] = $this->addCompany($contact);
        $contact['CONTACT_ID'] = $this->addContact($contact);
        $contact['DEAL_ID'] = $this->addDeal($contact);

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
//        $check = $this->checkContact($contact);
//        if($check['total'] != 0) return $check['result'][0]['ID'];
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

    protected function addCompany($contact) {
//        $check = checkCompany($contact);
//        if($check['total'] != 0) return $check['result'][0]['ID'];
        $companyData = $this->sendDataToBitrix('crm.company.add', [
            'fields' => [
                'TITLE' => $contact['COMPANY'],
            ], 'params' => [
                'REGISTER_SONET_EVENT' => 'Y'
            ]
        ]);
        return $companyData['result'];
    }

    protected function checkContact($contact){
        $list = $this->sendDataToBitrix('crm.contact.list', [
            'filter' => [ 'PHONE' =>  $contact['PHONE']],
            'select' => [ 'ID'],
        ]);
        return $list;
    }


}
