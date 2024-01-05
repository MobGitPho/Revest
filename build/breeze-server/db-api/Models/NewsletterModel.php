<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class NewsletterModel extends \API\Database\Classes\DbManager
{
    private $emailTable;
    private $campaignTable;

    public function __construct(){

        parent::__construct();

        $this->emailTable = Functions::resolveTableName('newsletter_email');
        $this->campaignTable = Functions::resolveTableName('newsletter_campaign');

    }

    public function getEmails()
    {
        return $this->getItems($this->emailTable);
    }

    public function getCampaigns()
    {
        return $this->getItems($this->campaignTable);
    }

    public function getEmailById($id)
    {
        return $this->getItemById($id, $this->emailTable);
    }

    public function getCampaignById($id)
    {
        return $this->getItemById($id, $this->campaignTable);
    }

    public function insertNewEmail($newEmail)
    {
        return $this->insertItem($newEmail, $this->emailTable);
    }

    public function insertNewCampaign($newCampaign)
    {
        return $this->insertItem($newCampaign, $this->campaignTable);
    }

    public function updateEmailData($column, $newValue, $id)
    {
        return $this->updateItemData($column, $newValue, $id, $this->emailTable);
    }

    public function updateCampaignData($column, $newValue, $id)
    {
        return $this->updateItemData($column, $newValue, $id, $this->campaignTable);
    }

    public function deleteEmail($id)
    {
        return $this->deleteItem($id, $this->emailTable);
    }

    public function deleteCampaign($id)
    {
        return $this->deleteItem($id, $this->campaignTable);
    }
}
