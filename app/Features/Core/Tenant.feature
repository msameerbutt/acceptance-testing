@core @admin @tenant
Feature: Tenant Management
  We want to test Administration of Tenant management
  As a Super Admin User
  I need to be able to add/Remove/Update a tenant and its feature and teamss

  Background: I am login as an Administrator
    Given I Login as a Admin User

 # Tenant Add testing section
  Scenario: Add New Tenant
    Given I am on "/admin/tenant/create"
    And I should see column "Tab" for "Tenant" page
      | Tab  |
      | Account Details |
      | Company Contact Details |
      | Student Portal |
      | Related Teams |
      | Lead Integration |
      | Team |
      | Orders |
    And I took a screenshot
    And I am using "Tenant" data from "/var/www/html/Data/Core/Tenant.yml"
    When I add "Tenant" from Table:
      | Tenant   | Description                                  |
      | Tenant-1 | A valid Tenant licenced Australia, Sri Lanka |
      | Tenant-2 | An invalid Tenant for false testing          |
    And I took a screenshot
    And I logout

 # Tenant UI Acceptance testing section
  Scenario: Tenant listing page tabs and label
    Given I am on "/admin/tenant"
    And I should see "Add Tenant"
    And I follow "Add Tenant"
    And I select "10" from "crudTable_length"