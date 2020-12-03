@module @admin @core
Feature: Registration & Login System
  In order to operate the website
  As a User
  I need to be able to register, login, forgot password, change password

  Scenario: Check Admin login Screen
    When I am on "/admin/login"
    Then I should see "Log in"

  Scenario: Test if Admin can login
    When I am on "/admin/login"
    And I fill in "email" with "root@adventustesting.io"
    And I fill in "password" with "xxx"
    And I press "Log in"
    Then I should be on "/counsellor/student"
    And I took a screenshot
    And I logout

  Scenario: Test if forgot Password link is working
    When I go to "/admin/login"
    And I should see "Forgot password?"
    And I follow "Forgot password?"
    Then I should be on "/admin/password/reset"
    And I took a screenshot
    And I fill in "email" with "invalid@email.io"
    And I press "Email me a reset password link"
    And I should see "We can't find a user with that e-mail address."