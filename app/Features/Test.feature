Feature: Registration & Login System
  In order to operate the website
  As a User
  I need to be able to register, login, forgot password, change password

  Scenario: Check Admin login Screen
    Given I am on "https://www.google.com/"
    And I should see "Gmail"
    And I fill in "q" with "Adventus.io"
    When I press "Google Search"
    Then I should be on "https://www.google.com/search"
    And I took a screenshot
    And I follow "Images"
    And I took a screenshot