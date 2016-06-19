Feature: Knowledge listing page
  In order to manage Alotofus
  As an admin
  I want to manage knowledge listings

  Background:
    Given the database is clean
    And the following knowledge exist:
      |name|
      |PHP |
      |Java|
    And the following candidates exist:
      |name   |surname |email              |role      |password|validated|activated|
      |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
      |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
    And I am logged as "admin@alotofus.com" with password "baraka0"

  @javascript @ALOU-226
  Scenario: Listing knowledge
    Given I am on "admin listings knowledge" page
    Then after waiting I should see 2 resources

  @javascript @ALOU-159
  Scenario: Creating new knowledge
    Given I am on "admin listings knowledge" page
    And I wait until list loads
    When I click in new resource button
    And I fill in the following:
      |translations_en|C++|
      |translations_es|C++|
      |translations_eu|C++|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 3 resources

  @javascript @ALOU-159
  Scenario: Editing existing knowledge
    Given I am on "admin listings knowledge" page
    And I wait until list loads
    When I click in edit resource button for "PHP"
    And I fill in the following:
      |translations_es|PHP|
      |translations_eu|PHP|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 2 resources

  @ALOU-159
  Scenario: Accessing as a normal user
    Given I am logged as "validated@gmail.com" with password "baraka0"
    And I am on "admin listings knowledge" page with 403 error