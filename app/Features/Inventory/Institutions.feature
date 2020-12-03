@module @inventory
Feature: Institutions Management
  We need to test admin institute management
  As a admin User
  I need to be able add, remove, update institutions

  Background: I am login as an Administrator
    When I go to "/admin/login"
    And I fill in "email" with "lincolntrainor@adventus.io"
    And I fill in "password" with "xxx"
    And I press "Log in"
