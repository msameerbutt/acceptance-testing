<?php

namespace Bootstrap\Model;

use Behat\MinkExtension\Context\MinkContext;

/**
 * Tenant Class
 */
class Tenant extends Model
{
    /**
     * Tenant constructor.
     * @param MinkContext $minkContext
     */
    public function __construct(MinkContext $minkContext)
    {
        $this->minkContext = $minkContext;
    }

    /**
     * This function return Model name
     * @return string
     */
    public function getName(): string
    {
        return __CLASS__;
    }

    /**
     * This function will insert for a tenant
     * @param array $row
     */
    public function add(array $row)
    {
        # Account Details
        $data = $row['AccountDetails'];
        $this->minkContext->fillField('workspace_name', $data['workspace_name']);
        $this->minkContext->fillField('company_name', $data['company_name']);
        $this->minkContext->fillField('external_id', $data['external_id']);
        $this->minkContext->fillField('description', $data['description']);
        $this->minkContext->fillField('notes', $data['notes']);
        $this->minkContext->fillField('timezone', $data['timezone']);

        ### Set Licensed countries
        ## Open drop down of country list
        $selector = 'select[name="licensedcountries[]"] + span.select2';
        $this->minkContext->getSession()->getPage()->find('css', $selector)->click();
        $selector = 'select[name="licensedcountries[]"] + span.select2 input.select2-search__field';

        if (!empty($data['licensedcountries']) && is_array($data['licensedcountries'])) {
            foreach ($data['licensedcountries'] as $country) {
                $this->minkContext->getSession()->getPage()->find('css', $selector)->setValue($country);
                $this->minkContext->getSession()->getPage()->find('css', $selector)->keyDown(13);
            }
        }

        ### Set T & C acceptance date
        $selector = '//div[@class="input-group date"]/input';
        $this->minkContext->getSession()->getPage()->find('xpath', $selector)->click();
        $selector = '//div[@class="datepicker-days"]//td[@class="day"]';
        $this->minkContext->getSession()->getPage()->waitFor(3, function () use ($selector) {
            $this->minkContext->getSession()->getPage()->find('xpath', $selector)->click();
        });

        # Company Contact Details
        $data = $row['CompanyContactDetails'];
        $this->minkContext->getSession()->getPage()->find('xpath' , '//li//a[@href="#tab_company-contact-details"]')->click();
        $this->minkContext->fillField('email', $data['email']);
        $this->minkContext->fillField('phone_country_code', $data['phone_country_code']);
        $this->minkContext->fillField('phone_number', $data['phone_number']);
        $this->minkContext->fillField('address_line1', $data['address_line1']);
        $this->minkContext->fillField('address_line2', $data['address_line2']);
        $this->minkContext->selectOption('country', $data['country']);
        $this->minkContext->fillField('postcode', $data['postcode']);
        $this->minkContext->selectOption('state', $data['state']);
        $this->minkContext->selectOption('city', $data['city']);
        $value = (int) $this->minkContext->getSession()->getPage()->find('xpath','//input[@name="pa_is_same_as_oa"]')->getValue();
        if ((int)$data['postal_address_same'] != (int)$value) {
            $this->minkContext->getSession()->getPage()->find('xpath','//label[text()="Postal Address"]')->click();
        }

        # Team Tab
        $data = $row['Teams'];
        $this->minkContext->getSession()->getPage()->find('xpath' , '//li//a[@href="#tab_team"]')->click();
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $type) {
                $selector = '//input[@name="'.$key.'"]';
                $value = (int) $this->minkContext->getSession()->getPage()->find('xpath',$selector)->getValue();
                if ((int)$type != (int)$value) {
                    $selector = '//input[@name="'.$key.'"]/following-sibling::input/following-sibling::label';
                    $this->minkContext->getSession()->getPage()->find('xpath',$selector)->click();
                }
            }
        }

        # Team Tab
        $data = $row['Orders'];
        $this->minkContext->getSession()->getPage()->find('xpath' , '//li//a[@href="#tab_orders"]')->click();
        $this->minkContext->fillField('order_max_applications', $data['order_max_applications']);

        # Team Tab
        $data = $row['Features'];
        $this->minkContext->getSession()->getPage()->find('xpath' , '//li//a[@href="#tab_features"]')->click();
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $type) {
                $selector = '//input[@name="'.$key.'"]';
                $value = (int) $this->minkContext->getSession()->getPage()->find('xpath',$selector)->getValue();
                if ((int)$type != (int)$value) {
                    $selector = '//input[@name="'.$key.'"]/following-sibling::input/following-sibling::label';
                    $this->minkContext->getSession()->getPage()->find('xpath',$selector)->click();
                }
            }
        }
        $this->minkContext->pressButton('Save and back');
    }

    /**
     * This function return Model name
     * @param string $text
     * @return void
     */
    public function tab(string $text)
    {
        $this->minkContext->assertPageContainsText($text);
    }
}
